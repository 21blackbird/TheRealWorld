<?php
    session_start();
    require "./connection.php";

    function errorMessage($message){
        $_SESSION["error_message"] = $message;
        header("Location: ../pages/Register.php");
        die();
    }

    function validateCSRFToken() {
        if (!isset($_SESSION['token']) || $_POST['token'] !== $_SESSION['token']) {
            errorMessage('Invalid CSRF token');
        }
        unset($_SESSION['token']);
    }
    
    function userAvail($username) {
        global $conn;
        $query = "SELECT * FROM users WHERE username = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $rows = $stmt->get_result()->num_rows;
        $stmt->close();
        return ($rows < 1) ? true : false;
    }

    function checkUsername($username) {
        if(empty($username)){
            return false;
        }
        
        $isAvailable = userAvail($username);
        
        if(!$isAvailable){
            return false;
        }
        
        // valid username, alphanumeric & longer than or equals 5 chars
        if(!preg_match('/^\w{5,}$/', $username)) {
            return false;
        }

        return true;
    }

    function checkEmail($email) {
        if(empty($email)){
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    function checkPassword($password, $confirm_password){
        if(empty($password) || empty($confirm_password)){
            return false;
        }
        
        // check if password == confirm password
        if($password !== $confirm_password){
            return false;
        }

        // check if Uppercase
        if(!preg_match('/[A-Z]/', $password)){
            return false;
        }
        
        // check if lowercase
        if(!preg_match('/[a-z]/', $password)){
            return false;
        }

        // check if contiain numbers
        if(!preg_match('/[0-9]/', $password)){
            return false;
        }

        // check if contain symbols
        if(!preg_match('/[\W_]/', $password)){
            return false;
        }

        return true;
    }

    function checkPhone($phone){
        if(empty($phone)){
            return false;
        }

        // check format
        if(!preg_match('/^[+]62\d{3}\d{4}\d{3,4}$/', $phone)){
            return false;
        }

        return true;
    }

    $_SESSION['token'] = bin2hex(random_bytes(32));

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        validateCSRFToken();
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['password'];
        $phone = $_POST['phone'];

        // Check Password
        if(checkPassword($password, $confirm_password) == false){
            errorMessage("Re-Input password properly!");
        }
        
        // Check Username
        if(checkUsername($username) == false) {
            errorMessage("Re-Input username properly!");
        }
        
        // Check Email
        if(checkEmail($email) == false) {
            errorMessage("Re-Input email properly!");
        }
        
        // Check phone
        if(checkPhone($phone) == false){
            errorMessage("Re-Input phone properly!");
        }

        // Take out +62
        $phone = substr($phone, 3);

        // Hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert into Database
        global $conn;
        $query = "INSERT INTO users (username, email, password, phone) VALUES (?, ?, ?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $username, $email, $hash, $phone);
        $stmt->execute();
        $stmt->close();
        
        // Header to Login
        header("Location: ../pages/login.php");
    }
?>