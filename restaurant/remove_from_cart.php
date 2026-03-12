<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['CustomerID'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['item_id'])) {

    $item_id = intval($_GET['item_id']);
    $customer_id = $_SESSION['CustomerID'];

    $sql = "DELETE FROM cart 
            WHERE ItemID = $item_id 
            AND CustomerID = $customer_id";

    $conn->query($sql);
}

header("Location: cart.php");
exit();
?>