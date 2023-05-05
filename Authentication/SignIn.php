<?php
session_start();

if (isset($_POST['submit'])) {
    $con = mysqli_connect("localhost:3307", "root", "", "file_manager");

    $check_username = "SELECT username FROM user_info WHERE username='" . $_POST['signin_username'] . "';";

    $result = mysqli_query($con, $check_username);
    if (mysqli_fetch_array($result)) {

        $check_password = "SELECT name, password FROM user_info WHERE username='" . $_POST['signin_username'] . "';";

        $result = mysqli_query($con, $check_password);
        $row = mysqli_fetch_array($result);

        if ($row['password'] == md5($_POST['signin_password'])) {
            $_SESSION['username'] = $_POST['signin_username'];
            $_SESSION['message'] = "Welcome ". $row['name'];
            header("Location:../User/HomePage.php");
            exit();
        } else {
            $_SESSION['message'] = "Password Is Invalid";
        }
    } else {
        $_SESSION['message'] = "Username Does Not Exist";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>

<body>    
    <div class="container d-flex justify-content-center align-items-center flex-column"  style="height: 100vh;">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mx-5 w-50 border p-4 border-2  border-dark " style="border-radius: 10px;"  method="post">
            <h1 class="my-3">Sign In</h1>
            <div class="mb-3">
                <label for="signin_username" class="form-label">Username</label>
                <input type="text" class="form-control" id="signin_username" name="signin_username"
                    placeholder="Enter Username">
            </div>
            <div class="mb-3">
                <label for="signin_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="signin_password" name="signin_password"
                    placeholder="Enter Password">
            </div>

            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-dark px-5 py-2" name="submit" value="Sign In">
            </div>
            <div class="d-flex justify-content-center">
                <a class="btn btn-dark px-4 my-3" href="./SignUp.php">Don't have an Account?</a>
            </div>
            <div class="d-flex justify-content-center">
                <a href="./ForgotPwd.php">Forgot Password?</a>
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