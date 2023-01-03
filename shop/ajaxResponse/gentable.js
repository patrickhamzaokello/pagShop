<table id="receipt">
    <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
    </tr>
</table>

<script>
    // Fetch the JSON data from the PHP file
    fetch('data.php')
    .then(response => response.json())
    .then(data => {
    // Loop through the data and add rows to the table
    data.forEach(item => {
        var row = document.createElement('tr');
        row.innerHTML = `
          <td>${item.name}</td>
          <td>${item.quantity}</td>
          <td>${item.price}</td>
          <td>${item.total}</td>
        `;
        document.getElementById('receipt').appendChild(row);
    });
});
</script>
