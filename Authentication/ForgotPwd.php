<?php
session_start();

include("../Database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>

<?php

if (isset($_POST['forgotpwd_submit'])) {

    $check_username = "SELECT user_email FROM user_info WHERE username='" . $_POST['forgotpwd_username'] . "';";

    $result = mysqli_query($con, $check_username);
    if ($row = mysqli_fetch_array($result)) {
        $min = 100000;
        $max = 999999;
        $random_number = rand($min, $max);
        $six_digit_number = str_pad($random_number, 6, '0', STR_PAD_LEFT);

        $to = $row['user_email'];
        $subject = 'Forgot Password';
        $message = 'Your OTP for Verification is ' . $six_digit_number;
        $headers = 'Reply-To: ' . $row['user_email'] . "\r\n";

        if (mail($to, $subject, $message, $headers)) {

            $_SESSION['otp'] = $six_digit_number;
            $_SESSION['username'] = $_POST['forgotpwd_username'];

            echo '<div class="container">
            <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 100vh;">
                    <form action="./ChangePwd.php" class="mx-5 w-50 border p-4 border-2  border-dark " style="border-radius: 10px;" method="post">
                        <h1 class="my-3">Forgot Password</h1>
                        <div class="mb-3">
                            <label for="entered_otp" class="form-label">One Time Password (OTP)</label>
                            <input type="number" class="form-control" id="entered_otp" name="entered_otp"
                            placeholder="Enter OTP here">
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-dark px-5 py-2" name="verify_otp_submit" value="Verify">
                        </div>
                    </form>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="position-fixed top-50" style="">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong id="toast-header-text" class="me-auto text-dark px-2 py-2" style="font-size: 20px;"></strong>
                                <button type="button" class="btn-close px-3 py-2" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>';
            if (isset($_SESSION['message'])) {
                echo "<script>
                            var toastLiveExample = document.getElementById('liveToast')
                            var toastBody = document.getElementById('toast-header-text');
                            toastBody.innerHTML = '" . $_SESSION['message'] . "';
                            var toast = new bootstrap.Toast(toastLiveExample)
                            toast.show()
                        </script>";

                unset($_SESSION['message']);
            }
            exit();
        } else {
            $_SESSION['message'] = "Can't send email";
            exit();
        }

    } else {
        $_SESSION['message'] = "Username Does Not Exist";
    }
} else if (isset($_SESSION['message']) && $_SESSION['message'] == 'Invalid OTP') {
    echo '<div class="container">
    <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 100vh;">
                    <form action="./ChangePwd.php" class="mx-5 w-50 border p-4 border-2  border-dark " style="border-radius: 10px;" method="post">
                        <h1 class="my-3">Forgot Password</h1>
                        <div class="mb-3">
                            <label for="entered_otp" class="form-label">One Time Password (OTP)</label>
                            <input type="number" class="form-control" id="entered_otp" name="entered_otp"
                            placeholder="Enter OTP here">
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-dark px-5 py-2" name="verify_otp_submit" value="Verify">
                        </div>
                    </form>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
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
    exit();
} else if (isset($_SESSION['message']) && $_SESSION['message'] != 'Invalid OTP') {
    echo '<div class="container">
    <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 100vh;">
            <form action="' . $_SERVER['PHP_SELF'] . '" class="mx-5 w-50 border p-4 border-2  border-dark " style="border-radius: 10px;" method="post">
                <h1 class="my-3">Forgot Password</h1>
                <div class="mb-3">
                    <label for="forgotpwd_username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="forgotpwd_username" name="forgotpwd_username"
                        placeholder="Enter Username">
                </div>

                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-dark px-5 py-2" name="forgotpwd_submit" value="Send OTP to Email">
                </div>
                <div class="d-flex justify-content-center my-3">
                    <a class="btn btn-dark" href="./SignIn.php">Go back to Sign In</a>
                </div>
            </form>
            </div>
        </div>
            <div class="d-flex justify-content-center">
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
    exit();
}
?>

<body>

    <div class="container">
        <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 100vh;">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mx-5 w-50 border p-4 border-2  border-dark " style="border-radius: 10px;" method="post">
                <h1 class="my-3">Forgot Password</h1>
                <div class="mb-3">
                    <label for="forgotpwd_username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="forgotpwd_username" name="forgotpwd_username"
                        placeholder="Enter Username">
                </div>

                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-dark px-5 py-2" name="forgotpwd_submit"
                        value="Send OTP to Email">
                </div>
                <div class="d-flex justify-content-center my-3">
                    <a class="btn btn-dark px-4" href="./SignIn.php">Go back to Sign In</a>
                </div>
            </form>
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