<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Usually 'root' for local servers
$password = ""; // Default 'root' password on XAMPP is usually empty
$dbname = "ram_infotech"; // Use the name of the database you created

// Establish the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form data when it is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required POST data is set
    if (!empty($_POST['request_id']) && !empty($_POST['laptop_id']) && !empty($_POST['customer_name']) && 
        !empty($_POST['laptop_model']) && !empty($_POST['laptop_serial_number']) && 
        !empty($_POST['issue_description']) && !empty($_POST['service_date']) && !empty($_POST['service_time'])) {
        
        // Clean user inputs
        $requestId = htmlspecialchars($_POST['request_id']);
        $laptopId = htmlspecialchars($_POST['laptop_id']);
        $customerName = htmlspecialchars($_POST['customer_name']);
        $laptopModel = htmlspecialchars($_POST['laptop_model']);
        $laptopSerialNumber = htmlspecialchars($_POST['laptop_serial_number']);
        $issueDescription = htmlspecialchars($_POST['issue_description']);
        $serviceDate = htmlspecialchars($_POST['service_date']);
        $serviceTime = htmlspecialchars($_POST['service_time']);

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO scheduled_services (request_id, laptop_id, customer_name, laptop_model, laptop_serial_number, issue_description, service_date, service_time) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $requestId, $laptopId, $customerName, $laptopModel, $laptopSerialNumber, $issueDescription, $serviceDate, $serviceTime);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect with success message
            header("Location: ?success=1&date=$serviceDate&time=$serviceTime");
            exit();
        } else {
            echo "Error scheduling service: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Error: Missing required POST data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Service</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('logo.png');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            box-sizing: border-box; /* Add this to prevent expanding */
        }
        .btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Schedule Service</h2>
        <form action="" method="POST" id="schedule-service-form">
            <div class="form-group">
                <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                <input type="hidden" name="laptop_id" value="<?php echo htmlspecialchars($laptop_id); ?>">
            </div>
            <div class="form-group">
                <label for="customer_name">Customer Name:</label>
                <input type="text" name="customer_name" value="Murali" required class="form-control">
            </div>
            <div class="form-group">
                <label for="laptop_model">Laptop Model:</label>
                <input type="text" name="laptop_model" value="Redmi" required class="form-control">
            </div>
            <div class="form-group">
                <label for="laptop_serial_number">Laptop Serial Number:</label>
                <input type="text" name="laptop_serial_number" value="123456" required class="form-control">
            </div>
            <div class="form-group">
                <label for="issue_description">Issue Description:</label>
                <textarea name="issue_description" required class="form-control">wqdqwd</textarea>
            </div>
            <div class="form-group">
                <label for="service_date">Service Date:</label>
                <input type="date" name="service_date" required class="form-control">
            </div>
            <div class="form-group">
                <label for="service_time">Service Time:</label>
                <input type="time" name="service_time" required class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Schedule Service" class="btn btn-primary">
            </div>
        </form>

        <?php
        // Check if the service has been scheduled successfully
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            $serviceDate = htmlspecialchars($_GET['date']);
            $serviceTime = htmlspecialchars($_GET['time']);
            echo "<p>Service scheduled successfully on $serviceDate at $serviceTime!</p>";
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>