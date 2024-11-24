<?php
include 'db_connection.php'; // Include the database connection

// Capture form data
$customer_name = $_POST['customer_name'];
$info_type = $_POST['info_type'];

if ($info_type == 'purchase') {
    // Fetch purchase history
    $sql = "SELECT * FROM purchases WHERE customer_name = '$customer_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Purchase History for $customer_name</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<p>Details: " . $row['details'] . " | Date: " . $row['created_at'] . "</p>";
        }
    } else {
        echo "No purchase history found for $customer_name.";
    }
} else if ($info_type == 'service') {
    // Fetch service history
    $sql = "SELECT * FROM services WHERE customer_name = '$customer_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Service History for $customer_name</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<p>Details: " . $row['details'] . " | Date: " . $row['created_at'] . "</p>";
        }
    } else {
        echo "No service history found for $customer_name.";
    }
} else {
    echo "Invalid information type.";
}

$conn->close(); // Close connection
?>