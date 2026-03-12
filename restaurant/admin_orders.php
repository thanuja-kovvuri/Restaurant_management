<?php
session_start();
if($_SESSION['Role'] != 'Admin'){
    die("Access Denied");
}
include 'db_connect.php';

$sql = "SELECT * FROM orders ORDER BY OrderDate DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<h2>All Orders</h2>

<?php if ($result->num_rows > 0) { ?>

    <?php while($row = $result->fetch_assoc()) { ?>

        <div style="border:1px solid black; padding:10px; margin:10px;">
            <strong>Order ID:</strong> <?php echo $row['OrderID']; ?><br>
            Customer ID: <?php echo $row['CustomerID']; ?><br>
            Table ID: <?php echo $row['TableID']; ?><br>
            Total Amount: ₹<?php echo $row['TotalAmount']; ?><br>
            Status: <?php echo $row['OrderStatus']; ?><br>

            <a href="update_order_status.php?order_id=<?php echo $row['OrderID']; ?>&status=Preparing">
                Preparing
            </a> |

            <a href="update_order_status.php?order_id=<?php echo $row['OrderID']; ?>&status=Completed">
                Completed
            </a>
        </div>

    <?php } ?>

<?php } else { ?>

    <p>No orders found.</p>

<?php } ?>