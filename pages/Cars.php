<?php
   session_start();

   if ($_SESSION['is_login'] !== true) {
     header("Location: login.php");  
   }
    
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

</body>
</html>