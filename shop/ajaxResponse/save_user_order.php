<?php
// Decode the data object from the request body
$data = json_decode(file_get_contents('php://input'), true);
$conn ="";
// Connect to the database
include_once "config.php";


// Prepare an INSERT statement
$stmt = $conn->prepare('INSERT INTO databd (user_id, name) VALUES (?, ?)');
$stmt->bind_param('ss', $data['value'], $data['text']);

// Execute the statement
$stmt->execute();

// Check for errors
if ($stmt->error) {
    die('Error: ' . $stmt->error);
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Return a message
echo 'Data added to database';
?>