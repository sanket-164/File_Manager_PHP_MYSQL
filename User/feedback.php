<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:../Authentication/SignIn.php");
    exit();
}

$con = mysqli_connect("localhost:3307", "root", "", "file_manager");
if (isset($_POST['feedback_submit'])) {
  if ($con) {
    $get_name = "SELECT name FROM user_info WHERE username='" . $_SESSION['username'] . "'";

    if ($result = mysqli_query($con, $get_name)) {
      if ($row = mysqli_fetch_assoc($result)) {
        
        $inFeedback = "INSERT INTO feedback (name, feedback) VALUES ('" . $row['name'] . "','" . $_POST['feedback'] . "');";

        if (mysqli_query($con, $inFeedback)) {
          $_SESSION['message'] = "Thanks For Your Feedback";
        } else {
          $_SESSION['message'] = "Feedback did not submit";
        }
      }
    } else {
      $_SESSION['message'] = "Feedback did not submit";
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
      box-sizing: border-box;
      margin-top: 6px;
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
    <div class="feedback-container py-2 mt-3">
      <form action="feedback.php" method="post">

        <div class="d-flex flex-column">
          <label for="feedback" class="mx-4" ><h2>Give Feedback</h2></label>
          <textarea id="subject" class="m-3" name="feedback" placeholder="Write something.."
            style="height:200px;resize: none" width="50%"></textarea>
        </div>
        <div class="d-flex justify-content-center">
          <input type="submit" class="btn btn-dark px-4 my-3" name="feedback_submit" value="Submit">
        </div>
      </form>

      <?php
      $get_feedbacks = "SELECT * FROM feedback ORDER BY feedback_time DESC LIMIT 10";

      if ($con) {
        if ($result = mysqli_query($con, $get_feedbacks)) {
          echo "<div class=\"d-flex\">
                  <table class=\"m-3 \" border =1>
                      <tr>
                        <th>Name</th>    
                        <th>Feedback</th>
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
          echo "</table></div>";
        }
      } else {
        echo mysqli_connect_error();
      }
      ?>
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