<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:../Authentication/SignIn.php");
    exit();
}
include("../Database.php");

if (isset($_GET['delete_file'])) {

    if ($con) {

        $sql = "DELETE FROM " . $_SESSION['username'] . " WHERE file_id='" . $_GET['delete_file'] . "'";

        if (!mysqli_query($con, $sql)) {
            $_SESSION['message'] = "Cannot delete file";
            exit();
        } else {
            $_SESSION['message'] = "File deleted successfully";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="./Javascript/NavBar.js"></script>
</head>

<body>
    <header-component></header-component>

    <div class="container">
        <div class="dropdown my-3" align="right">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Select Extension
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="./HomePage.php?extension=all">All</a></li>
                <?php
                $get_extensions = "SELECT DISTINCT file_extension FROM " . $_SESSION['username'] . ";";

                if ($result = mysqli_query($con, $get_extensions)) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<li><a class="dropdown-item" href="./HomePage.php?extension=' . $row['file_extension'] . '">' . strToUpper($row['file_extension']) . '</a></li>';
                    }
                }
                ?>
            </ul>
        </div>

        <table class="table" style="border: 2px solid black;">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">File Name</th>
                    <th scope="col">Extension</th>
                    <th scope="col">Size</th>
                    <th scope="col">Uploaded At</th>
                    <th scope="col">Download</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (isset($_SESSION['extension']) || isset($_GET['extension'])) {

                    if(isset($_GET['extension'])) {
                        $_SESSION['extension'] = $_GET['extension'];
                    }

                    if ($_SESSION['extension'] == 'all') {
                        $get_files = "SELECT file_id, file_name, file_extension, file_size, upload_time FROM " . $_SESSION['username'] . " ORDER BY upload_time DESC;";
                    } else {
                        $get_files = "SELECT file_id, file_name, file_extension, file_size, upload_time FROM " . $_SESSION['username'] . " WHERE file_extension = '" . $_SESSION['extension'] . "' ORDER BY upload_time DESC;";
                    }
                } else {
                    $get_files = "SELECT file_id, file_name, file_extension, file_size, upload_time FROM " . $_SESSION['username'] . " ORDER BY upload_time DESC;";
                }

                if ($result = mysqlI_query($con, $get_files)) {

                    $counter = 1;

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                    <th scope="row">' . $counter . '</th>
                                    <td>' . $row['file_name'] . '</td>
                                    <td>' . $row['file_extension'] . '</td>
                                    <td>' . round(($row['file_size']/1024)) . ' KB</td>
                                    <td>' . $row['upload_time'] . '</td>
                                    <td><a href="./FileDownload.php?download_file=' . $row['file_id'] . '" target="__blank">Download</a></td>
                                    <td><a href="./HomePage.php?delete_file=' . $row['file_id'] . '">Delete</a></td>
                                </tr>';
                        $counter += 1;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="d-flex justify-content-center">
                <div class="position-fixed bottom-0 mb-4">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong id="toast-header-text" class="me-auto text-dark px-2 py-2" style="font-size: 20px;"></strong>
                            <button type="button" class="btn-close px-3 py-2" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>';

        echo "<script>
                var toastLiveExample = document.getElementById('liveToast')
                var toastBody = document.getElementById('toast-header-text');
                toastBody.innerHTML = '" . $_SESSION['message'] . "';
                var toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
            </script>";

        unset($_SESSION['message']);
    }
    ?>
</body>

</html>