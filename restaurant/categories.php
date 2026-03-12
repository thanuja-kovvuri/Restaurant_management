<?php
include 'db_connect.php';

$result = $conn->query("SELECT * FROM category");

echo "<h2>Categories</h2>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Category ID: " . $row['CategoryID'] . "<br>";
        echo "Category Name: " . $row['CategoryName'] . "<br><br>";
    }
} else {
    echo "No categories found.";
}
?>