<?php

// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Create a new PDF document
$pdf = new TCPDF();

// Set the page margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// Set the header and footer content and font
// Set the header content
$pdf->SetHeader('<table width="100%"><tr><td align="center">My Company</td></tr></table>');

// Set the footer content
$pdf->SetFooter('<table width="100%"><tr><td align="center">Page {PAGENO} of {nb}</td></tr></table>');

// Add an image to the top of the first page
$pdf->Image('logo.png', '', '', 0, 0, '', '', '', false, 300, '', false, false, 0);

// Set the font for the header and footer
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Add a page
$pdf->AddPage();

// Set the font
$pdf->SetFont('helvetica', '', 12);

// Create an HTML table with the product information
$html = '<table border="1">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>';

// Add a row for each product
foreach ($products as $product) {
    $html .= '<tr>
                <td>' . $product['name'] . '</td>
                <td>' . $product['quantity'] . '</td>
                <td>' . $product['price'] . '</td>
              </tr>';
}

$html .= '</table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF document
$pdf->Output('products.pdf', 'I');
