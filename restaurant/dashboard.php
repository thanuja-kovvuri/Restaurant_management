<?php
session_start();

if(!isset($_SESSION['CustomerID'])){
    header("Location: login.php");
    exit();
}

$role = $_SESSION['Role'];
$name = $_SESSION['Name'];
?>

<h1>Welcome <?php echo $name; ?>!</h1>

<hr>

<h3>Common Options</h3>
<ul>
    <li><a href="branch.php">View Branches</a></li>
    <li><a href="categories.php">View Categories</a></li>
    <li><a href="cart.php">View Cart</a></li>
</ul>

<?php if($role == 'Admin') { ?>

<hr>
<h3>Admin Panel</h3>
<ul>
    <li><a href="admin_orders.php">View All Orders</a></li>
    <li><a href="tables.php">Manage Tables</a></li>
    <li><a href="staff.php">Manage Staff</a></li>
</ul>

<?php } ?>

<hr>
<a href="logout.php">Logout</a>