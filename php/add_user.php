<?php
    session_start();
    if (isset($_POST["username"]) and isset($_POST["email"]) and isset($_POST["password"]))
    {
        include_once "database.php";
        $database = new Database();
        $conn = $database->getConnection();
        $user = $_POST["username"];
        $email = $_POST["email"];
        $password =  $_POST["password"];
        $lowername = strtolower($user);
        $sql = "SELECT * FROM `users` WHERE `lowername`='$lowername' or `email`='$email'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $_SESSION['message'] = "Account with this username or email already exists.";
            echo "Account with this username or email already exists.";
            header('Location: ../register');
            exit;
        }
        $sql = "INSERT INTO `users` (`username`, `lowername`, `email`, `password`)
    VALUES ('$user', '$lowername', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('Location: /main.html');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $database->closeConnection();
    }
    
?>