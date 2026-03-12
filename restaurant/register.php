<?php
include "db_connect.php";

$message="";

if(isset($_POST['register'])){

$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$password=$_POST['password'];

$check=$conn->query("SELECT * FROM customer WHERE Email='$email'");

if($check->num_rows>0){
$message="<p class='error'>Email already registered!</p>";
}
else{

$conn->query("INSERT INTO customer(Name,Phone,Email,Password)
VALUES('$name','$phone','$email','$password')");

$message="<p class='success'>Registration Successful! Please Login</p>";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
<div class="card">

<h2>User Registration</h2>

<?php echo $message; ?>

<form method="POST">

<input type="text" name="name" placeholder="Full Name" required>

<input type="text" name="phone" placeholder="Phone Number" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="register">Register</button>

</form>

<a href="login.php">Already have account? Login</a>

</div>
</div>

</body>
</html>