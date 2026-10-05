<?php
session_start();

$cart = $_SESSION['cart'] ?? [];

if(empty($cart)) {
    echo "<h2 style='text-align:center;'>🛒 Panier vide</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
}


.navbar {
    background: black;
    color: white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin-left: 15px;
}


.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
}


.form-box {
    background: white;
    padding: 30px;
    width: 350px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    animation: fadeIn 0.5s ease;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}


input, textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 6px;
    border: 1px solid #ccc;
    outline: none;
    transition: 0.3s;
}

input:focus, textarea:focus {
    border-color: #27ae60;
}

button {
    width: 100%;
    padding: 12px;
    background: #27ae60;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s;
}

button:hover {
    background: #219150;
}


@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

</head>

<body>

<div class="navbar">
    <h2>🛍️ MyStore</h2>
    <div>
        <a href="index.php">Home</a>
        <a href="cart.php">Panier</a>
    </div>
</div>

<div class="container">

<div class="form-box">
    <h2>🧾 Checkout</h2>

    <form action="confirm.php" method="POST">
        <input type="text" name="nom" placeholder="Nom complet" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="adresse" placeholder="Adresse" required></textarea>

        <button type="submit">Confirmer la commande</button>
    </form>
</div>

</div>

</body>
</html>