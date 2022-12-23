
readyCategories();


function viewCategory(){
    const overlay = document.getElementById('overlay');
    overlay.style.display = 'block';
}

function readyCategories() {
// Get the button and the overlay element
    var cat_view_btn = document.getElementsByClassName('cat-view');

    console.log(cat_view_btn);
    for (var i = 0; i < cat_view_btn.length; i++) {
        var button = cat_view_btn[i];
        button.addEventListener("click", viewCategory);
    }
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
        }
    });
}