```php
<?php
session_start();
include "db_connect.php";

$role = isset($_GET['role']) ? $_GET['role'] : 'customer';
$error="";

if(isset($_POST['login'])){

$email=$_POST['email'];
$password=$_POST['password'];

if($role=="admin"){  

    // STAFF LOGIN
    $result=$conn->query("SELECT * FROM staff WHERE Email='$email'");

    if($result->num_rows>0){

        $row=$result->fetch_assoc();

        if($row['Password']==$password){

            $_SESSION['staff_id']=$row['StaffID'];
            $_SESSION['username']=$row['Name'];
            $_SESSION['role']=$row['Role'];

            header("Location: staff.php");
            exit();

        }else{
            $error="Incorrect Password!";
        }

    }else{
        $error="Staff not found!";
    }

}
else{

    // CUSTOMER LOGIN
    $result=$conn->query("SELECT * FROM customer WHERE Email='$email'");

    if($result->num_rows>0){

        $row=$result->fetch_assoc();

        if($row['Password']==$password){

            $_SESSION['customer_id']=$row['CustomerID'];
            $_SESSION['username']=$row['Name'];
            $_SESSION['role']="Customer";
            $_SESSION['branch_id']=1;

            header("Location: order.php");
            exit();

        }else{
            $error="Incorrect Password!";
        }

    }else{
        $error="Customer not found!";
    }

}

}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo ucfirst($role); ?> Login</title>

<style>

body{
font-family:Arial;
background:#f4f4f4;
}

.container{
width:400px;
margin:100px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
}

input{
width:100%;
padding:10px;
margin:10px 0;
}

button{
width:100%;
padding:10px;
background:#ff6600;
border:none;
color:white;
font-size:16px;
cursor:pointer;
}

button:hover{
background:#e65c00;
}

.error{
color:red;
}

</style>

</head>

<body>

<div class="container">

<h2><?php echo ucfirst($role); ?> Login</h2>

<?php
if($error!=""){
echo "<p class='error'>$error</p>";
}
?>

<form method="POST">

<input type="email" name="email" placeholder="Enter Email" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit" name="login">Login</button>

</form>

<br>

<?php if($role=="customer"){ ?>

<a href="register.php">New Customer? Register Here</a>

<?php } ?>

</div>

</body>
</html>
```
