<?php
session_start();

$con = mysqli_connect("localhost:3307", "root", "", "file_manager");
if (isset($_POST['feedback_submit'])) {
  if ($con) {
    $get_name = "SELECT name FROM user_info WHERE username=". $_SESSION['username'];
    
    $inFeedback = "INSERT INTO feedback VALUES ('" . $_POST['name'] . "',
        '" . $_POST['feedback'] . "');";

    $result = mysqli_query($con, $query);
    if ($result) {
      echo "added";
    } else {
      echo "not added";
    }

  } else {
    echo mysqli_connect_error();
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
    .feedback-container {
      background-color: #f2f2f2;
    }

    textarea {
      border-radius: 4px;
      /* Rounded borders */
      box-sizing: border-box;
      /* Make sure that padding and width stays in place */
      margin-top: 6px;
      /* Add a top margin */
      margin-bottom: 16px;
      /* Bottom margin */
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
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
    <br />
    <div class="feedback-container py-3">
      <form action="feedback.php" method="post">
        <label for="feedback">Give feedback</label>
        <textarea id="subject" class="m-3 container form-control" name="feedback" placeholder="Write something.."
          style="height:200px" width="50%"></textarea>
        <div class="d-flex justify-content-center">
          <input type="submit" class="btn btn-dark px-4" name="feedback_submit" value="Submit">
        </div>
      </form>

      <?php
      $get_feedbacks = "SELECT * FROM feedback";

      if ($con) {
        if ($result = mysqli_query($con, $get_feedbacks)) {
          echo "<table border =1>
                      <tr>
                        <th>Name</th>    
                        <th>Feedbacks</th>
                        <th>Time</th>
                      </tr>
              ";
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
              <td>" . $row["name"] . "</td>
              <td>" . $row["feedback"] . "</td>
              <td>" . $row["feedback_time"] . "</td>
             </tr>";
          }
          echo "</table>";
        }
      } else {
        echo mysqli_connect_error();
      }
      ?>
    </div>
  </div>
</body>

</html>