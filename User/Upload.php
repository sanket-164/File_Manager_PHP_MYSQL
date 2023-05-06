<?php
session_start();

$con = mysqli_connect("localhost:3307", "root", "", "file_manager");


if (!isset($_SESSION['username'])) {
    header("Location:../Authentication/SignIn.php");
    exit();
}

if (isset($_POST['upload_submit'])) {

    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $fp = fopen($_FILES["file"]["tmp_name"], "rb");
        $data = fread($fp, filesize($_FILES["file"]["tmp_name"]));
        $file_name = $_FILES['file']['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_size = $_FILES['file']['size'];
        $upload_time = date("Y-m-d h:i:sa");
        fclose($fp);

        if ($con) {

            $insert_file = "INSERT INTO " . $_SESSION['username'] . " (file_name, file_extension, file_size, file_content, upload_time) VALUES ('" . $file_name . "','" . $file_extension . "','" . $file_size . "','" . mysqli_real_escape_string($con, $data) . "','" . $upload_time . "')";

            if (mysqli_query($con, $insert_file)) {
                $_SESSION['message'] = "File uploaded successfully";
            } else {
                $_SESSION['message'] = "Cannot upload file";
            }
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
    <title>Upload File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="./Javascript/NavBar.js"></script>

    <style>
        #maindiv {
            margin-right: 5%;
            margin-left: 5%;
            margin-top: 1%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        #choose_file_div {
            margin-left: 15%;
            display: inline-block;
        }

        .file-container {
            background-color: #f2f2f2;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #ccc;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <header-component></header-component>

    <div class="container">
        <div class="file-container pb-1 mt-3">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="upload_form" class="mx-5" method="post"
                enctype="multipart/form-data">

                <div id="maindiv">
                    <div class="d-flex justify-content-center">
                        <div id="label_div">
                            <h3>Select File To Upload</h3>
                        </div>
                    </div>

                    <div id="choose_file_div" class="d-flex justify-content-center my-3">
                        <input type="file" id="file" name="file">
                    </div>

                    <div class="d-flex justify-content-center">
                        <input type="submit" class="btn btn-dark px-5 py-2 my-2" name="upload_submit" value="Upload">
                    </div>

                </div>
            </form>

            <div class="d-flex justify-content-center">

                <table class="table" style="border: 2px solid black; width:75vw;">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">File Name</th>
                            <th scope="col">Extension</th>
                            <th scope="col">Size</th>
                            <th scope="col">Uploaded At</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $get_files = "SELECT * FROM " . $_SESSION['username'] . " ORDER BY upload_time DESC;";

                        if ($result = mysqlI_query($con, $get_files)) {

                            $counter = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                    <th scope="row">' . $counter . '</th>
                    <td>' . $row['file_name'] . '</td>
                    <td>' . $row['file_extension'] . '</td>
                    <td>' . $row['file_size'] . ' Bytes</td>
                    <td>' . $row['upload_time'] . '</td>
                </tr>';
                                $counter += 1;
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="d-flex justify-content-center">
                <div class="position-fixed top-50" style="">
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