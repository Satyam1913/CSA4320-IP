<?php
// Update request status based on action (accept or schedule)
if (isset($_POST['requestId']) && isset($_POST['action'])) {
    $requestId = $_POST['requestId'];
    $action = $_POST['action'];

    // Update database logic here
    // ...

    echo "Request updated successfully";
} else {
    echo "Invalid request";
}
?>