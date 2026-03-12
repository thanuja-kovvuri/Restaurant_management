```php
<?php
session_start();
include "db_connect.php";

if(!isset($_SESSION['customer_id'])){
header("Location: login.php?role=customer");
exit();
}

$username = $_SESSION['username'];
$customerID = $_SESSION['customer_id'];
$branchID = $_SESSION['branch_id'];

$bill="";

if(isset($_POST['submit'])){

if(!isset($_POST['item'])){
echo "<script>alert('Please select at least one item');</script>";
}else{

$selectedItems = $_POST['item'];
$quantities = $_POST['qty'];
$paymentMode = $_POST['payment_mode'];

$total = 0;

$bill="<h3>Bill Details</h3>";

foreach($selectedItems as $itemID){

$item = $conn->query("SELECT * FROM menu_item WHERE ItemID='$itemID'");
$row = $item->fetch_assoc();

$itemName = $row['ItemName'];
$price = $row['Price'];
$qty = $quantities[$itemID];

$subtotal = $price * $qty;

$total += $subtotal;

$bill .= "
Item: $itemName <br>
Price: ₹$price <br>
Quantity: $qty <br>
Subtotal: ₹$subtotal <br><br>
";

}

$gst = $total * 0.05;
$grandTotal = $total + $gst;

$bill .= "
<b>Total: ₹$total</b><br>
GST (5%): ₹$gst<br>
<b>Grand Total: ₹$grandTotal</b><br>
Payment Mode: $paymentMode
";

$conn->query("INSERT INTO orders
(OrderDate, OrderStatus, CustomerID, BranchID, TableID, StaffID, TotalAmount)
VALUES
(NOW(),'Pending','$customerID','$branchID',1,NULL,'$grandTotal')");

$orderID = $conn->insert_id;

foreach($selectedItems as $itemID){

$qty = $quantities[$itemID];

$conn->query("INSERT INTO order_details
(OrderID, ItemID, Quantity)
VALUES
('$orderID','$itemID','$qty')");
}

}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Place Order</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
<div class="card">

<h2>Welcome <?php echo $username; ?></h2>

<a href="logout.php">
<button style="width:auto;margin-bottom:20px;">Logout</button>
</a>

<h2>Select Items</h2>

<form method="post">

<table>

<tr>
<th>Select</th>
<th>Item</th>
<th>Price</th>
<th>Quantity</th>
</tr>

<?php

$items = $conn->query("SELECT * FROM menu_item");

while($row=$items->fetch_assoc()){

echo "<tr>";

echo "<td><input type='checkbox' name='item[]' value='".$row['ItemID']."'></td>";

echo "<td>".$row['ItemName']."</td>";

echo "<td>₹".$row['Price']."</td>";

echo "<td>
<input type='number' name='qty[".$row['ItemID']."]' value='1' min='1' style='width:60px'>
</td>";

echo "</tr>";

}

?>

</table>

<br>

<label>Payment Mode</label>

<select name="payment_mode">
<option>Cash</option>
<option>UPI</option>
<option>Card</option>
</select>

<br><br>

<button type="submit" name="submit">Place Order</button>

</form>

<br>

<?php
if($bill!=""){
echo "<div class='card'>$bill</div>";
}
?>

</div>
</div>

</body>
</html>
```
