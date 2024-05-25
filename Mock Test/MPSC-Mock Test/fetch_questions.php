<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'test1_database';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Error: Unable to connect to MySQL database');
}

// Fetch quiz questions from the database
$query = "SELECT * FROM quiz_questions";
$result = mysqli_query($conn, $query);

$quizQuestions = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $quizQuestions[] = [
            'question' => $row['question'],
            'options' => [$row['option1'], $row['option2'], $row['option3'], $row['option4']],
            // Add more fields as needed
        ];
    }
}

// Close connection
mysqli_close($conn);

// Return quiz questions as JSON
header('Content-Type: application/json');
echo json_encode($quizQuestions);
?>
