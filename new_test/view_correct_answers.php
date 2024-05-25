<?php
// Connect to the database (replace with your actual database credentials)
$host = 'localhost';
$dbname = 'test1_database';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to retrieve all correct answers from the database
    $stmt = $conn->query("SELECT id, correct FROM tests1");
    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return correct answers as JSON
    header('Content-Type: application/json');
    echo json_encode($answers);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
