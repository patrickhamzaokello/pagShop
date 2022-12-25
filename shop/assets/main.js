//cart
let cartIcon = document.querySelector("#cart-icon");
let cart = document.querySelector(".cart");
let closeCart = document.querySelector("#close-cart");
//open cart
cartIcon.onclick = () => {
    cart.classList.add("active");
    get_users();
};
//close cart
closeCart.onclick = () => {
    cart.classList.remove("active");
};


//making functions
function ready() {
    // remove items from cart
    var removeCartButtons = document.getElementsByClassName("cart-remove");
    console.log(removeCartButtons);
    for (var i = 0; i < removeCartButtons.length; i++) {
        var button = removeCartButtons[i];
        button.addEventListener("click", removeCartItem);
    }
    // QUANTITY CHANGE
    var quantityInputs = document.getElementsByClassName("cart-quantity");
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i];
        input.addEventListener("change", quantityChanged);
    }

    //add to cart
    var addCart = document.getElementsByClassName("add-cart");
    for (var i = 0; i < addCart.length; i++) {
        var button = addCart[i];
        button.addEventListener("click", addCartClicked);
    }

    //buy button work
    document.getElementsByClassName('btn-buy')[0].addEventListener('click', buyButtonClicked);

}

function buyButtonClicked() {
    // Get a reference to the select element
    const select = document.querySelector('#mySelect');

    // Check if an option has been selected
    if (select.value !== "") {
        // Get the selected option
        const selectedOption = select.options[select.selectedIndex];

        // Get the value and text of the selected option
        const value = selectedOption.value;
        const text = selectedOption.text;


        // Create an object with the value and text of the selected option
        const data = {
            value: value,
            text: text
        };


        // Make an AJAX request to the PHP script
        fetch('ajaxResponse/save_user_order.php', {
            method: 'POST',
            body: JSON.stringify(data), // Stringify the data object
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.text()) // Get the response as text
            .then(result => {
                // Check if the result is a success message
                if (result === 'Data added to database') {
                    console.log('Data added successfully');
                    alert(result+ ' - now print pdf');
                    var cartContent = document.getElementsByClassName('cart-content')[0];
                    while (cartContent.hasChildNodes()) {
                        cartContent.removeChild(cartContent.firstChild)
                    }

                    updatetotal();
                } else {
                    alert('Error: ' + result);

                }
            }); // Log the result to the console
    } else {
        alert('No User selected');

    }

}

function removeCartItem(event) {
    var buttonClicked = event.target;
    buttonClicked.parentElement.remove();
    updatetotal();
}

function quantityChanged(event) {
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updatetotal();
}

function addCartClicked(event) {
    var button = event.target;
    var shopProducts = button.parentElement;
    var title = shopProducts.getElementsByClassName("product-title")[0].innerText;
    var price = shopProducts.getElementsByClassName("price")[0].innerText;

    addProductToCart(title, price);
    updatetotal();
}

function addProductToCart(title, price) {
    var cartShopBox = document.createElement("div");
    cartShopBox.classList.add("cart-box");
    var cartItems = document.getElementsByClassName("cart-content")[0];
    var cartItemsNames = cartItems.getElementsByClassName("cart-product-title");
    for (var i = 0; i < cartItemsNames.length; i++) {
        if (cartItemsNames[i].innerText == title) {
            alert("you have already added this item to cart");
            return;
        }
    }


    const detailBox = document.createElement('div');
    detailBox.setAttribute('class', 'detail-box');

    const titleDiv = document.createElement('div');
    titleDiv.setAttribute('class', 'cart-product-title');
    titleDiv.textContent = title;

    const priceDiv = document.createElement('div');
    priceDiv.setAttribute('class', 'cart-price');
    priceDiv.textContent = price;

    const quantityInput = document.createElement('input');
    quantityInput.setAttribute('type', 'number');
    quantityInput.setAttribute('value', '1');
    quantityInput.setAttribute('class', 'cart-quantity');

    const trashIcon = document.createElement('i');
    trashIcon.setAttribute('class', 'bx bxs-trash-alt cart-remove');

    detailBox.appendChild(titleDiv);
    detailBox.appendChild(priceDiv);
    detailBox.appendChild(quantityInput);

    cartShopBox.appendChild(detailBox);
    cartShopBox.appendChild(trashIcon);
    cartItems.append(cartShopBox);
    cartShopBox
        .getElementsByClassName("cart-remove")[0]
        .addEventListener("click", removeCartItem);
    cartShopBox
        .getElementsByClassName("cart-quantity")[0]
        .addEventListener("change", quantityChanged);
}

//update total
function updatetotal() {
    var cartContent = document.getElementsByClassName("cart-content")[0];
    var cartBoxes = cartContent.getElementsByClassName("cart-box");
    var total = 0;
    var total_items = 0;
    for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var priceElement = cartBox.getElementsByClassName("cart-price")[0];
        var quantityElement = cartBox.getElementsByClassName("cart-quantity")[0];
        var price = parseFloat(priceElement.innerText.replace("UGX", ""));
        var quantity = quantityElement.value;
        total = total + price * quantity;
        total_items = total_items + parseFloat(quantity);
    }

    // if price contains some cents value
    total = Math.round(total * 100) / 100;

    total_items = Math.round(total_items * 100) / 100;


    document.getElementsByClassName("total-price")[0].innerText = "UGX" + total;
    document.getElementsByClassName("number_count")[0].innerText = total_items;
    document.getElementsByClassName("cart_no")[0].innerText = " (" + total_items + ") ";
}

function get_users() {
    // Make an AJAX request to the PHP file
    fetch('ajaxResponse/get_all_patients.php')
        .then(response => response.json()) // Parse the response as JSON
        .then(data => {
            // Get a reference to the select element
            const select = document.querySelector('#mySelect');

            // Loop through the data array
            data.forEach(item => {
                // Create a new option element
                const option = document.createElement('option');

                // Set the value and text of the option based on the object properties
                option.value = item.id;
                option.text = item.patient_name;

                // Add the option to the select element
                select.add(option);
            });
        });
}
