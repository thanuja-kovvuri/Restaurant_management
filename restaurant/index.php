<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Login</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 100px;
        }

        a {
            display: inline-block;
            padding: 15px 30px;
            margin: 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }

        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to Restaurant System</h1>
    <a href="login.php?role=customer">Login as Customer</a>
    <a href="login.php?role=admin">Login as Admin</a>
</div>

</body>
</html>