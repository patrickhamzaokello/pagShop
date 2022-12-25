<?php
include_once "config.php";


// Check if the ID was provided in the query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Build the SQL query
$sql = 'SELECT * FROM chargess';
if ($id) {
    $sql .= ' WHERE charge_category_id = ' . $id;
}

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    http_response_code(500);
    exit;
}

// Fetch the rows as an array
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the connection
mysqli_close($conn);

// Set the content type to JSON
header('Content-Type: application/json');

// Convert the array to JSON and echo it
echo json_encode($products);

