<?php
include 'db_connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['CustomerID'])) {
    die("User not logged in.");
}

if (!isset($_GET['item_id'])) {
    die("Item not selected.");
}

$customer_id = intval($_SESSION['CustomerID']);
$item_id = intval($_GET['item_id']);
print_r($_SESSION);

$sql = "INSERT INTO cart (CustomerID, ItemID, Quantity)
        VALUES ($customer_id, $item_id, 1)";


if ($conn->query($sql)) {
    echo "Item Added to Cart Successfully!";
} else {
    echo "Database Error: " . $conn->error;
}
?>