<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
    <style>
        body {
            background-image: url('logo.png'); /* Set the background image */
            background-size: cover; /* Cover the entire page */
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%; /* Set the width of the container */
            margin: 40px auto; /* Center the container */
            padding: 20px;
            background-color: #f9f9f9; /* Set the background color */
            border: 1px solid #ccc; /* Add a border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a box shadow */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contact Form</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br><br>
            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea><br><br>
            <input type="submit" value="Send">
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = htmlspecialchars(trim($_POST['name']));
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                $message = htmlspecialchars(trim($_POST['message']));

                $errors = array();

                // Validate email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format.";
                }

                if (empty($errors)) {
                    $to = 'recipient@example.com';
                    $subject = 'Contact Form Message';
                    $body = "Name: $name\nEmail: $email\nMessage: $message";
                    $headers = "From: " . $email . "\r\nReply-To: " . $email . "\r\n";

                    // Use the mail() function to send the email
                    $sendmail = mail($to, $subject, $body, $headers);

                    // Check if the email was sent successfully
                    if ($sendmail) {
                        // Redirect to the success page if email is sent
                        header("Location: success.html");
                        exit();
                    } else {
                        $errors[] = "Error sending email. Please try again.";
                    }
                }

                // Display error messages
                if (!empty($errors)) {
                    echo "<ul>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                }
            }
        ?>
    </div>
</body>
</html>