<?php
// Include the database connection file
include_once 'database.php';

// SQL query to select records from the database
$sql = "SELECT * FROM users";

// Perform the query
$result = mysqli_query($conn, $sql);

if ($result) {
    // Initialize an empty array to store the records
    $records = array();

    // Fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
        // Push each row into the records array
        $records[] = $row;
    }

    // Close the connection
    mysqli_close($conn);

    // Encode the records array to JSON format
    echo json_encode($records);
} else {
    // If the query fails, return an error message
    echo json_encode(array('error' => 'Failed to fetch records.'));
}
?>
