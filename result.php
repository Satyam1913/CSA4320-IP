<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $answers = $_POST['answers']; // Assuming this is an array of submitted answers

    // Example evaluation logic
    $score = 0;
    $correct_answers = [1 => 'A', 2 => 'C', 3 => 'B']; // Example answers

    foreach ($correct_answers as $question_id => $correct_answer) {
        if (isset($answers[$question_id]) && $answers[$question_id] == $correct_answer) {
            $score++;
        }
    }

    // Insert the score into the database
    $query = "INSERT INTO results (username, score) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $username, $score);
    mysqli_stmt_execute($stmt);

    header('Location: result.php');
    exit;
} else {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM results WHERE username=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        echo "Your score: " . $row['score'];
        echo "<a href='download_scorecard.php'>Download Scorecard</a>";
    }
}
?>