<?php
session_start();

include("../Database.php");

if (isset($_POST['submit'])) {

    $check_username = "SELECT username FROM user_info WHERE username='" . $_POST['signup_username'] . "';";

    $result = mysqli_query($con, $check_username);
    if (mysqli_fetch_array($result)) {
        $_SESSION['message'] = "Username Already Exist";
    } else {
        $check_email = "SELECT user_email FROM user_info WHERE user_email='" . $_POST['signup_email'] . "';";

        $result = mysqli_query($con, $check_email);
        if (mysqli_fetch_array($result)) {
            $_SESSION['message'] = "Email is Already Registered";
        } else {
            $check_number = "SELECT user_mobile FROM user_info WHERE user_mobile='" . $_POST['signup_number'] . "';";

            $result = mysqli_query($con, $check_number);
            if (mysqli_fetch_array($result)) {
                $_SESSION['message'] = "Number is Already Registered";
            } else {
                if ($con) {

                    $insert_user = "INSERT INTO user_info VALUES ('" . $_POST['signup_username'] . "',
                        '" . md5($_POST['signup_password']) . "',
                        '" . $_POST['signup_name'] . "',
                        '" . $_POST['signup_email'] . "',
                        '" . $_POST['signup_number'] . "',
                        '" . $_POST['signup_dob'] . "',
                        null);";

                    if (mysqli_query($con, $insert_user)) {
                        $create_table = "CREATE TABLE " . $_POST['signup_username'] . "(
                            file_id INTEGER PRIMARY KEY AUTO_INCREMENT,
                            file_name VARCHAR(255) NOT NULL,
                            file_extension VARCHAR(20),
                            file_size INTEGER,
                            file_content BLOB,
                            upload_time datetime
                        );";

                        if (mysqli_query($con, $create_table)) {
                            header("Location:./SignIn.php");
                            exit();
                        } else {
                            $_SESSION['message'] = "Some Error occured";
                        }
                    } else {
                        $_SESSION['message'] = "Some Error occured";
                    }
                } else {
                    echo mysqli_connect_error();
                }
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
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>

<body>

    <div class="container" id="sinup_container">
        <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 100vh;">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mx-5 w-50 border p-4 border-2  border-dark "
                style="border-radius: 10px;" method="post">
                <h1 class="my-3">Sign Up</h1>

                <div class="mb-3">
                    <label for="signup_username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="signup_username" name="signup_username"
                        placeholder="Enter Username" maxLength="15" minLength="5" required="true">
                </div>
                <div class="mb-3">
                    <label for="signup_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="signup_name" name="signup_name" placeholder="Name"
                        required="true">
                </div>
                <div class="mb-3">
                    <label for="signup_email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="signup_email" name="signup_email"
                        placeholder="name@example.com" required="true">
                </div>
                <div class="mb-3">
                    <label for="signup_number" class="form-label">Mobile Number</label>
                    <input type="number" class="form-control" id="signup_number" name="signup_number"
                        placeholder="Phone Number" required="true">
                </div>
                <div class="mb-3">
                    <label for="signup_dob" class="form-label">Birthdate</label>
                    <input type="date" class="form-control" id="signup_dob" name="signup_dob" required="true">
                </div>
                <div class="mb-3">
                    <label for="signup_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="signup_password" name="signup_password"
                        placeholder="Enter Password" maxLength="15" minLength="5" required="true">
                </div>
                <div class="d-flex justify-content-center w-full">
                    <input type="submit" class="btn btn-dark px-5 my-2" name="submit" value="Sign Up">
                </div>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-dark px-4" href="./SignIn.php">Go back to Sign In</a>
                </div>
            </form>
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