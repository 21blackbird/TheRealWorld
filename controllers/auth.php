<?php
    session_start();
    require "./connection.php";

    function doLogin($username) {
        global $conn;
        $query = "SELECT * FROM users WHERE username=?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function errorMessage(){
        $_SESSION["error_message"] = "Login Failed";
        header("Location: ../pages/login.php");
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $login_result = doLogin($username);
        if($login_result->num_rows < 1 || $login_result->num_rows > 1){
            errorMessage();
        }

        $data = $login_result->fetch_assoc();
        $isVerified = password_verify($password, $data['password']);

        if(!$isVerified){
            errorMessage();
        }

        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $data["username"];
        $_SESSION["email"] = $data["email"];
        $_SESSION["phone"] = $data["phone"];

        header("Location: ../pages/home.php");
    }
?>