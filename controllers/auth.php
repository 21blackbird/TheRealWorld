    <?php
        session_start();
        require "./connection.php";

        function doLogin($username) {
            global $conn;
            $query = "SELECT id, username, email, password, phone, failed_login_attempt, UNIX_TIMESTAMP(failed_login_time) as failed_login_time FROM users WHERE username=?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s",$username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        function errorMessage($message='Login Failed'){
            $_SESSION["error_message"] = $message;
            header("Location: ../pages/login.php");
            die();
        }

        function logFailedLogin($id, $current_Time){
            global $conn;
            $query = "UPDATE users SET failed_login_attempt = failed_login_attempt + 1, failed_login_time = FROM_UNIXTIME(?) WHERE id = ? ;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $current_Time, $id);
            $stmt->execute();
            $stmt->close();
        }

        function resetLoginAttempt($id){
            global $conn;
            $query = "UPDATE users SET failed_login_attempt = 0, failed_login_time = NULL WHERE id = ?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
        
        function checkLoginAttempt($id, $attempts, $current_Time, $failed_login_time){
            $limit = 5;
            $timelimit = 300; // in seconds
            $timediff = $current_Time - $failed_login_time;

            if($attempts <= $limit){
                return;
            }

            if($timediff > $timelimit){
                resetLoginAttempt($id);
                return;
            }

            $waitTime = $timelimit-$timediff;
            errorMessage('You have reached the login limit, please wait '. $waitTime .' seconds');
        }

        function validateCSRFToken() {
            if (!isset($_SESSION['token']) || $_POST['token'] !== $_SESSION['token']) {
                errorMessage('Invalid CSRF token');
            }
            unset($_SESSION['token']);
        }
        
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            validateCSRFToken();
            $current_Time = time();
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $login_result = doLogin($username);
            if($login_result->num_rows < 1 || $login_result->num_rows > 1){
                errorMessage('Your username/password is wrong');
            }
            
            $data = $login_result->fetch_assoc();
            $attempts = $data['failed_login_attempt'];
            $failed_login_time = $data['failed_login_time'];
            $id = $data['id'];
            
            checkLoginAttempt($id, $attempts, $current_Time, $failed_login_time);
            
            $isVerified = password_verify($password, $data['password']);

            if(!$isVerified){
                logFailedLogin($id, $current_Time);
                errorMessage('Your username/password is wrong');
            }
            // Token for successful login
            $_SESSION['token'] =  bin2hex(random_bytes(32));
            $_SESSION['expiration'] = time() + 36000;

            if($attempts != 0){
                resetLoginAttempt($id);
            }

            $_SESSION['is_login'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $data["username"];
            $_SESSION["email"] = $data["email"];
            $_SESSION["phone"] = $data["phone"];

            header("Location: ../pages/home.php");
        }
    ?>