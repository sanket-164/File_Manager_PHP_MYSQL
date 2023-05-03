<?php
session_start();

if (isset($_POST["submit_download"])) {
    $con = mysqli_connect("localhost:3307", "root", "", "file_manager");
    if ($con) {
        echo "connected";

        //change yoyr query..
        $sql = "select file_name, file_size,file_content from " . $_SESSION['username'] . " where file_extension='php'";
        echo $sql;
        $result = mysqli_query($con, $sql);
        if (mysqli_fetch_array($result)) {

            while ($row = mysqli_fetch_assoc($result)) {
                $file_name = $row['file_name'];
                $file_size = $row['file_size'];
                $file_content = $row['file_content'];

                //must write this header otherwise file download nay thay
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $file_name . '"');
                header('Content-Length: ' . $file_size);
                readfile($file_content);

            }
            echo "<h1>file readed</h1>";
        } else {
            echo "<h1>no row found</h1>";
        }
    }
}


if (isset($_POST['submit'])) {

    // if file is selected all file info is save in variable
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $fp = fopen($_FILES["file"]["tmp_name"], "rb");
        $data = fread($fp, filesize($_FILES["file"]["tmp_name"]));
        $file_name = $_FILES['file']['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_size = $_FILES['file']['size'];
        $upload_time = date("Y-m-d h:i:sa");
        fclose($fp);


        $con = mysqli_connect("localhost:3307", "root", "", "file_manager");
        //upload to dtabase
        if ($con) {
            echo "connected";
            $sql = "INSERT INTO " . $_SESSION['username'] . "  VALUES ('" . $file_name . "','" . $file_extension . "','" . $file_size . "','" . mysqli_real_escape_string($con, $data) . "','" . $upload_time . "')";
            if (mysqli_query($con, $sql)) {
                echo "<h1>file upoloaded succesfully</h1>";
            } else {
                echo "<h1>fail to upoload</h1>";
            }
        }
        mysqli_close($con);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        #maindiv {

            margin-right: 5%;
            margin-left: 5%;
            margin-top: 1%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        /*  */
        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }

        .custom-file-input::before {
            content: 'Select some files';
            display: inline-block;
            background: linear-gradient(top, #f9f9f9, #e3e3e3);
            border: 1px solid #999;
            border-radius: 3px;
            padding: 5px 8px;
            outline: none;
            white-space: nowrap;
            -webkit-user-select: none;
            cursor: pointer;
            text-shadow: 1px 1px #fff;
            font-weight: 700;
            font-size: 10pt;
        }

        .custom-file-input:hover::before {
            border-color: black;
        }

        .custom-file-input:active::before {
            background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
        }

        /*  */
        #label_div {
            display: inline-block;
        }

        #choose_file_div {
            margin-left: 15%;
            display: inline-block;
        }

        #submit {}
    </style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <script src="./Javascript/NavBar.js"></script>
</head>

<body>
    <header-component></header-component>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="upload_form" class="mx-5" method="post"
        enctype="multipart/form-data">

        <div id="maindiv">
            <div id="label_div"><label>Upload your File for to our database :</label></div>

            <div id="choose_file_div">
                <input class="custom-file-input" type="file" id="file" name="file">
            </div>

            <div class="d-flex justify-content-center w-full" id="submit">
                <input type="submit" class="btn btn-dark px-5 py-2 my-2" name="submit" value="uploaded succesfully">
            </div>

        </div>
    </form>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="download_file  class=" mx-5" method="post"
        enctype="multipart/form-data">

        <div class="d-flex justify-content-center w-full" id="submit">
            <input type="submit" class="btn btn-dark px-5 py-2 my-2" name="submit_download" value="Download ">
        </div>

    </form>

</body>

</html>