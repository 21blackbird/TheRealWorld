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
            $userid = $_SESSION['id'];
            $query = "DELETE FROM cars WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $carId, $userid);
            $stmt->execute();
            $stmt->close();
        }

        function validateCSRFToken() {
            if (!isset($_SESSION['token']) || $_POST['token'] !== $_SESSION['token']) {
                errorMessage('Invalid CSRF token');
            }
            unset($_SESSION['token']);
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            validateCSRFToken();
            //add car into table
            if (isset($_POST['add'])) {
                $car = htmlspecialchars($_POST['car'], ENT_QUOTES, 'UTF-8');
                addCar($car);
            }
            
            //delete car from table
            if(isset($_POST['delete'])) {
                $carId = $_POST['car_id'];
                deleteCar($carId);
            }

            header("Location: ../pages/cars.php");
            die();
        }

    ?>