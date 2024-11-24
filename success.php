<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Sent Successfully</title>
    <style>
        * {
            box-sizing: border-box; /* Add this for consistent box model behavior */
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-image: url('logo.png'); /* Make sure the file path is correct */
            background-size: cover; /* Use a more flexible approach */
            background-position: center top 20%;
            color: white;
        }
        .message-container {
            background-color: white;
            color: #333;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            margin-top: 100px;
            max-width: 80%;
            margin-left: 20%; /* Add this to move the container to the right */
        }
        .home-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .home-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Message Sent Successfully!</h1>
        <p>Thank you for contacting us. We will get back to you soon.</p>
        <button class="home-button" onclick="location.href='index.html'">Home</button>
    </div>
</body>
</html>