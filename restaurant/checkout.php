<?php
session_start();
include "db.php";

if(!isset($_SESSION['customer_id'])){
    header("Location: login.php");
    exit();
}

$customerID = $_SESSION['customer_id'];
$branchID = $_SESSION['branch_id'];
$totalAmount = 0;

/* Calculate Total */
$result = mysqli_query($conn,"
SELECT menu_item.Price, cart.Quantity, cart.ItemID
FROM cart
JOIN menu_item ON cart.ItemID = menu_item.ItemID
WHERE cart.CustomerID='$customerID'
");

while($row=mysqli_fetch_assoc($result)){
    $totalAmount += $row['Price']*$row['Quantity'];
}

/* Insert into Orders */
mysqli_query($conn,"
INSERT INTO orders
(OrderDate, OrderStatus, CustomerID, BranchID, TableID, StaffID, TotalAmount)
VALUES
(NOW(),'Pending','$customerID','$branchID',1,1,'$totalAmount')
");

$orderID = mysqli_insert_id($conn);

/* Insert Order Details */
$result = mysqli_query($conn,"
SELECT ItemID, Quantity FROM cart
WHERE CustomerID='$customerID'
");

while($row=mysqli_fetch_assoc($result)){
    mysqli_query($conn,"
    INSERT INTO order_details (OrderID, ItemID, Quantity)
    VALUES ('$orderID','".$row['ItemID']."','".$row['Quantity']."')
    ");
}

/* Clear Cart */
mysqli_query($conn,"DELETE FROM cart WHERE CustomerID='$customerID'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .success-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            text-align: center;
        }

        .success-box h1 {
            color: #28a745;
            margin-bottom: 15px;
        }

        .success-box p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .success-box a {
            text-decoration: none;
        }

        .success-box button {
            width: auto;
            padding: 10px 25px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="success-box">
        <h1>✅ Order Placed Successfully!</h1>
        <p>Your Order ID: <strong><?php echo $orderID; ?></strong></p>
        <p>Total Amount: <strong>₹<?php echo $totalAmount; ?></strong></p>

        <a href="menu.php">
            <button>Back to Menu</button>
        </a>
    </div>
</div>

</body>
</html>