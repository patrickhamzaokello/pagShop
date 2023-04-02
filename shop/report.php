<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <style>
        /* Add CSS styles to format the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Sales Report</h1>
<p>Select a date:</p>
<input type="date" id="dateInput">
<button onclick="getSalesReport()">Get Report</button>
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
        salesTableBody.innerHTML = "";
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
        });
    }
</script>
</body>
</html>
