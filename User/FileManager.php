<?php
session_start();
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
    <script src="Javascript/NavBar.js"></script>
</head>

<body>
    <header-component></header-component>


    <!-- <?php
    // if (isset($_SESSION['username'])) {


    // } else {
    //     header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignIn.php");
    //     exit();
    // }
    ?> -->
    <div class="container d-flex justify-content-center home-container"><div class="card border border-dark col-md-6 text-dark"><img src="https://static.vecteezy.com/system/resources/previews/008/709/513/original/chef-restaurant-logo-illustrations-template-free-vector.jpg" class="card-img-top" alt="logo"><div class="card-body bg-light"><h5 class="card-title">Mr.Chef</h5><p class="card-text">This application is made for learning purpose only, it helps users to find the Recipes of their choice.</p><p class="card-text">This application is made by using REST apis and REACT JS, Let me know if you want to give me some feedback.</p><a class="btn btn-dark text-light" href="/">Explore</a></div></div></div>
</body>