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
        $stmt->close();
    }
    
    function deleteCar($carId) {
        global $conn;
        $query = "DELETE FROM cars WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $carId);
        $stmt->execute();
        $stmt->close();
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        //add car into table
        if (isset($_POST['add'])) {
            $car = htmlspecialchars($_POST['car'], ENT_QUOTES, 'UTF-8');
            addCar($car);
        }
        
        //delete car from table
        if(isset($_POST['delete'])) {
            $carId = htmlspecialchars($_POST['car_id'], ENT_QUOTES, 'UTF_8');
            deleteCar($carId);
        }

        header("Location: ../pages/cars.php");
        die();
    }

?>