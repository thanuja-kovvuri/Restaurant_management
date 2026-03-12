<?php include "db.php"; ?>
<link rel="stylesheet" href="style.css">

<div class="container">
<h1>South Indian Restaurant</h1>

<table>
<tr>
<th>Item Name</th>
<th>Price (₹)</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM menu");
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['ItemName']."</td>";
    echo "<td>".$row['Price']."</td>";
    echo "</tr>";
}
?>

</table>

<br>
<a href="order.php"><button>Place Order</button></a>
<a href="admin.php"><button>Admin Panel</button></a>
</div>