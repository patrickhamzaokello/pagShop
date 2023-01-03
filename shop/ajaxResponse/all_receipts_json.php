<?php
$conn ="";
include_once "config.php";


// Build the SQL query
$sql = 'SELECT m.id as id, m.order_id, p.patient_name, p.age, p.mobileno, p.email, p.gender,p.address, m.datecreated FROM medical_charge m INNER JOIN patients p ON m.user_id = p.id ORDER BY `m`.`datecreated` DESC';


// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    http_response_code(500);
    exit;
}

// Fetch the rows as an array
$all_orders_desc = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the connection
mysqli_close($conn);

// Set the content type to JSON
header('Content-Type: application/json');

// Convert the array to JSON and echo it
echo json_encode($all_orders_desc);

