<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $to = 'recipient@example.com';
        $subject = 'Contact Form Message';
        $body = "Name: $name\nEmail: $email\nMessage: $message";
        $headers = "From: $email\r\nReply-To: $email\r\n";

        // Use the mail() function to send the email
        $sendmail = mail($to, $subject, $body, $headers);

        // Check if the email was sent successfully
        if ($sendmail) {
            // Redirect to success page
            header('Location: success.php');
            exit;
        } else {
            echo "Error sending email. Please try again.";
        }
    }
}
?>