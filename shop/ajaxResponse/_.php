<?php
// Decode the data object from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Connect to the database
$db = new mysqli('host', 'username', 'password', 'database');

// Check for errors
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Get the user ID and username from the data object
$userId = $data['userId'];
$username = $data['username'];
// Generate a unique order ID
$orderId = 'pagpos' . uniqid();

// Insert the user into the usertable
$stmt = $db->prepare('INSERT INTO medical_charge (user_id, order_id) VALUES (?, ?)');
$stmt->bind_param('is', $userId, $orderId);
$stmt->execute();

// Check for errors
if ($stmt->error) {
    die('Error: ' . $stmt->error);
}

// Close the statement
$stmt->close();

// Get the products from the data object
$products = $data['products'];

// Loop through the products
foreach ($products as $product) {
    // Insert the product into the products table
    $stmt = $db->prepare('INSERT INTO medical_charge_details (medical_charge_id,title, price, quantity) VALUES (?,?, ?, ?)');
    $stmt->bind_param('ssii',$orderId, $product['title'], $product['price'], $product['quantity']);
    $stmt->execute();
    
    // Check for errors
    if ($stmt->error) {
        die('Error: ' . $stmt->error);
    }

    // Close the statement
    $stmt->close();
}

// Return a success message to the JavaScript code
echo 'Data added to database';
