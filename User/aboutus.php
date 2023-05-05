
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
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="Javascript/NavBar.js"></script>
   <style>
        .about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
  
}

#second_div_row {
            display: inline-block;
        }

        .height_only_div {
          margin-top: 3%;
        }
        .width_only_div {
          width: 80%;
        }

        /* .border{
           
            
        } */
        .table_center {
           margin: auto;
            
  width: 50%;
 
  padding: 10px;
}

.row {
  width: 100%;
  display: flex;
  flex-direction: row;
  justify-content: center;
}
.block {
    padding: 50px 0;
  width: 100px;
 
  border: 1px solid black;
  margin-left: 3%;
  margin-right: 3%;
            border: 1px solid black;
            padding: 10px;
}

.img_h_w{
    height: 40%;
    width: 65%;
    border-radius: 50%;
}

.fa {
  padding: 13px;
  font-size: 20px;
  width: 20px;
  text-align: center;
  text-decoration: none;
}
.fa-linkedin {
  background: #007bb5;
  color: white;
}
.fa-instagram {
  background: #125688;
  color: white;
}
.fa-reddit {
  background: #ff5700;
  color: white;
}

</style>
</head>
<body>
<header-component></header-component>
<div class="about-section" >
  
  <p>We are Diploma Engennering student</p>
  <p> we're passionate about helping you to manage your files more efficiently than ever before.Our file management system is built on a foundation of cutting-edge technology, including HTML, CSS, and PHP </p>
</div>



<div class="height_only_div"">
</div>


<!-- // row -->
<div class="row">

<div class="block"  style="width: 20%;">
  <img class=" img_h_w" src="data:image/jpeg;base64,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" class="card-img-top" alt="...">
  <div >
    <h3 >Sanket Sadadiya</h3>
    <p >Some quick example text to build on the card title and make up the bulk of the card's content.</p>

    <a href="#" class="fa fa-linkedin"></a>
    <a href="#" class="fa fa-instagram"></a>
    <a href="#" class="fa fa-reddit"></a>
  </div>
</div>

    <div class="block"  style="width: 20%;">
  <img class=" img_h_w"  src="https://www.seiu1000.org/sites/main/files/main-images/camera_lense_0.jpeg" class="card-img-top rounded-circle" alt="...">
  <div >
    <h3 >Milan Bhingradiya</h3>
    <p >Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="fa fa-linkedin"></a>
    <a href="#" class="fa fa-instagram"></a>
    <a href="#" class="fa fa-reddit"></a>   
  </div>
</div>
    </div>
    <!-- //row end -->
        


</div>  

</body>
</html>