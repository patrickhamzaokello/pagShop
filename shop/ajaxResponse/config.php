<?php
// Connect to the MySQL database
$host = 'localhost';
$user = 'rgxszumy_pagshop';
$password = 'wZ0fx9uWJ[@G';
$dbname = 'rgxszumy_hospital_pagmh';

$conn = new mysqli($host, $user, $password, $dbname);

// Check for errors
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


?>