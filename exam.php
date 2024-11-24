<?php
include 'db_connection.php'; // Include the database connection

// Capture the registration form data
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
$email = $_POST['email'];

// Insert the new admin into the database
$sql = "INSERT INTO admins (username, password, email) VALUES ('$username', '$password', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Admin registered successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); // Close the database connection
?>