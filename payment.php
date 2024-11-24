<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - SS Agrimart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1, h3 {
            text-align: center;
            font-size: 1.5em;
        }
        img {
            width: 100%;
            max-width: 300px;
            display: block;
            margin: 0 auto;
        }
        .button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-size: 1em;
            border-radius: 4px;
            width: 100%;
        }
        .button:hover {
            background-color: #218838;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        textarea {
            resize: none;
            height: 80px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        label {
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .card-info {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['product_name']) && isset($_GET['product_price']) && isset($_GET['product_img'])) {
            $productName = filter_var($_GET['product_name'], FILTER_SANITIZE_STRING);
            $productPrice = filter_var($_GET['product_price'], FILTER_VALIDATE_FLOAT);
            $productImg = filter_var($_GET['product_img'], FILTER_SANITIZE_URL);
        } else {
            echo "Error: Invalid or missing input";
            exit;
        }
        ?>
        <h1>Confirm Your Purchase</h1>
        <img src="<?php echo htmlspecialchars($productImg); ?>" alt="<?php echo htmlspecialchars($productName); ?>">
        <h2><?php echo htmlspecialchars($productName); ?></h2>
        <p><strong>Price:</strong> ₹<?php echo number_format($productPrice, 2); ?></p>

        <form id="paymentForm" action="confirmation.php" method="post">
            <h3>Select Payment Method</h3>
            <label>
                <input type="radio" name="payment_method" value="cash_on_delivery" required> Cash on Delivery
            </label><br>
            <label>
                <input type="radio" name="payment_method" value="debit_card" required> Debit Card
            </label><br>
            <label>
                <input type="radio" name="payment_method" value="credit_card" required> Credit Card
            </label>

            <div class="card-info">
                <h3>Card Information</h3>
                <div class="form-group">
                    <label for="card_number">Card Number *</label>
                    <input type="text" id="card_number" name="card_number">
                </div>
                <div class="form-group">
                    <label for="card_expiration">Expiration Date *</label>
                    <input type="text" id="card_expiration" name="card_expiration">
                </div>
                <div class="form-group">
                    <label for="card_cvv">CVV *</label>
                    <input type="text" id="card_cvv" name="card_cvv">
                </div>
            </div>

            <div class="form-group">
                <label for="full_name">Full Name (required)*</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number (required)*</label>
                <input type="number" id="phone_number" name="phone_number" required>
            </div>

            <div class="form-group">
                <label for="pincode">Pincode (required)*</label>
                <input type="number" id="pincode" name="pincode" required>
            </div>

            <div class="form-group">
                <label for="state">State (required)*</label>
                <input type="text" id="state" name="state" required>
            </div>

            <div class="form-group">
                <label for="city">City (required)*</label>
                <input type="text" id="city" name="city" required>
            </div>

            <div class="form-group">
                <label for="house_no">House No, Building Name (required)*</label>
                <input type="text" id="house_no" name="house_no" required>
            </div>

            <div class="form-group">
                <label for="road_name">Road Name, Area, Colony (required)*</label>
                <textarea id="road_name" name="road_name" rows="2" required></textarea>
            </div>

            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($productName); ?>">
            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars(number_format($productPrice, 2)); ?>">

            <button type="submit" class="button">Confirm Payment</button>
        </form>

        <script>
            (function() {
                const paymentMethodRadios = document.getElementsByName("payment_method");
                const cardInfoDiv = document.querySelector(".card-info");

                paymentMethodRadios.forEach((radio) => {
                    radio.addEventListener("change", function() {
                        cardInfoDiv.style.display = (this.value === "debit_card" || this.value === "credit_card") ? "block" : "none";
                    });
                });

                const cardNumberInput = document.getElementById('card_number');
                cardNumberInput.addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '').replace(/(\d{4})(\d)/, '$1-$2').replace(/(\d{4}-)(\d{4})(\d)/, '$1$2-$3').substring(0, 19);
                });

                const expirationInput = document.getElementById('card_expiration');
                expirationInput.addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '').replace(/(\d{2})(\d)/, '$1/$2').substring(0, 5);
                });

                // No need for additional code to add hidden fields
                // form submission will carry all necessary data
            })();
        </script>
    </div>
</body>
</html>