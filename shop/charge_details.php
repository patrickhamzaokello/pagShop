<?php

// Get the product ID from the URL
$productId = $_GET['id'];

// Connect to the MySQL database and retrieve the product details
$conn = mysqli_connect('localhost', 'root', '', 'rgxszumy_hospital_pagmh');
$query = "SELECT * FROM charges WHERE charge_category_id = $productId";
$result = mysqli_query($conn, $query);

// Fetch the products and store them in an array
$products = array();
while ($row = mysqli_fetch_assoc($result)) {
  $products[] = $row;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php

  // Iterate over the products and display only those that match the search term
  foreach ($products as $product) {
    echo $product['name']."- Price" .$product['standard_charge'] . "Ugx <button class='add-button' data-id='" . $product['id'] . "'>Add to Cart</button>
    <button class='remove-button' data-id='" . $product['id'] . "'>Remove from Cart</button> <br>";
  }


  ?>

  <script>
    // Get a reference to the "Add to Cart" and "Remove from Cart" buttons
    var addToCartButtons = document.querySelectorAll('.add-to-cart');
    var removeFromCartButtons = document.querySelectorAll('.remove-from-cart');

    // Set up an event listener for the "Add to Cart" button
    addToCartButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        // Get the product object from the button's data-product attribute
        var product = JSON.parse(button.getAttribute('data-product'));
        console.log("together")

        // Check if the "cart" key exists in local storage
        if (localStorage.getItem('cart') === null) {
          // If not, create an empty array and save it to local storage
          localStorage.setItem('cart', JSON.stringify(product))
        }
      });
    });
  </script>
</body>

</html>