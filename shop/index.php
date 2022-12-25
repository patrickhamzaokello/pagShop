<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hospital System</title>
    <link rel="stylesheet" href="assets/style.css"/>
    <link
            href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
            rel="stylesheet"
    />
</head>
<body>
<header>
    <div class="nav container">
        <a href="#" class="logo">PAG Hospital POS</a>
        <i class="bx bx-shopping-bag" id="cart-icon"> </i>
        <div class="cart">
            <h2 class="cart-title">
                Your Cart
            </h2>

            <div class="cart-content">

            </div>

            <div class="total">
                <div class="total-title">Total</div>
                <div class="total-price">UGX 0</div>
            </div>

            <button type="button" class="btn-buy">Save & Print</button>

            <i class="bx bx-x" id="close-cart"></i>
        </div>
    </div>
</header>

<section class="shop container">
    <h2 class="section-title">Medical Charges</h2>

    <div class="searchbox">
        <div class="search-box">
            <form id="searchForm" class="search-form">
                <input id="searchTerm" type="text" placeholder="Search...">
                <input type="submit" value="Go">
            </form>
        </div>
    </div>

    <!-- Container element to hold the search results -->
    <!-- content -->
    <div id="results" class="shop-content"></div>

    <div id="overlay">
        <div id="overlayContent">
            <i class="bx bx-x" id="close-overlay"></i>
            <div id="overlayResult">
            </div>
        </div>
    </div>
</section>

<script src="assets/categories.js"></script>
<script src="assets/main.js"></script>
<script src="../node_modules/jspdf/dist/jspdf.umd.min.js"></script

</body>
</html>
