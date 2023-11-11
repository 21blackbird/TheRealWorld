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
    <script src="../scripts/script.js" defer></script>
</head>
<body>
    <div class="navbar">
        <a href="./home.php">Home</a>
        <a href="./cars.php">Car List</a>
        <a href="./profile.php">Profile</a>
        <a href="./login.php">logout</a>
    </div>

<h1 id="top">Here's your Car List !</h1>

<form action="../controllers/carcontroller.php" method="POST">
    <input type="text" id="carInput" name="car" placeholder="Enter Your Car Name G!">
    <button id="addButton" onclick="addCar()" name="add">Add Car</button>
</form>

<table>
    <thead>
        <tr>
            <th>Car Name</th>
        </tr>
</thead>
    <tbody id="car-Table-Body">
    <?php
        if (isset($_SESSION['car']) && is_array($_SESSION['car'])) {
            foreach ($_SESSION['car'] as $carName) {
                echo '<tr><td>' . $carName . '</td></tr>';
            }
        }
    ?>
    </tbody>
</table>


<div class="footer">
    &copy; 2023 Your Website. All rights reserved.
</div>

</body>
</html>