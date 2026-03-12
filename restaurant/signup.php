<?php
include 'db_connect.php';

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (Username, Email, Password)
                  VALUES ('$username', '$email', '$password')");

    echo "Registration Successful! <a href='login.php'>Login Now</a>";
}
?>

<h2>Register</h2>

<form method="POST">
    Username: <input type="text" name="username"><br><br>
    Email: <input type="email" name="email"><br><br>
    Password: <input type="password" name="password"><br><br>
    <button type="submit" name="register">Register</button>
</form>