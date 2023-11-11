<?php

    session_start();
    require "./connection.php";

    function addCar($car) {
        global $conn;
        $username = $_SESSION['username'];
        $getid = "SELECT id FROM users WHERE username='$username';";
        $userid = $conn->query($getid)->fetch_assoc()['id'];
        $query = "INSERT INTO cars (user_id, name) VALUES ($userid, '$car');";
        $result = $conn->query($query);
        return $result;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        //add car into table
        if (isset($_POST['add'])) {
            $car = $_POST['car'];
            addCar($car);
            $_SESSION['car'][] = $car;
            header("Location: ../pages/cars.php");
        }

        //delete car from table
        else if (isset($_POST['delete'])) {

        }
    }

?>