<?php
session_start();
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
            if (isset($_SESSION['username'])) {

                $con = mysqli_connect("localhost:3307", "root", "", "file_manager");
                $get_user = "SELECT * FROM user_info WHERE username='" . $_SESSION['username'] . "';";

                $result = mysqli_query($con, $get_user);
                $row = mysqli_fetch_array($result);

                if ($row) {
                    echo '<img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title">'.$row['username'].'</h3>
                            <table class="card-title" width="100%">
                                <tr>
                                    <th>Name</th>
                                    <td>'.$row['name'].'</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>'.$row['user_email'].'</td>
                                </tr>
                                <tr>
                                    <th>Mobile No.</th>
                                    <td>'.$row['user_mobile'].'</td>
                                </tr>
                                <tr>
                                    <th>Birth Date</th>
                                    <td>'.$row['user_dob'].'</td>
                                </tr>
                            </table>
                            <a href="./EditProfile.php" class="btn btn-dark d-flex justify-content-center">Edit Profile</a>
                        </div>';
                }
            } else {
                header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignIn.php");
                exit();
            }
            ?>

        </div>
    </div>
</body>

<html>