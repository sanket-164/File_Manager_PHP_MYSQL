<?php 
session_start();

if (isset($_POST['submit'])){
    $con = mysqli_connect("localhost", "root", "", "file_manager");


    if($con){
      echo "cc";
      $upload_time = date("Y-m-d h:i:sa");

        $query=  "INSERT INTO feedback VALUES ('" . $_POST['name'] . "',
        '" . $_POST['feedback'] . "',
       
        '" . $upload_time . "'
      );";

      $result=mysqli_query($con, $query );
     if($result){
      echo "added";
     }else{
      echo "not added";
     }

    }else {
      echo "error in establishoing cnnection";
    }
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

/* body {
  background-color: #f2f2f2;
} */
        /* Style inputs with type="text", select elements and textareas */
input[type=text], select, textarea {
  width: 100%; /* Full width */
  padding: 12px; /* Some padding */ 
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
input[type=submit]:hover {
  background-color: #45a049;
}

/* Add a background color and some padding around the form */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

/*  */
table {
  
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #ccc;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
    </style>
</head>
<body>

<header-component></header-component>
<div class="container">
  <form action="feedback.php" method="post" >
    <label for="name">Your Name</label>
    <input type="text" id="name" name="name" placeholder="Your name..">
    <label for="feedback">Give feedback</label>
    <textarea id="subject" name="feedback" placeholder="Write something.." style="height:200px"></textarea>
    <input type="submit" name="submit" value="Submit">

  </form>
</div>


<!-- display data -->

<?php

$conn = mysqli_connect("localhost","root", "","file_manager");
if($conn){

    $query="select * from feedback";

    $result =mysqli_query($conn,$query);

    if($result){

        echo "<table border =1>
        <tr>
        <th>
      user Name
        </th>
        
        <th>
     Feedbackes
        </th>
        <th>
        time
        </th>
       
        </tr>


        ";
        while($row=mysqli_fetch_assoc($result)){
        
            echo "<tr>
            <td>".$row["user_name"]."</td>
            <td>".$row["user_feedback"]."</td>
            <td>".$row["upload_time"]."</td>
           
            </tr>";
           
        
        } 
        echo "</table>";


    }else{


    }


}
?>
</body>
</html>