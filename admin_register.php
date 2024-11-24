<?php
include 'db_connection.php'; // Include the database connection

// Capture form data
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt the password
$email = $_POST['email'];

// Insert into the admin table
$sql = "INSERT INTO admins (username, password, email) VALUES ('$username', '$password', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Admin registered successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); // Close connection
?>