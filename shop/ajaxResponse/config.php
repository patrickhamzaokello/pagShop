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


?>