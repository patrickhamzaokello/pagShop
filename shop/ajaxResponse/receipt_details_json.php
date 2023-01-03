<?php
$conn ="";

include_once "config.php";


// Check if the ID was provided in the query string
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$id = "'" . $id . "'";

// Build the SQL query
$sql = 'SELECT mc.id, mc.medical_charge_id,mc.charge_id, c.name, mc.quantity,mc.price,mc.date_created FROM medical_charge_details mc INNER JOIN charges c on mc.charge_id=c.id';
if ($id) {
    $sql .= ' WHERE medical_charge_id = ' . $id;
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

