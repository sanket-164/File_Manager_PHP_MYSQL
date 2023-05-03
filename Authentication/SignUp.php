<?php
if (isset($_POST['submit'])) {
    $con = mysqli_connect("localhost:3307", "root", "", "file_manager");

    $check_username = "SELECT username FROM user_info WHERE username='" . $_POST['signup_username'] . "';";

    $result = mysqli_query($con, $check_username);
    if (mysqli_fetch_array($result)) {
        header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignUp.php?error=Username Already Exist");
        exit();
    } else {
        $check_email = "SELECT user_email FROM user_info WHERE user_email='" . $_POST['signup_email'] . "';";

        $result = mysqli_query($con, $check_email);
        if (mysqli_fetch_array($result)) {
            header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignUp.php?error=Email is Already Registered");
            exit();
        } else {
            $check_number = "SELECT user_mobile FROM user_info WHERE user_mobile='" . $_POST['signup_number'] . "';";

            $result = mysqli_query($con, $check_number);
            if (mysqli_fetch_array($result)) {
                header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignUp.php?error=Number is Already Registered");
                exit();
            } else {
                if ($con) {

                    $insert_user = "INSERT INTO user_info VALUES ('" . $_POST['signup_username'] . "',
                        '" . $_POST['signup_password'] . "',
                        '" . $_POST['signup_name'] . "',
                        '" . $_POST['signup_email'] . "',
                        '" . $_POST['signup_number'] . "',
                        '" . $_POST['signup_dob'] . "',
                        null);";

                    if (mysqli_query($con, $insert_user)) {
                        $create_table = "CREATE TABLE " . $_POST['signup_username'] . "(
                            file_name VARCHAR(255) NOT NULL,
                            file_extension VARCHAR(20) NOT NULL,
                            file_size INTEGER NOT NULL,
                            file_content BLOB NOT NULL,
                            upload_time datetime NOT NULL
                        );";

                        if (mysqli_query($con, $create_table)) {
                            header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignIn.php");
                            exit();
                        } else {
                            header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignUp.php?error=Some error occured");
                            exit();
                        }
                    } else {
                        header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignUp.php?error=Some error occured");
                        exit();
                    }
                } else {
                    echo mysqli_connect_error();
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>

<body>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const myParam = urlParams.get('error');
        if (myParam) {
            alert(myParam);
        }
    </script>
    <div class="container" id="sinup_container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="sinup_form" class="mx-5" method="post">
            <h1 class="my-3">Sign Up</h1>

            <div class="mb-3">
                <label for="signup_username" class="form-label">Username</label>
                <input type="text" class="form-control" id="signup_username" name="signup_username"
                    placeholder="Enter Username" maxLength="15" minLength="5" required="true">
            </div>
            <div class="mb-3">
                <label for="signup_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="signup_name" name="signup_name" placeholder="Name"
                    required="true">
            </div>
            <div class="mb-3">
                <label for="signup_email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="signup_email" name="signup_email"
                    placeholder="name@example.com" required="true">
            </div>
            <div class="mb-3">
                <label for="signup_number" class="form-label">Mobile Number</label>
                <input type="number" class="form-control" id="signup_number" name="signup_number"
                    placeholder="Phone Number" required="true">
            </div>
            <div class="mb-3">
                <label for="signup_dob" class="form-label">Birthdate</label>
                <input type="date" class="form-control" id="signup_dob" name="signup_dob" required="true">
            </div>
            <div class="mb-3">
                <label for="signup_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="signup_password" name="signup_password"
                    placeholder="Enter Password" maxLength="15" minLength="5" required="true">
            </div>
            <div class="d-flex justify-content-center w-full">
                <input type="submit" class="btn btn-dark px-5 py-2 my-2" name="submit" value="Sign Up">
            </div>
        </form>
    </div>
</body>

</html>