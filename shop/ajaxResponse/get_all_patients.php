<?php
$conn ="";

// Connect to the MySQL database
include_once "config.php";


// Build the SQL query
$sql = 'SELECT * FROM `patients` ORDER BY `patients`.`id` DESC';

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    http_response_code(500);
    exit;
}

// Fetch the rows as an array
$patients = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the connection
mysqli_close($conn);

// Set the content type to JSON
header('Content-Type: application/json');

// Convert the array to JSON and echo it
echo json_encode($patients);

