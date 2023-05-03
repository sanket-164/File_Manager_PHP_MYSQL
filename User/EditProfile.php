<?php
session_start();

if (isset($_POST['editprofile_submit'])) {
    $con = mysqli_connect("localhost:3307", "root", "", "file_manager");

    if ($con) {

        $check_email = "SELECT user_email FROM user_info WHERE user_email='" . $_POST['editprofile_email'] . "' && username!='" . $_SESSION['username'] . "';";

        $result = mysqli_query($con, $check_email);
        if (mysqli_fetch_array($result)) {
            header("Location:http://localhost/File%20Manager%20(PHP)/User/EditProfile.php?error=Email is Already Registered");
            exit();
        } else {
            $check_number = "SELECT user_mobile FROM user_info WHERE user_mobile='" . $_POST['editprofile_mobile'] . "' && username!='" . $_SESSION['username'] . "';";

            $result = mysqli_query($con, $check_number);
            if (mysqli_fetch_array($result)) {
                header("Location:http://localhost/File%20Manager%20(PHP)/User/EditProfile.php?error=Number is Already Registered");
                exit();
            } else {

                $update_user = "UPDATE user_info SET name='" . $_POST['editprofile_name'] . "', user_email='" . $_POST['editprofile_email'] . "', user_mobile='" . $_POST['editprofile_mobile'] . "', user_dob='" . $_POST['editprofile_dob'] . "' WHERE username='" . $_SESSION['username'] . "';";
                if (mysqli_query($con, $update_user)) {
                    header("Location:http://localhost/File%20Manager%20(PHP)/User/Profile.php");
                    exit();
                } else {
                    header("Location:http://localhost/File%20Manager%20(PHP)/User/EditProfile.php?error=Some error occured");
                    exit();
                }
            }
        }
    } else {
        echo mysqli_connect_error();
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
    <script src="../NavBar.js"></script>
</head>

<body>
    <header-component></header-component>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="container d-flex justify-content-center">
            <div class="card" style="width: 40rem; my-3">
                <?php
                if (isset($_SESSION['username'])) {

                    $con = mysqli_connect("localhost:3307", "root", "", "file_manager");
                    $get_user = "SELECT * FROM user_info WHERE username='" . $_SESSION['username'] . "';";

                    $result = mysqli_query($con, $get_user);
                    $row = mysqli_fetch_array($result);

                    if ($row) {
                        echo '<img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title">' . $row['username'] . '</h3>
                            <table width="100%">
                                <tr>
                                    <th>Name</th>
                                    <td><input type="text" class="form-control" name="editprofile_name" value="' . $row['name'] . '" width="50%"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><input type="email" class="form-control" name="editprofile_email" value="' . $row['user_email'] . '"></td>
                                </tr>
                                <tr>
                                    <th>Mobile No.</th>
                                    <td><input type="number" class="form-control" name="editprofile_mobile" minlength="10" value="' . $row['user_mobile'] . '"></td>
                                </tr>
                                <tr>
                                    <th>Birth Date</th>
                                    <td><input type="date" class="form-control" name="editprofile_dob" value="' . $row['user_dob'] . '"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><input type="submit" name="editprofile_submit" value="Save Changes" class="btn btn-dark d-flex justify-content-center px-5 py-2 my-3"></td>
                                </tr>
                            </table>
                        </div>';
                    }
                } else {
                    header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignIn.php");
                    exit();
                }
                ?>

            </div>
        </div>
    </form>
</body>