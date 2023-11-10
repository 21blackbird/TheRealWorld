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
        <a href="./Home.php">Home</a>
        <a href="./Cars.php">Car List</a>
    </div>

    <h1 id="top">Your Cars !</h1>


</body>
</html>