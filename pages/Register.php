<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../style/register.css">
</head>
<body>
    <div class="registration-container">
        <h2>Registration</h2>
        <form class="registration-form">
            <input type="text" name="username" placeholder="Username" required>
            <br>
            <input type="email" name="email" placeholder="Email" required>
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <br>
            <label>Phone Number :</label>
            <input type="tel" id ="phone" name="phone" placeholder="+62" pattern="+62[0-9]{11}" required>
            <br>
            <input type="submit" value="Register">

            <div>
            already have an account ? <a id="italic" href="./login.php">login now!</a>
            </div>
        </form>
    </div>
</body>
</html>