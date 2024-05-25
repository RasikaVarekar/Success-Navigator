<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login_register";

// Create connection
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Perform a query, check for errors
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

// Fetch result
$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

// Return JSON encoded data
echo json_encode($rows);

// Close connection
mysqli_close($conn);

?>
