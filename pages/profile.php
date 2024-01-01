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
    <title>Home</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
<div class="navbar">
        <a href="./home.php">Home</a>
        <a href="./cars.php">Car List</a>
        <a href="./profile.php">Profile</a>
        <a href="../controllers/logout.php">logout</a>
    </div>

<div class="section">
    Username: <?php echo $_SESSION['username'] ?>
    <br>
    Email : <?php echo $_SESSION['email'] ?>
    <br>
    Phone Number : <?php echo $_SESSION['phone'] ?>
    <br>
</div>

<div class="footer">
     &copy; 2023 Your Website. All rights reserved.
</div>

</body>
</html>