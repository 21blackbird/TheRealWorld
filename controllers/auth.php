<?php
    session_start();
    require "./connection.php";

    function doLogin($username, $password) {
    global $conn;
    $query = "SELECT * FROM users WHERE username=? AND password=?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
    }

    global $conn;

    $query = "SELECT * FROM users WHERE username=? AND password=?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    $stmt->get_result();


    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $login_result = doLogin($username, $password);

        if ($login_result->num_rows == 1) {
            $data = $login_result->fetch_assoc();
           $_SESSION['is_login'] = true;
           $_SESSION['username'] = $data["username"];
           $_SESSION["email"] = $data["email"];
           $_SESSION["phone"] = $data["phone"];
           $_SESSION["phone"] = $data["phone"];

           header("Location: ../pages/home.php");
        }

        else {
            $_SESSION["error_message"] = "Login Failed.";
            header("Location: ../pages/login.php");
        }

    }
?>