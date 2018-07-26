<?php
    session_start();
    include_once "database.php";
    if (isset($_POST["email"]) and isset($_POST["password"])) {
        $database = new Database();
        $conn = $database->getConnection();
        $email = $_POST["email"];
        $password =  $_POST["password"];
        $sql = "SELECT * FROM `users` WHERE `email`='$email' and `password`='$password'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
        } else {
            echo "Something went wrong...";
            $_SESSION['message'] = "Invalid email or password.";
            header('Location: ../login');
            exit;
        }
        $database->closeConnection();
    }
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "Hello, " . $username . "!";
        echo "<a href='logout.php'>Logout</a>";
        header('Location: ../posts');
    }
    
?>