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
        <a href="index.php" class="navigation ">Home</a>
        <a href="report.php" class="navigation">Report</a>
        <a href="receipts.php" class="navigation navigation_active">Receipts</a>
        <a href="newPatient.php" class="navigation">New Patient</a>
        <a href="logout.php" class="navigation">Logout</a>
    </div>
</header>

<section class="shop container">
    <h2 class="section-title">All Patient Receipts</h2>

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
            <button class="print_btn" onclick="window.print()">Print Receipt</button>

            <div id="card_heading">

            </div>
            <div id="overlayResult">

            </div>
            <table id="receipt" class="table_reciept">

            </table>
        </div>
    </div>
</section>

<script src="assets/receipts.js"></script>

</body>
</html>
