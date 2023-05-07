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
  <title>About Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/e7096dece0.js" crossorigin="anonymous"></script>
  <script src="Javascript/NavBar.js"></script>
  <style>
    .row {
      width: 100%;
      display: flex;
      flex-direction: row;
      justify-content: center;
    }

    .fa {
      padding: 1vh;
      font-size: 3vh;
      text-align: center;
      text-decoration: none;
    }

    .fa-linkedin {
      background: #007bb5;
      color: white;
    }

    .fa-instagram {
      background: #f09433;
      background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
      background: -webkit-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
      background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
      color: white;
    }

    .fa-github {
      background: #474e5d;
      color: white;
    }
  </style>
</head>

<body>
  <header-component></header-component>
  <div class="container mt-3 d-flex justify-content-center">
    <div>
      <div class="my-3">
        <table style="border: 1px solid black;">
          <tr>
            <td rowspan="4"><img class="m-2" src="../Images/Sanket.png" style="height:20vh; width:20vh;" alt="logo">
            </td>
          </tr>
          <tr>
            <td class="px-3">
              <h3>Sanket Sadadiya</h3>
            </td>
          </tr>
          <tr>
            <td align="center">sanketsadadiya53@gmail.com</td>
          </tr>
          <tr>
            <td align="center" style="width:100%;">
              <a href="https://www.linkedin.com/in/sanket-sadadiya-9a0150222/" target="_blank"
                class="fa fa-linkedin"></a>
              <a href="https://www.instagram.com/sanket_164/" target="_blank" class="fa fa-instagram"></a>
              <a href="https://github.com/sanket-164" target="_blank"> <i class="fa fa-brands fa-github"></i></a>
            </td>
          </tr>
        </table>
      </div>

      <div class="my-3">
        <table style="border: 1px solid black;">
          <tr>
            <td rowspan="4"><img class="m-2" src="../Images/Milan.png" style="height:20vh; width:20vh;" alt="logo">
            </td>
          </tr>
          <tr>
            <td class="px-3">
              <h3>Milan Bhingradiya</h3>
            </td>
          </tr>
          <tr>
            <td align="center">milanbhingradiya00@gmail.com</td>
          </tr>
          <tr>
            <td align="center" style="width:100%;">
            <a href="https://www.linkedin.com/in/milan-bhingradiya-318b86248/" target="_blank"
              class="fa fa-linkedin"></a>
            <a href="https://www.instagram.com/milan__bhingradiya/  " target="_blank" class="fa fa-instagram"></a>
            <a href="http://github.com/Milan-Bhingradiya" target="_blank"> <i class="fa fa-brands fa-github"></i></a>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>

</html>