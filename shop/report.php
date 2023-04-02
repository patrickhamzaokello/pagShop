<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PAG Hospital Sales Report</title>
    <style>
        /* Add CSS styles to format the table */
         body {
             margin: 0 auto;
             text-align: center;
         }

        .date_user {
            text-align: center;
            text-transform: capitalize;
        }
        table {
            width: 750px;
            border-collapse: collapse;
            margin:10px auto;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #3498db;
            color: white;
            font-weight: bold;
        }

        td, th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 18px;
        }

        /*
        Max width before this PARTICULAR table gets nasty
        This query will take effect for any screen smaller than 760px
        and also iPads specifically.
        */
        @media
        only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px)  {

            table {
                width: 100%;
            }

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr { border: 1px solid #ccc; }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                /* Label the data */
                content: attr(data-column);

                color: #000;
                font-weight: bold;
            }

        }
    </style>
</head>
<body>
<h1>PAG Hospital Sales Report</h1>
<div class="date_user">
    <p>Select a date:</p>
    <input type="date" id="dateInput">
    <button onclick="getSalesReport()">Get Report</button>
    <button onclick="window.print()">Print Report</button>

</div>
<p id="reportDate"></p>
<table id="salesTable">
    <thead>
    <tr>
        <th>Item Name</th>
        <th>Unit Price</th>
        <th>Number Sold</th>
        <th>Total Sales</th>
    </tr>
    </thead>
    <tbody id="salesTableBody">
    </tbody>
</table>
<p>Total Sales: <span id="totalSales"></span></p>

<script>
    function getSalesReport() {
        const date = document.getElementById("dateInput").value;
        fetch(`sales_report.php?date=${date}`)
            .then(response => response.json())
            .then(data => displaySalesReport(data))
            .catch(error => console.error(error));
    }

    function displaySalesReport(data) {
        const salesTableBody = document.getElementById("salesTableBody");
        const totalSalesElem = document.getElementById("totalSales");
        const reportDateElem = document.getElementById("reportDate");
        const date = document.getElementById("dateInput").value;
        salesTableBody.innerHTML = "";
        let totalSales = 0;
        data.forEach(item => {
            const row = salesTableBody.insertRow();
            const itemNameCell = row.insertCell();
            itemNameCell.textContent = item.item_name;
            const unitPriceCell = row.insertCell();
            unitPriceCell.textContent = item.unit_price;
            const numItemsSoldCell = row.insertCell();
            numItemsSoldCell.textContent = item.num_items_sold;
            const totalSalesCell = row.insertCell();
            totalSalesCell.textContent = item.total_sales;
            totalSales += parseFloat(item.total_sales);
        });
        totalSalesElem.textContent = `UGX ${totalSales.toFixed(0)}`;
        reportDateElem.textContent = `Sales Report for ${date}`
    }
</script>
</body>
</html>
