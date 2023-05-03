<?php
session_start();

if (isset($_POST['upload_submit'])) {

    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $fp = fopen($_FILES["file"]["tmp_name"], "rb");
        $data = fread($fp, filesize($_FILES["file"]["tmp_name"]));
        $file_name = $_FILES['file']['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_size = $_FILES['file']['size'];
        $upload_time = date("Y-m-d h:i:sa");
        fclose($fp);


        $con = mysqli_connect("localhost:3307", "root", "", "file_manager");

        if ($con) {

            $sql = "INSERT INTO " . $_SESSION['username'] . "  VALUES ('" . $file_name . "','" . $file_extension . "','" . $file_size . "','" . mysqli_real_escape_string($con, $data) . "','" . $upload_time . "')";
            if (mysqli_query($con, $sql)) {
                header("Location:http://localhost/File%20Manager%20(PHP)/User/Upload.php?message=File Uploaded");
                exit();
            } else {
                header("Location:http://localhost/File%20Manager%20(PHP)/User/Uploaded.php?message=Can't Upload File");
                exit();
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
    <title>Upload File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="./Javascript/NavBar.js"></script>

    <style>
        #maindiv {
            margin-right: 5%;
            margin-left: 5%;
            margin-top: 1%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        #choose_file_div {
            margin-left: 15%;
            display: inline-block;
        }
    </style>
</head>

<body>
    <header-component></header-component>
    <?php
    if (!isset($_SESSION['username'])) {
        header("Location:http://localhost/File%20Manager%20(PHP)/Authentication/SignIn.php");
        exit();
    }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="upload_form" class="mx-5" method="post"
        enctype="multipart/form-data">

        <div id="maindiv">
            <div class="d-flex justify-content-center">
                <div id="label_div">
                    <h3>Select File To Upload</h3>
                </div>
            </div>

            <div id="choose_file_div" class="d-flex justify-content-center my-3">
                <input type="file" id="file" name="file">
            </div>

            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-dark px-5 py-2 my-2" name="upload_submit" value="Upload">
            </div>

        </div>
    </form>

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