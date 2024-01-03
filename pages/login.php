<?php
   session_start();

   if (isset($_SESSION['is_login'])) {
    header("Location: Home.php");
   }

   $_SESSION['token'] =  bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
    <form action="../controllers/auth.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <h2>Welcome to The Real World</h2>
        <?php 
            if(isset($_SESSION['error_message'])){
                $error = $_SESSION['error_message'];
                echo "<p>$error</p>";
            }
        ?>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <br>
        <br>
        <div class="goregis">
        don't have an account ? <a id="italic" href="./register.php">register now!</a>
        </div>
    </form>

</body>
</html>