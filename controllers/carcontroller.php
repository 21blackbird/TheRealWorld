<?php

    session_start();
    require "./connection.php";

    function addCar($car) {
        global $conn;
        $userid = $_SESSION['id'];
        $query = "INSERT INTO cars (user_id, name) VALUES (?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $userid, $car);
        $stmt->execute();
        $result = $stmt->get_result();
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