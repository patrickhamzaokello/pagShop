
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PAG MISSION HOSPITAL</title>
    <link rel="stylesheet" href="assets/style.css"/>
    <link
            href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
            rel="stylesheet"
    />
</head>
<body>
<header>
    <div class="nav container">
        <a href="index.php" class="logo">PAG MISSION HOSPITAL</a>
        <a href="index.php" class="navigation navigation_active">Home</a>
        <a href="report.php" class="navigation" target="_blank">Report</a>
        <a href="receipts.php" class="navigation">Receipts</a>
        <a href="newPatient.php" class="navigation">New Patient</a>
        <a href="logout.php" class="navigation">Logout</a>

        <i class="bx bx-shopping-bag" id="cart-icon">
            <div class="circle_count">
                <p class="number_count">0</p>

            </div>
        </i>
        <div class="cart">
            <h2 class="cart-title">
                Your Cart <span class="cart_no">(0)</span>
            </h2>

            <div class="cart-content">

            </div>

            <div class="total">
                <div class="total-title">Total</div>
                <div class="total-price">UGX 0</div>
            </div>

            <form>
                <label class="select_label" for="mySelect">Choose an patient:</label><br>
                <select id="mySelect">
                </select>
            </form>

            <button type="button" class="btn-buy">Save</button>

            <i class="bx bx-x" id="close-cart"></i>
        </div>
    </div>
</header>

<section class="shop container">
<!--    <h1 class="section-title">Welcome, --><?//=$login_session?><!--!</h1>-->
    <h2 class="section-title">PAG Mission Hospital Billing System</h2>

    <div class="searchbox">
        <div class="search-box">
            <form id="searchForm" class="search-form">
                <input id="searchTerm" type="text" placeholder="Search...">
                <input type="submit" value="Search">
            </form>
        </div>
    </div>


    <!-- Container element to hold the search results -->
    <!-- content -->
    <div id="results" class="shop-content"></div>

    <div id="overlay">
        <div id="overlayContent">
            <i class="bx bx-x" id="close-overlay"></i>
            <div id="card_heading">

            </div>
            <div id="overlayResult">

            </div>
        </div>
    </div>
</section>

<script src="assets/categories.js"></script>
<script src="assets/main.js"></script>

</body>
</html>
