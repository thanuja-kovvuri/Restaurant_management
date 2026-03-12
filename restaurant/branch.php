<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "db.php";

if(!isset($_SESSION['customer_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['branch'])){
    $_SESSION['branch_id'] = $_POST['branch'];
    header("Location: menu.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Branch</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<div class="card">

<h2>Select Branch</h2>

<form method="post">

<label>Choose Branch</label>
<select name="branch" required>
<option value="">-- Select Branch --</option>

<?php
$result = mysqli_query($conn,"SELECT * FROM branch");

while($row = mysqli_fetch_assoc($result)){
    echo "<option value='".$row['BranchID']."'>".$row['BranchName']."</option>";
}
?>

</select>

<br>
<button type="submit">Continue</button>

</form>

</div>
</div>

</body>
</html>