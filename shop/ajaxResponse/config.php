<?php
// Connect to the MySQL database
$host = 'localhost';
//$user = 'root';
//$password = '';
$dbname = 'rgxszumy_hospital_pagmh';
$user = 'rgxszumy_pagshop';
$password = 'wZ0fx9uWJ[@G';

$conn = new mysqli($host, $user, $password, $dbname);

// Check for errors
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


?>