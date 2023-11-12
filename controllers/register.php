<?php
    session_start();
    require "./connection.php";

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];

        // if($username->empty){
        //     // TODO: username validation
        // }
        // if($email->empty) {
        //     // TODO: email validation
        // }
        // if($password->empty){
        //     // TODO: password validation
        // }
        // if($phone->empty){
        //     // TODO: phone number validation
        // }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        global $conn;
        $query = "INSERT INTO users (username, email, password, phone) VALUES (?, ?, ?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $username, $email, $hash, $phone);
        $stmt->execute();
        
        header("Location: ../pages/login.php");
    }
?>