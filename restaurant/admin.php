<?php
include "db.php";
?>

<h2>Admin - Orders</h2>

<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Customer</th>
<th>Branch</th>
<th>Status</th>
<th>Total</th>
</tr>

<?php
$result = mysqli_query($conn,"
SELECT orders.*, customers.Username, branches.BranchName
FROM orders
JOIN customers ON orders.CustomerID = customers.CustomerID
JOIN branches ON orders.BranchID = branches.BranchID
");

while($row=mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row['OrderID']."</td>";
    echo "<td>".$row['Username']."</td>";
    echo "<td>".$row['BranchName']."</td>";
    echo "<td>".$row['OrderStatus']."</td>";
    echo "<td>₹".$row['TotalAmount']."</td>";
    echo "</tr>";
}
?>
</table>