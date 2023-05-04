<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>

<?php
if (isset($_POST['verify_otp_submit'])) {
    if ($_POST['entered_otp'] == $_SESSION['otp']) {
        header("Location:./ChangePwd.php");
        exit();
    } else {
        $_SESSION['message'] = "Invalid OTP";
        header("Location:./ForgotPwd.php");
        exit();
    }
} else if ($_SESSION['username']) {

    if (isset($_POST['changepwd_submit'])) {
        if ($_POST['change_pwd'] == $_POST['confirm_pwd']) {
            $con = mysqli_connect("localhost:3307", "root", "", "file_manager");

            if ($con) {

                $update_pwd = "UPDATE user_info SET password='" . $_POST['change_pwd'] . "' WHERE username='" . $_SESSION['username'] . "';";

                if (mysqli_query($con, $update_pwd)) {
                    $_SESSION['message'] = "Password changed";
                    header("Location:./SignIn.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Some Error Occurred";
                    header("Location:./ChangePwd.php");
                    exit();
                }

            } else {
                echo mysqli_connect_error();
            }
        } else {
            $_SESSION['message'] = "Password Does not Match";
            header("Location:./ChangePwd.php");
            exit();
        }
    } else {
        echo '<div class="container">
            <form action="' . $_SERVER['PHP_SELF'] . ' " class="mx-5" method="post">
                <h1 class="my-3">Change Password</h1>
                <div class="mb-3">
                    <label for="change_pwd" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="change_pwd" name="change_pwd"
                        placeholder="Enter New Password">
                </div>

                <div class="mb-3">
                    <label for="confirm_pwd" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd"
                        placeholder="Enter Again">
                </div>

                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-dark px-5 py-2" name="changepwd_submit" value="Change Password">
                </div>
            </form>
        </div>';
    }
} else {
    header("Location:./SignIn.php");
    exit();
}

?>

<body>

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