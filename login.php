<?php
session_start();
include 'db_connection.php'; // For connecting to MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        
        if ($role == 'admin') {
            header('Location: admin_dashboard.php');
        } else {
            header('Location: candidate_dashboard.php');
        }
    } else {
        echo "Invalid login details.";
    }
}
?>