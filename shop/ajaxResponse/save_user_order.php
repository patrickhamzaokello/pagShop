<?php
$conn = "";
// Connect to the database
include_once "config.php";

// Decode the data object from the request body
$data = json_decode(file_get_contents('php://input'), true);


// Get the products from the data object
$products = $data['products'];

// Check if the products array is empty or null
if (empty($products)) {
    die('No Medical Charges to process');
}

// Get the user ID and username from the data object
$userId = $data['user_id'];
$username = $data['username'];
// Generate a unique order ID
$orderId = 'pag_mh' . $userId;

// Insert the user into the usertable
$stmt = $conn->prepare('INSERT INTO medical_charge (user_id, order_id) VALUES (?, ?)');
$stmt->bind_param('is', $userId, $orderId);
$stmt->execute();

// Check for errors
if ($stmt->error) {
    die('Error: ' . $stmt->error);
}

// Close the statement
$stmt->close();

// Loop through the products
foreach ($products as $product) {
    // Insert the product into the products table
    $stmt = $conn->prepare('INSERT INTO medical_charge_details (medical_charge_id,charge_id, price, quantity) VALUES (?,?, ?, ?)');
    $stmt->bind_param('siii', $orderId, $product['id'], $product['price'], $product['quantity']);
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

