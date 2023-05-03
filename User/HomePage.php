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
        <script src="./Javascript/NavBar.js"></script>
</head>

<body>
    <header-component></header-component>
    <div class="container">

        <div class="dropdown my-3" align="right">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Select Extension
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="./HomePage.php?extension=all">All</a></li>
                <li><a class="dropdown-item" href="./HomePage.php?extension=pdf">PDFs</a></li>
                <li><a class="dropdown-item" href="./HomePage.php?extension=docx">DOCXs</a></li>
                <li><a class="dropdown-item" href="./HomePage.php?extension=xlsx">XLSXs</a></li>
            </ul>
        </div>

        <table class="table" style="border: 2px solid black;">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">File Name</th>
                    <th scope="col">Extension</th>
                    <th scope="col">Size</th>
                    <th scope="col">Download</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>pdf</td>
                    <td>2bytes</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>docx</td>
                    <td>5bytes</td>
                    <td>Download</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>WNS_Sanket_P4.xlsx</td>
                    <td>xlsx</td>
                    <td>7 Bytes</td>
                    <td>Download</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>