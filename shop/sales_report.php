<?php

// Get the date from the query string
$date = $_GET['date'];

// Connect to the database
$host = 'localhost';
$dbname = 'rgxszumy_hospital_pagmh';
//$username = 'root';
//$password = '';
$username = 'rgxszumy_pagshop';
$password = 'wZ0fx9uWJ[@G';



$dsn = "mysql:host=$host;dbname=$dbname";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Prepare and execute the SQL query
$sql = "SELECT
            SUM(mcd.quantity * mcd.price) AS total_sales,
            c.name AS item_name,
            mcd.price AS unit_price,
            SUM(mcd.quantity) AS num_items_sold
        FROM
            medical_charge mc
            JOIN medical_charge_details mcd ON mc.order_id = mcd.medical_charge_id
            JOIN charges c ON mcd.charge_id = c.id
        WHERE
            DATE(mc.datecreated) = :date
        GROUP BY
            mcd.charge_id,
            c.name,
            mcd.price";

$stmt = $pdo->prepare($sql);
$stmt->execute(['date' => $date]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if any results were returned
if (count($results) == 0) {
    // Return an error message as JSON data
    $error = [
        'error' => 'No results found for the selected date.'
    ];
    header('Content-Type: application/json');
    echo json_encode($error);
} else {
    // Return the results as JSON data
    header('Content-Type: application/json');
    echo json_encode($results);
}

?>