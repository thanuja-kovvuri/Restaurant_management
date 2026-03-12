<?php
session_start();
if($_SESSION['Role'] != 'Admin'){
    die("Access Denied");
}
include 'db_connect.php';

$result = $conn->query("SELECT * FROM restaurant_table");

if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<h2>Table Status</h2>

<?php if ($result->num_rows > 0) { ?>

    <?php while($row = $result->fetch_assoc()) { ?>
        <div style="border:1px solid black; padding:10px; margin:10px;">
            Table ID: <?php echo $row['TableID']; ?><br>
            Status: <?php echo $row['Status']; ?>
        </div>
    <?php } ?>

<?php } else { ?>
    <p>No tables found.</p>
<?php } ?>