<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $json_data = file_get_contents("php://input");
    // Decode JSON data
    $data = json_decode($json_data, true);

    // Check if JSON data is valid
    if (!$data) {
        // Return error response if JSON data is not received
        echo json_encode(array("error" => "Invalid JSON data"));
        exit;
    }

    // Example: Compare user responses with correct answers
    $host = 'localhost';
    $dbname = 'test1_database';
    $username = 'root';
    $password = '';

    try {
        // Establish database connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Iterate through user responses
        foreach ($data as $response) {
            $questionId = $response['questionId'];
            $selectedOptionIndex = $response['selectedOptionIndex'];

            // Query to retrieve correct answer from the database
            $stmt = $conn->prepare("SELECT correct FROM tests1 WHERE id = ?");
            $stmt->execute([$questionId]);
            $correctOptionIndex = $stmt->fetchColumn();

            // Compare selected option with correct answer
            $isCorrect = ($selectedOptionIndex == $correctOptionIndex);

            // Update database with user response (you may want to store this information)
            // For demonstration, let's just return whether the answer is correct
            $response['isCorrect'] = $isCorrect;
        }

        // Return response indicating correctness of each answer
        header('Content-Type: application/json');
        echo json_encode($data); // Return same data for simplicity (you can customize response as needed)
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
} else {
    // Return error response if request method is not POST
    echo json_encode(array("error" => "Invalid request method"));
}
?>
