<?php
// Connect to the MySQL database
$conn = mysqli_connect('localhost', 'root', '', 'rgxszumy_hospital_pagmh');

// Define the query as a prepared statement with placeholders
$query = "SELECT id,name,charge_type_id,description FROM charge_categories limit 40";

// Prepare the statement
$stmt = mysqli_prepare($conn, $query);

// Execute the statement
mysqli_stmt_execute($stmt);

// Bind the result set to a variable
mysqli_stmt_bind_result($stmt, $id, $name, $charge_type_id, $description);

// Initialize an array to hold the categories
$categories = array();

// Fetch the rows from the result set
while (mysqli_stmt_fetch($stmt)) {
  $categories[] = array(
    'id' => $id,
    'name' => $name,
    'charge_type_id' => $charge_type_id,
    'description' => $description,
  );
}

// Convert the list of categories to a JSON string
$categoriesJson = json_encode($categories);

// Output the list of categories as a JavaScript variable
echo "<script>var categories = $categoriesJson;</script>";

?>