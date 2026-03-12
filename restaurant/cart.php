<?php
session_start();
include "db.php";

if(!isset($_SESSION['customer_id'])){
    header("Location: login.php");
    exit();
}

$customerID = $_SESSION['customer_id'];
$totalAmount = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div>🛒 Your Cart</div>
    <div>
        <a href="menu.php">Menu</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">

<?php
$result = mysqli_query($conn,"
SELECT menu_item.ItemName, menu_item.Price, cart.Quantity
FROM cart
JOIN menu_item ON cart.ItemID = menu_item.ItemID
WHERE cart.CustomerID='$customerID'
");

if(mysqli_num_rows($result) == 0){
    echo "<div class='card'><h3>Your Cart is Empty</h3></div>";
}
else{
?>

<div class="card">
<table>
<tr>
<th>Item</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
    $total=$row['Price']*$row['Quantity'];
    $totalAmount+=$total;

    echo "<tr>";
    echo "<td>".$row['ItemName']."</td>";
    echo "<td>₹".$row['Price']."</td>";
    echo "<td>".$row['Quantity']."</td>";
    echo "<td>₹".$total."</td>";
    echo "</tr>";
}
?>
</table>

<div class="total">
Total: ₹<?php echo $totalAmount; ?>
</div>

<br>

<a href="checkout.php">
    <button>Proceed to Checkout</button>
</a>

</div>

<?php } ?>

</div>

</body>
</html>