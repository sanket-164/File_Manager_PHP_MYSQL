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
        <h1 class="my-3">Sign In</h1>
        <div class="mb-3">
            <label for="signin_username" class="form-label">Username</label>
            <input type="text" class="form-control" id="signin_username" placeholder="Enter Username">
        </div>
        <div class="mb-3">
            <label for="signin_password" class="form-label">Password</label>
            <input type="password" class="form-control" id="signin_password" placeholder="Enter Password">
        </div>
        
        <input type="submit" class="btn btn-dark px-5 py-2" value="Sign In">
        <br/>
        <a href="./ForgotPwd.php">Forgot Password?</a>
    </div>
</body>

</html>