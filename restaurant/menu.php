<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "db.php";

if(!isset($_SESSION['customer_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_SESSION['branch_id'])){
    header("Location: branch.php");
    exit();
}

$customerID = $_SESSION['customer_id'];
$username = $_SESSION['username'];

if(isset($_GET['add'])){
    $itemID = intval($_GET['add']);

    $check = mysqli_query($conn,"
        SELECT * FROM cart
        WHERE CustomerID='$customerID' AND ItemID='$itemID'
    ");

    if(mysqli_num_rows($check) > 0){
        mysqli_query($conn,"
            UPDATE cart
            SET Quantity = Quantity + 1
            WHERE CustomerID='$customerID' AND ItemID='$itemID'
        ");
    } else {
        mysqli_query($conn,"
            INSERT INTO cart (CustomerID, ItemID, Quantity)
            VALUES ('$customerID','$itemID',1)
        ");
    }

    header("Location: menu.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <div>Welcome <?php echo $username; ?></div>
    <div>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
<h2>Menu</h2>

<div class="menu-grid">

<?php
$result = mysqli_query($conn,"SELECT * FROM menu_item");

while($row = mysqli_fetch_assoc($result)){
    echo "<div class='menu-item'>";
    echo "<h3>".$row['ItemName']."</h3>";
    echo "<p>₹".$row['Price']."</p>";
    echo "<a href='menu.php?add=".$row['ItemID']."'><button>Add to Cart</button></a>";
    echo "</div>";
}
?>

</div>
</div>

</body>
</html>