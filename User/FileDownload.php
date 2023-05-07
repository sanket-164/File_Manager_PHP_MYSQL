<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:../Authentication/SignIn.php");
    exit();
}
include("../Database.php");

if (isset($_GET['download_file'])) {

    if ($con) {

        $get_file = "SELECT file_name, file_size, file_content FROM " . $_SESSION['username'] . " WHERE file_id=" . $_GET['download_file'] . "";

        $result = mysqli_query($con, $get_file);
        if (isset($result)) {

            while ($row = mysqli_fetch_assoc($result)) {
                $file_name = $row['file_name'];
                $file_size = $row['file_size'];
                $file_content = $row['file_content'];

                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $file_name . '"');
                header('Content-Length: ' . $file_size);
                echo $file_content;
                exit();
            }
        } else {
            echo "<h1>Some Error Occured</h1>";
        }
    }
} 
?>