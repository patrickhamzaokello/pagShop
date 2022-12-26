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
$orderId = 'pag_mh' . uniqid();

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


// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Create a new PDF document
$pdf = new TCPDF();

// Set the page margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// Add a page
$pdf->AddPage();
// Set the header and footer content and font
// Set the header content

// Add an image to the top of the first page
$pdf->Image('logo.png', '', '', 0, 0, '', '', '', false, 300, '', false, false, 0);

// Set the font for the header and footer
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


// Set the font
$pdf->SetFont('helvetica', '', 12);

// Add the heading
// Add the style element and heading
$heading = '<style>
            h1,h5 {
                text-align: center;
                margin: 0;
                margin-bottom: 20px;
                padding: 20px;
            }
          </style>
          <h1>PAG Mission Hospital Billing System</h1>
          <h5 style="padding-bottom: 20px">Patient: ' . $username . ", Medical Charge ID:" . $orderId . '</h5>
          ';
$pdf->WriteHTML($heading,true, false, true, false, '');

// Calculate the totals for each product
$totals = array_map(function ($product) {
    return $product['price'] * $product['quantity'];
}, $products);

// Calculate the overall total
$total = array_sum($totals);


// Create an HTML table with the product information
$html = '
<style>
table {
border-color: #cccccc;
margin-top: 1rem;
}
</style>
<table border="1" style="" cellpadding="10">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Qty</th>
                <th>Unit Price (ugx)</th>
                 <th>Total (ugx)</th>
            </tr>';

// Add a row for each product
foreach ($products as $i => $product) {
    $html .= '<tr style="border-color: #666666">
                <td>' . $i + 1 . '</td>
                <td>' . $product['title'] . '</td>
                <td>' . $product['quantity'] . '</td>
                <td>' . $product['price'] . '</td>
                <td>' . $totals[$i] . '</td>
              </tr>';
}

// Add a row with the total
$html .= '<tr>
            <td colspan="4" align="right">Total:</td>
            <td>' . $total . '</td>
          </tr>';

$html .= '</table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF document
$pdf->Output($username . "_" . $orderId . '_charge.pdf', 'I');


// Return a success message to the JavaScript code
echo 'Data added to database';

