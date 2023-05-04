<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:../Authentication/SignIn.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="./Javascript/NavBar.js"></script>
</head>

<body>
    <header-component></header-component>

    <div class="container d-flex justify-content-center">
        <div class="card mt-4" style="width: 40rem; background-color: #f2f2f2;">
            <?php

            $con = mysqli_connect("localhost:3307", "root", "", "file_manager");
            $get_user = "SELECT * FROM user_info WHERE username='" . $_SESSION['username'] . "';";

            $result = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($result);

            if ($row) {
                echo '<img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title">' . $row['username'] . '</h3>
                            <table class="card-title" width="100%">
                                <tr>
                                    <th>Name</th>
                                    <td>' . $row['name'] . '</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>' . $row['user_email'] . '</td>
                                </tr>
                                <tr>
                                    <th>Mobile No.</th>
                                    <td>' . $row['user_mobile'] . '</td>
                                </tr>
                                <tr>
                                    <th>Birth Date</th>
                                    <td>' . $row['user_dob'] . '</td>
                                </tr>
                            </table>
                            <a href="./EditProfile.php" class="btn btn-dark d-flex justify-content-center">Edit Profile</a>
                        </div>';
            }
            ?>

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

<html>