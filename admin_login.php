<?php
session_start();
require "connexion.php";

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if($admin && $admin['password'] == $password) {

        $_SESSION['admin'] = $admin['id'];

        header("Location: admin.php");
        exit();
    }

    $error = "Login incorrect";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#1f1f1f,#4a4a4a);
}

.login-box{
    background:white;
    width:400px;
    padding:35px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
    animation:fadeIn .6s ease;
}

.login-box h2{
    text-align:center;
    margin-bottom:25px;
    color:#333;
}

.input-group{
    margin-bottom:20px;
}

.input-group label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
    color:#555;
}

.input-group input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    outline:none;
    transition:.3s;
}

.input-group input:focus{
    border-color:#27ae60;
    box-shadow:0 0 8px rgba(39,174,96,.3);
}

.btn{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#27ae60;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:.3s;
}

.btn:hover{
    background:#219150;
}

.error{
    background:#ffe5e5;
    color:red;
    padding:10px;
    border-radius:6px;
    margin-bottom:15px;
    text-align:center;
}

.icon{
    text-align:center;
    font-size:55px;
    margin-bottom:15px;
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

</style>

</head>
<body>

<div class="login-box">

    <div class="icon">🔐</div>

    <h2>Admin Login</h2>

    <?php if($error): ?>
        <div class="error">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>

        <button class="btn" type="submit"> Login </button>

    </form>

</div>

</body>
</html>