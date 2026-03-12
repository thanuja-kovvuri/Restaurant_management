<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'db_connect.php';

echo "Page Loaded<br>";

if (!isset($_SESSION['customer_id'])) {
    die("Session not set. Please login first.");
}

if (isset($_POST['pay'])) {

    echo "Form Submitted<br>";

    $customer = $_SESSION['customer_id'];
    $branch = 1;
    $table = 1;
    $staff = 1;
    $total = $_POST['total'];

    $insert = "INSERT INTO orders 
    (OrderDate, OrderStatus, CustomerID, BranchID, TableID, staffID, TotalAmount)
    VALUES 
    (NOW(), 'Paid', '$customer', '$branch', '$table', '$staff', '$total')";

    if (!$conn->query($insert)) {
        die("Insert Error: " . $conn->error);
    }

    echo "Order Placed Successfully!";
}
?>

<h2>Payment Page</h2>

<form method="POST">
    <input type="hidden" name="total" value="500">
    <button type="submit" name="pay">Pay Now</button>
</form>