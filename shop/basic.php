<?php
require_once "load_categories.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAG SYSTEMS</title>
</head>
<body>

<!-- HTML search form -->
<form>
  <input type="text" id="searchTerm" placeholder="Search">
</form>

<!-- Container element to hold the search results -->
<div id="results"></div>

<script>
  // Get a reference to the search input and results container
  var searchInput = document.getElementById('searchTerm');
  var resultsContainer = document.getElementById('results');

  // Set up an event listener that will update the results when the search term changes
  searchInput.addEventListener('input', function() {
    // Get the search term from the input field
    var searchTerm = searchInput.value;

    // Filter the list of products based on the search term
    var filteredProducts = categories.filter(function(product) {
      return product.name.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1 || product.description.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1;
    });

    // Clear the previous search results
    resultsContainer.innerHTML = "";

    // If there are no search results, display a message
    if (filteredProducts.length === 0) {
      resultsContainer.innerHTML = "No results found.";
    }

    // Otherwise, display the search results
    else {
      for (var i = 0; i < filteredProducts.length; i++) {
        var product = filteredProducts[i];
        resultsContainer.innerHTML += `<a href="charge_details.php?id=${product.id}">${product.name}</a> - charge_type_id: ${product.charge_type_id}<br>`;
      }
    }
  });


</script>
</body>
</html>