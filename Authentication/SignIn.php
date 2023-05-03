<?php
session_start();

if (isset($_POST['submit'])) {
    $con = mysqli_connect("localhost", "root", "", "file_manager");

    $check_username = "SELECT username FROM user_info WHERE username='" . $_POST['signin_username'] . "';";

    $result = mysqli_query($con, $check_username);
    if (mysqli_fetch_array($result)) {

        $check_password = "SELECT password FROM user_info WHERE username='" . $_POST['signin_username'] . "';";

        $result = mysqli_query($con, $check_password);
        $row = mysqli_fetch_array($result);

        if ($row['password'] == $_POST['signin_password']) {
            $_SESSION['username'] = $_POST['signin_username'];
            header("Location:http://localhost/File%20Manager%20(PHP)/User/HomePage.php");
            exit();
        } else {
            header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignIn.php?message=Password Is Invalid");
            exit();
        }
    } else {
        header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignIn.php?message=Username Does Not Exist");
        exit();
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
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mx-5" method="post">
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

            <input type="submit" class="btn btn-dark px-5 py-2" name="submit" value="Sign In">
            <br />
            <a href="./ForgotPwd.php">Forgot Password?</a>
        </form>
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
    </div>

    <script>
        var toastLiveExample = document.getElementById('liveToast')
        const urlParams = new URLSearchParams(window.location.search);
        const myParam = urlParams.get('message');
        if (myParam) {
            var toastBody = document.getElementById('toast-header-text');
            toastBody.innerHTML = myParam;
            var toast = new bootstrap.Toast(toastLiveExample)
            toast.show()
        }
    </script>
</body>

</html>