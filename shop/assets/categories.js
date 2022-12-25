var search_base_data;
var shop_content = document.getElementById('results');
var looking_for = "What are you looking for?";
var data_loading = "Loading...";
var data_not_found = "No Result Found";

shop_content.innerHTML = looking_for;

loadParentCategory();

document.getElementById('searchForm').addEventListener('submit', function (event){
    event.preventDefault();
    searchParentCategory();
});


function loadParentCategory(){

    shop_content.innerHTML = data_loading;
    // Make the AJAX call
    const data_xhr = new XMLHttpRequest();

    data_xhr.onreadystatechange = function() {
        if (data_xhr.readyState === 4 && data_xhr.status === 200) {
            // Parse the JSON data
            const data = JSON.parse(data_xhr.responseText);
            search_base_data = data;

            // Clear the overlay content
            shop_content.innerHTML = '';
            // Iterate through the products and add them to the overlay content
            data.forEach(function(product) {
                const productBox = document.createElement('div');
                productBox.setAttribute('class', 'cat-product-box');
                const cat_ID = document.createElement('input');
                cat_ID.setAttribute('type', 'number');
                cat_ID.setAttribute('value', product.id);
                cat_ID.setAttribute('class', 'cat_type_id');
                const productTitle = document.createElement('h2');
                productTitle.setAttribute('class', 'cat-product-title');
                productTitle.textContent = product.description;
                const productPrice = document.createElement('span');
                productPrice.setAttribute('class', 'cat-description');
                productPrice.textContent = product.description;
                const addToCartIcon = document.createElement('i');
                addToCartIcon.setAttribute('class', 'bx bx-expand cat-view');
                const cart_action = document.createElement('span');
                cart_action.setAttribute('class', 'btn_action');
                cart_action.textContent = 'View';
                addToCartIcon.appendChild(cart_action);

                productBox.appendChild(cat_ID);
                productBox.appendChild(productTitle);
                productBox.appendChild(productPrice);
                productBox.appendChild(addToCartIcon);
                shop_content.appendChild(productBox);

            });

            // Get the button and the overlay element
            var cat_view_btn = document.getElementsByClassName('cat-view');

            console.log(cat_view_btn);
            for (var i = 0; i < cat_view_btn.length; i++) {
                var button = cat_view_btn[i];
                button.addEventListener("click", viewCategory);
            }

            // ready();

        }
    };
    data_xhr.open('GET', 'ajaxResponse/all_charges_json.php', true);
    data_xhr.send();
}

function searchParentCategory(){

    shop_content.innerHTML = data_loading;
    // Make the AJAX call
    const searchQuery = document.getElementById("searchTerm").value;

    // Parse the JSON data
    const data = search_base_data;

    // Clear the overlay content
    shop_content.innerHTML = '';

    if(searchQuery.length === 0){
        shop_content.innerHTML = looking_for;
    } else {
        // Filter the list of products based on the search term
        var filteredProducts = data.filter(function (product) {
            // return product.name.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1 || product.description.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1;
            return product.name.toLowerCase().indexOf(searchQuery.toLowerCase()) !== -1;
        });

        // If there are no search results, display a message
        if (filteredProducts.length === 0) {
            shop_content.innerHTML = data_not_found;
        }
        else {
            for (var i = 0; i < filteredProducts.length; i++) {
                var product = filteredProducts[i];
                const productBox = document.createElement('div');
                productBox.setAttribute('class', 'cat-product-box');
                const cat_ID = document.createElement('input');
                cat_ID.setAttribute('type', 'number');
                cat_ID.setAttribute('value', product.id);
                cat_ID.setAttribute('class', 'cat_type_id');
                const productTitle = document.createElement('h2');
                productTitle.setAttribute('class', 'cat-product-title');
                productTitle.textContent = product.name;
                const productPrice = document.createElement('span');
                productPrice.setAttribute('class', 'cat-description');
                productPrice.textContent = product.description;
                const addToCartIcon = document.createElement('i');
                addToCartIcon.setAttribute('class', 'bx bx-expand cat-view');
                const cart_action = document.createElement('span');
                cart_action.setAttribute('class', 'btn_action');
                cart_action.textContent = 'View';
                addToCartIcon.appendChild(cart_action);

                productBox.appendChild(cat_ID);
                productBox.appendChild(productTitle);
                productBox.appendChild(productPrice);
                productBox.appendChild(addToCartIcon);
                shop_content.appendChild(productBox);
            }
            // Get the button and the overlay element
            var cat_view_btn = document.getElementsByClassName('cat-view');

            console.log(cat_view_btn);
            for (var i = 0; i < cat_view_btn.length; i++) {
                var button = cat_view_btn[i];
                button.addEventListener("click", viewCategory);
            }
        }
    }
}

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
    xhr.open('GET', 'ajaxResponse/category_charge.php?id=' + productId, true);
    xhr.send();

    const overlay = document.getElementById('overlay');
    overlay.classList.add("overlay-active");

    let closeOverlay = document.querySelector("#close-overlay");
    //close cart
    closeOverlay.onclick = () => {
        overlay.classList.remove("overlay-active");
    };
}