<?php
$conn ="";
include_once "config.php";


// Build the SQL query
$sql = 'SELECT id,name,charge_type_id,description FROM charge_categories';


// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    http_response_code(500);
    exit;
}

// Fetch the rows as an array
$all_charges_results = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the connection
mysqli_close($conn);

// Set the content type to JSON
header('Content-Type: application/json');

// Convert the array to JSON and echo it
echo json_encode($all_charges_results);

