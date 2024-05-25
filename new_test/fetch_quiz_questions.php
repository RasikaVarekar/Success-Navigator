<?php
// Establish database connection (replace with your actual database credentials)
$host = 'localhost';
$dbname = 'test1_database';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch quiz questions and options from the database
    $sql = "SELECT id, question, option1, option2, option3, option4 FROM tests1";
    $stmt = $conn->query($sql);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the questions as JSON
    header('Content-Type: application/json');
    echo json_encode($questions);
} catch(PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
