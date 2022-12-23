
readyCategories();


function viewCategory(){
    // Get the product ID
    var productId = 123;
    // Make the AJAX call
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parse the JSON data
            var data = JSON.parse(xhr.responseText);

            // Clear the overlay content
            overlayContent.innerHTML = '';

            // Iterate through the products and add them to the overlay content
            data.forEach(function(product) {
                var productElement = document.createElement('div');
                productElement.innerHTML = '<h3>' + product.name + '</h3>';
                productElement.innerHTML += '<p>' + product.standard_charge + '</p>';
                overlayContent.appendChild(productElement);
            });
        }
    };
    xhr.open('GET', 'category_charge.php?id=' + productId, true);
    xhr.send();

    const overlay = document.getElementById('overlay');
    overlay.style.display = 'block';
}

function readyCategories() {

// Get a reference to the search input and results container
    var searchInput = document.getElementById('searchTerm');
    var resultsContainer = document.getElementById('results');


// Set up an event listener that will update the results when the search term changes
    searchInput.addEventListener('input', function () {
        // Get the search term from the input field
        var searchTerm = searchInput.value;

        // Filter the list of products based on the search term
        var filteredProducts = categories.filter(function (product) {
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
                resultsContainer.innerHTML += `<div class="cat-product-box"> <h2 class="cat-product-title">${product.name}</h2> <span class="cat-description">${product.description}</span> <i class="bx bx-shopping-bag cat-view"></i></div>`;
            }
            // Get the button and the overlay element
            var cat_view_btn = document.getElementsByClassName('cat-view');

            console.log(cat_view_btn);
            for (var i = 0; i < cat_view_btn.length; i++) {
                var button = cat_view_btn[i];
                button.addEventListener("click", viewCategory);
            }
        }
    });
}