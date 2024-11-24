<?php
session_start(); // Start session

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html"); // Redirect to login if not logged in
    exit();
}

echo "Welcome, " . $_SESSION['admin'] . "!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Ram Infotech</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <main>
        <p>Manage Sales, Services, and Stock here.</p>
        <!-- Add dashboard options here -->
    </main>

    <footer>
        <p>&copy; 2024 Ram Infotech</p>
    </footer>
</body>
</html>