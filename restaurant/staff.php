
<?php
session_start();

if(!isset($_SESSION['staff_id'])){
die("Access Denied");
}

include "db_connect.php";

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$sql = "SELECT staff.StaffID, staff.Name, staff.Role, staff.Salary, branch.BranchName
        FROM staff
        JOIN branch ON staff.BranchID = branch.BranchID";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Staff Dashboard</title>

<style>

body{
font-family:Arial;
background:#f4f4f4;
}

.container{
width:800px;
margin:50px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

table, th, td{
border:1px solid #ddd;
}

th, td{
padding:10px;
text-align:center;
}

button{
padding:10px 15px;
background:#ff6600;
border:none;
color:white;
cursor:pointer;
}

button:hover{
background:#e65c00;
}

.top{
display:flex;
justify-content:space-between;
align-items:center;
}

</style>

</head>

<body>

<div class="container">

<div class="top">
<h2>Welcome <?php echo $username; ?> (<?php echo $role; ?>)</h2>

<a href="logout.php">
<button>Logout</button>
</a>
</div>

<br>

<a href="view_orders.php">
<button>View Customer Orders</button>
</a>

<h3>Staff Members</h3>

<table>

<tr>
<th>Name</th>
<th>Role</th>
<th>Salary</th>
<th>Branch</th>
</tr>

<?php

while($row=$result->fetch_assoc()){

echo "<tr>";
echo "<td>".$row['Name']."</td>";
echo "<td>".$row['Role']."</td>";
echo "<td>₹".$row['Salary']."</td>";
echo "<td>".$row['BranchName']."</td>";
echo "</tr>";

}

?>

</table>

</div>

</body>
</html>
```
