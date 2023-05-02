<?php
if (isset($_POST['submit'])) {
    $con = mysqli_connect("localhost:3307", "root", "", "file_manager");

    $check_username = "SELECT username FROM user_info WHERE username='" . $_POST['signup_username'] . "';";

    $result = mysqli_query($con, $check_username);
    if (mysqli_fetch_array($result)) {
        header("Location:http://localhost/File%20Manager%20(PHP)/Frontend/SignUp.html?error=Username Already Exist");
        exit();
    } else {
        $check_email = "SELECT user_email FROM user_info WHERE user_email='" . $_POST['signup_email'] . "';";

        $result = mysqli_query($con, $check_email);
        if (mysqli_fetch_array($result)) {
            header("Location:http://localhost/File%20Manager%20(PHP)/Frontend/SignUp.html?error=Email is Already Registered");
            exit();
        } else {
            $check_number = "SELECT user_mobile FROM user_info WHERE user_mobile='" . $_POST['signup_number'] . "';";

            $result = mysqli_query($con, $check_number);
            if (mysqli_fetch_array($result)) {
                header("Location:http://localhost/File%20Manager%20(PHP)/Frontend/SignUp.html?error=Number is Already Registered");
                exit();
            } else {
                if ($con) {
                    $insert_user = "INSERT INTO user_info VALUES (123457,'" . $_POST['signup_password'] . "',
                        '" . $_POST['signup_username'] . "',
                        '" . $_POST['signup_name'] . "',
                        '" . $_POST['signup_email'] . "',
                        '" . $_POST['signup_number'] . "',
                        '" . $_POST['signup_dob'] . "',
                        null);";
                    if (mysqli_query($con, $insert_user)) {
                        header("Location:http://localhost/File%20Manager%20(PHP)/Frontend/User/HomePage.html");
                        exit();
                    } else {
                        header("Location:http://localhost/File%20Manager%20(PHP)/Frontend/SignUp.html?error=Some error occured");
                        exit();
                    }
                } else {
                    echo mysqli_connect_error();
                }
            }
        }
    }
}
?>