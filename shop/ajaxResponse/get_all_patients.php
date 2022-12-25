<?php

// Connect to the MySQL database
$host = 'localhost';
//$user = 'root';
$user = 'rgxszumy_pagshop';
//$password = '';
$password = 'Ici?6BhL+0rv';
$dbname = 'rgxszumy_hospital_pagmh';
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    http_response_code(500);
    exit;
}


// Build the SQL query
$sql = 'SELECT * FROM `patients`';

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

