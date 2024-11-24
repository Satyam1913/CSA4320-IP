<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentMethod = trim(filter_var($_POST['payment_method'], FILTER_SANITIZE_STRING));
    $productName = trim(filter_var($_POST['product_name'], FILTER_SANITIZE_STRING));
    $productPrice = trim(filter_var($_POST['product_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    
    // Number of days for delivery
    $deliveryDays = 5; // You can modify this number based on your delivery policy
    
    if ($paymentMethod === 'cash_on_delivery') {
        $paymentMessage = "Payment will be collected on delivery (Cash on Delivery).";
    } else {
        $paymentMessage = "Your payment has been successfully processed.";
    }
} else {
    echo "Error: Invalid request method.";
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f5f5f5;
            padding: 50px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        .container h1 {
            color: #28a745;
        }
        .container p {
            font-size: 18px;
        }
        .btn {
            background: linear-gradient(45deg, #28a745, #1e7e34);
            color: #ffffff;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
        }
        .btn:hover {
            background: linear-gradient(45deg, #1e7e34, #28a745);
            transform: scale(1.05);
        }
        .btn:active {
            background: linear-gradient(45deg, #1e7e34, #28a745);
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Confirmation</h1>
        <p>Your order for <strong><?php echo htmlspecialchars($productName); ?></strong> has been placed successfully!</p>
        <p><?php echo $paymentMessage; ?></p>
        <p><strong>Total Amount:</strong> ₹<?php echo htmlspecialchars($productPrice); ?></p>
        <p><strong>Estimated Delivery Time:</strong> Your order will be delivered in <?php echo $deliveryDays; ?> days.</p>
        <p><a href="index.html" class="btn">Home</a></p>
    </div>
</body>
</html>