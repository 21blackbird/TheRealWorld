<?php
//    session_start();

//    if ($_SESSION['is_login'] !== true) {
//      header("Location: login.php");  
//    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="navbar">
        <a href="./home.php">Home</a>
        <a href="./cars.php">Car List</a>
        <a href="./profile.php">Profile</a>
        <a href="./login.php">logout</a>
    </div>

<h1 id="top">Here's your Car List !</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
        </tr>
</thead>
    <tbody>
        <tr>
            <td>Bugatti</td>
        </tr>
        <tr>
            <td>Mustang</td>
        </tr>
        <!-- Add more rows as needed -->
    </tbody>
</table>

<div class="footer">
    &copy; 2023 Your Website. All rights reserved.
</div>

</body>
</html>