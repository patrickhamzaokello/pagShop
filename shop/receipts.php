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
        <a href="#" class="logo">PAG MISSION HOSPITAL Receipts</a>
    </div>
</header>

<section class="shop container">
    <h2 class="section-title">All Receipts</h2>

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
            <button onclick="window.print()">Print Receipt</button>
            <div id="overlayResult">

            </div>
            <table id="receipt" class="table_reciept">
                <tr class="table-header">
                    <th class="table_hd">Item</th>
                    <th class="table_hd">Quantity</th>
                    <th class="table_hd">Price</th>
                    <th class="table_hd">Total</th>
                </tr>
            </table>
        </div>
    </div>
</section>

<script src="assets/receipts.js"></script>

</body>
</html>
