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
    <title>File Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="./Javascript/NavBar.js"></script>
</head>

<body>
    <header-component></header-component>

    <div class="container d-flex justify-content-center mt-3">
        <div class="card border border-dark col-md-4 text-dark">
            <img class="" src="../Images/File_Manager_logo.png" class="card-img-top" alt="logo">
            <div class="card-body bg-light ">
                <h5 class="card-title">File Manager</h5>
                <p class="card-text">This application provides an intuitive and
                    user-friendly interface for uploading, organizing, and downloading files, and supports a range of
                    file types, including documents, images, and more.</p>
                <a class="btn btn-dark text-light" target="_blank"
                    href="https://github.com/sanket-164/File_Manager_PHP_MYSQL">Get source code</a>
                <a class="btn btn-dark text-light" href="HomePage.php">Continue</a>
            </div>
        </div>
    </div>

</body>

</html>