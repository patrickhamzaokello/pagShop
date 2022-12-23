
readyCategories();
function viewCategory(){
    // Get the overlay content element
    var overlayResult = document.getElementById('overlayResult');
    // Get the product ID
    var productId = 958;
    // Make the AJAX call
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parse the JSON data
            var data = JSON.parse(xhr.responseText);

            // Clear the overlay content
            overlayResult.innerHTML = '';

            // Iterate through the products and add them to the overlay content
            data.forEach(function(product) {
                const productBox = document.createElement('div');
                productBox.setAttribute('class', 'product-box');
                const productTitle = document.createElement('h2');
                productTitle.setAttribute('class', 'product-title');
                productTitle.textContent = product.name;
                const productPrice = document.createElement('span');
                productPrice.setAttribute('class', 'price');
                productPrice.textContent = product.standard_charge + ' UGX';
                const addToCartIcon = document.createElement('i');
                addToCartIcon.setAttribute('class', 'bx bx-shopping-bag add-cart');
                const cart_action = document.createElement('span');
                cart_action.setAttribute('class', 'btn_action');
                cart_action.textContent = 'Add to Cart';
                // addToCartIcon.appendChild(cart_action);

                productBox.appendChild(productTitle);
                productBox.appendChild(productPrice);
                productBox.appendChild(addToCartIcon);
                overlayResult.appendChild(productBox);

            });

            ready();

        }
    };
    xhr.open('GET', 'category_charge.php?id=' + productId, true);
    xhr.send();

    const overlay = document.getElementById('overlay');
    overlay.classList.add("overlay-active");

    let closeOverlay = document.querySelector("#close-overlay");
    //close cart
    closeOverlay.onclick = () => {
        overlay.classList.remove("overlay-active");
    };
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
                resultsContainer.innerHTML += `<div class="cat-product-box"> <h2 class="cat-product-title">${product.name}</h2> <span class="cat-description">${product.description}</span> <i class="bx bx-expand cat-view"><span class="btn_action">View Details</span>  </i></div>`;
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