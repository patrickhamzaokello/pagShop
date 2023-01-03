var search_base_data;
var shop_content = document.getElementById('results');
var looking_for = "What are you looking for?";
var data_loading = "<div class='loading'>Loading...</div>";
var data_not_found = "No Result Found";

shop_content.innerHTML = looking_for;

loadParentCategory();

document.getElementById('searchForm').addEventListener('submit', function (event) {
    event.preventDefault();
    searchParentCategory();
});


function loadParentCategory() {

    shop_content.innerHTML = data_loading;
    // Make the AJAX call
    const data_xhr = new XMLHttpRequest();

    data_xhr.onreadystatechange = function () {
        if (data_xhr.readyState === 4 && data_xhr.status === 200) {
            // Parse the JSON data
            const data = JSON.parse(data_xhr.responseText);
            search_base_data = data;

            // Clear the overlay content
            shop_content.innerHTML = '';
            // Iterate through the products and add them to the overlay content
            data.forEach(function (product) {
                const productBox = document.createElement('div');
                productBox.setAttribute('class', 'cat-product-box');
                const cat_ID = document.createElement('input');
                cat_ID.setAttribute('type', 'text');
                cat_ID.setAttribute('value', product.order_id);
                cat_ID.setAttribute('class', 'cat_type_id');
                const productTitle = document.createElement('h2');
                productTitle.setAttribute('class', 'cat-product-title');
                productTitle.textContent = product.patient_name;
                const order_info = document.createElement('p');
                order_info.setAttribute('class', 'cat-description');
                order_info.textContent = "Age: " + product.age + " Gender: " + product.gender + " Phone: " + product.mobileno + " Date: " + product.datecreated;
                const productPrice = document.createElement('span');
                productPrice.setAttribute('class', 'order_info');
                productPrice.textContent = product.address;
                const addToCartIcon = document.createElement('i');
                addToCartIcon.setAttribute('class', 'bx bx-expand cat-view');
                const cart_action = document.createElement('span');
                cart_action.setAttribute('class', 'btn_action');
                cart_action.textContent = 'View';
                // addToCartIcon.appendChild(cart_action);

                productBox.appendChild(cat_ID);
                productBox.appendChild(productTitle);
                productBox.appendChild(order_info);
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


        }
    };
    data_xhr.open('GET', 'ajaxResponse/all_receipts_json.php', true);
    data_xhr.send();
}

function searchParentCategory() {

    // Make the AJAX call
    const searchQuery = document.getElementById("searchTerm").value;

    // Parse the JSON data
    const data = search_base_data;
    shop_content.innerHTML = data_loading;

    if (searchQuery.length === 0) {
        shop_content.innerHTML = looking_for;
    } else {
        // Filter the list of products based on the search term
        var filteredProducts = data.filter(function (product) {
            // return product.name.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1 || product.description.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1;
            return product.patient_name.toLowerCase().indexOf(searchQuery.toLowerCase()) !== -1;
        });

        // If there are no search results, display a message
        if (filteredProducts.length === 0) {
            shop_content.innerHTML = data_not_found;
        } else {
            shop_content.innerHTML = "";
            for (var i = 0; i < filteredProducts.length; i++) {
                var product = filteredProducts[i];
                const productBox = document.createElement('div');
                productBox.setAttribute('class', 'cat-product-box');
                const cat_ID = document.createElement('input');
                cat_ID.setAttribute('type', 'text');
                cat_ID.setAttribute('value', product.order_id);
                cat_ID.setAttribute('class', 'cat_type_id');
                const productTitle = document.createElement('h2');
                productTitle.setAttribute('class', 'cat-product-title');
                productTitle.textContent = product.patient_name;
                const order_info = document.createElement('p');
                order_info.setAttribute('class', 'cat-description');
                order_info.textContent = "Age: " + product.age + " Gender: " + product.gender + " Phone: " + product.mobileno + " Date: " + product.datecreated;
                const productPrice = document.createElement('span');
                productPrice.setAttribute('class', 'order_info');
                productPrice.textContent = product.address;
                const addToCartIcon = document.createElement('i');
                addToCartIcon.setAttribute('class', 'bx bx-expand cat-view');
                const cart_action = document.createElement('span');
                cart_action.setAttribute('class', 'btn_action');
                cart_action.textContent = 'View';
                // addToCartIcon.appendChild(cart_action);

                productBox.appendChild(cat_ID);
                productBox.appendChild(productTitle);
                productBox.appendChild(order_info);
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

function viewCategory(event) {
    var cat_button = event.target;
    var cat_buttonParent = cat_button.parentElement;
    var productId = cat_buttonParent.getElementsByClassName("cat_type_id")[0].value;
    var cat_title = cat_buttonParent.getElementsByClassName("cat-product-title")[0].innerHTML;
    var cat_description = cat_buttonParent.getElementsByClassName("cat-description")[0].innerHTML;


    // Get the overlay content element
    var card_heading = document.getElementById('card_heading');
    var overlayResult = document.getElementById('overlayResult');
    var order_table = document.getElementById('receipt');

    overlayResult.innerHTML = data_loading;
    card_heading.innerHTML = "";


    // Get the product ID
    // Make the AJAX call
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parse the JSON data
            var data = JSON.parse(xhr.responseText);
            console.log(xhr.responseText)


            const mainBox = document.createElement('div');
            mainBox.setAttribute('class', 'main-box');
            const mainTitle = document.createElement('h2');
            mainTitle.setAttribute('class', 'main-title');
            mainTitle.textContent = cat_title;
            const mainDescription = document.createElement('span');
            mainDescription.setAttribute('class', 'main-description');
            mainDescription.textContent = cat_description;
            mainBox.appendChild(mainTitle);
            mainBox.appendChild(mainDescription);
            card_heading.appendChild(mainBox);


            if (data.length === 0) {
                overlayResult.innerHTML = 'No Records Found';
            } else {
                overlayResult.innerHTML = '';
                // Iterate through the products and add them to the overlay content
                data.forEach(function (product) {
                                        const tablerow = document.createElement('tr');
                    const tableda1 = document.createElement("td");
                    tableda1.setAttribute('class', 'product-box');
                    tableda1.textContent = product.name;

                    const tableda2 = document.createElement("td");
                    tableda2.setAttribute('class', 'product-box table_right');

                    tableda2.textContent = product.quantity;

                    const tableda3 = document.createElement("td");
                    tableda3.setAttribute('class', 'product-box table_right');

                    tableda3.textContent = product.price;

                    const tableda4 = document.createElement("td");
                    tableda4.setAttribute('class', 'product-box table_right');

                    tableda4.textContent = product.quantity * product.price;

                    tablerow.appendChild(tableda1);
                    tablerow.appendChild(tableda2);
                    tablerow.appendChild(tableda3);
                    tablerow.appendChild(tableda4);

                    order_table.appendChild(tablerow)


                });
            }


        }
    };
    xhr.open('GET', 'ajaxResponse/receipt_details_json.php?id=' + productId, true);
    xhr.send();

    const overlay = document.getElementById('overlay');
    overlay.classList.add("overlay-active");

    let closeOverlay = document.querySelector("#close-overlay");
    //close cart
    closeOverlay.onclick = () => {
        overlay.classList.remove("overlay-active");
    };
}