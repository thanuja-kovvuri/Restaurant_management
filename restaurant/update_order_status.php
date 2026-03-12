<?php
include 'db_connect.php';

if (!isset($_GET['order_id']) || !isset($_GET['status'])) {
    die("Invalid request.");
}

$order_id = intval($_GET['order_id']);
$status = $_GET['status'];

/* Update Order Status */
$updateOrder = $conn->query("UPDATE orders 
                             SET OrderStatus='$status' 
                             WHERE OrderID=$order_id");

if (!$updateOrder) {
    die("Order Update Error: " . $conn->error);
}

/* If order is completed, free the table */
if ($status == 'Completed') {

    $result = $conn->query("SELECT TableID FROM orders WHERE OrderID=$order_id");

    if ($result && $result->num_rows > 0) {

        $order = $result->fetch_assoc();
        $table_id = $order['TableID'];

        $conn->query("UPDATE restaurant_table 
                      SET Status='Available' 
                      WHERE TableID=$table_id");
    }
}

header("Location: admin_orders.php");
exit();
?>