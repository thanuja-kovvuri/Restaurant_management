
<?php
session_start();

if(!isset($_SESSION['staff_id'])){
die("Access Denied");
}

include "db_connect.php";

$sql="SELECT o.OrderID, c.Name, o.OrderDate, o.OrderStatus, o.TotalAmount
FROM orders o
JOIN customer c ON o.CustomerID = c.CustomerID
ORDER BY o.OrderDate DESC";

$result=$conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Customer Orders</title>

<style>

body{
font-family:Arial;
background:#f4f4f4;
}

.container{
width:900px;
margin:50px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
}

table{
width:100%;
border-collapse:collapse;
}

th, td{
border:1px solid #ddd;
padding:10px;
text-align:center;
}

th{
background:#ff6600;
color:white;
}

button{
padding:10px 15px;
background:#ff6600;
border:none;
color:white;
cursor:pointer;
}

button:hover{
background:#e65c00;
}

</style>

</head>

<body>

<div class="container">

<h2>Customer Orders</h2>

<a href="staff.php">
<button>Back</button>
</a>

<br><br>

<table>

<tr>
<th>Order ID</th>
<th>Customer</th>
<th>Items Ordered</th>
<th>Total Amount</th>
<th>Status</th>
<th>Date</th>
</tr>

<?php

while($row=$result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['OrderID']."</td>";

echo "<td>".$row['Name']."</td>";

echo "<td>";

$itemQuery=$conn->query("
SELECT m.ItemName, od.Quantity
FROM order_details od
JOIN menu_item m ON od.ItemID = m.ItemID
WHERE od.OrderID=".$row['OrderID']);

while($item=$itemQuery->fetch_assoc()){
echo $item['ItemName']." (".$item['Quantity'].")<br>";
}

echo "</td>";

echo "<td>₹".$row['TotalAmount']."</td>";

echo "<td>".$row['OrderStatus']."</td>";

echo "<td>".$row['OrderDate']."</td>";

echo "</tr>";

}

?>

</table>

</div>

</body>
</html>
```
