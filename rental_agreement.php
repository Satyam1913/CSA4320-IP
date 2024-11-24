<?php
include 'db_connection.php';

// Capture form data
$customer_name = $_POST['customer_name'];
$rental_period = $_POST['rental_period'];
$laptop_model = $_POST['laptop_model'];

// Insert rental information into the database
$sql = "INSERT INTO rentals (customer_name, rental_period, laptop_model) 
        VALUES ('$customer_name', '$rental_period', '$laptop_model')";

if ($conn->query($sql) === TRUE) {
    echo "Rental agreement submitted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>