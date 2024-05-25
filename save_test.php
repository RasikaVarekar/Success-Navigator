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

    // Extract data from the decoded JSON data
    $question = $data['question'];
    $options = $data['options'];
    $correctAnswer = $data['correctAnswer'];
    $course = $data['course'];

    // Example: Save the data to the database
    // Replace this with your actual database connection and query code
    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "test1_database";

    // Create connection
    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement
    $sql = "INSERT INTO tests1 (question, option1, option2, option3, option4, correct, course)
            VALUES ('$question', '$options[0]', '$options[1]', '$options[2]', '$options[3]', '$correctAnswer', '$course')";

    // Execute SQL statement
    if (mysqli_query($conn, $sql)) {
        // Return success response
        echo json_encode(array("message" => "Test saved successfully"));
    } else {
        // Return error response
        echo json_encode(array("error" => "Error saving test"));
    }

    // Close connection
    mysqli_close($conn);
} else {
    // Return error response if request method is not POST
    echo json_encode(array("error" => "Invalid request method"));
}
?>
