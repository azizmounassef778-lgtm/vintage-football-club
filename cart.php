<?php
session_start();
require "connexion.php";

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<h2 style='text-align:center;'>🛒 Panier vide</h2>";
    exit();
}

$ids = array_keys($cart);

$placeholders = implode(',', array_fill(0, count($ids), '?'));

$stmt = $pdo->prepare("SELECT * FROM produits WHERE id IN ($placeholders)");
$stmt->execute($ids);

$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Panier</title>

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
    align-items: center;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
    transition: 0.3s;
}

.navbar a:hover {
    color: #27ae60;
}


.container {
    width: 80%;
    margin: auto;
    padding: 20px;
}


.cart-item {
    display: flex;
    align-items: center;
    background: white;
    padding: 15px;
    margin: 15px 0;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.cart-item:hover {
    transform: scale(1.02);
}


.cart-item img {
    width: 110px;
    height: 110px;
    border-radius: 10px;
    object-fit: cover;
}


.info {
    flex: 1;
    margin-left: 20px;
}

.price {
    color: #27ae60;
    font-weight: bold;
}


.btn {
    padding: 10px 15px;
    background: red;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background: darkred;
    transform: scale(1.05);
}


.total-box {
    background: linear-gradient(135deg, black, #333);
    color: white;
    padding: 20px;
    text-align: center;
    border-radius: 12px;
    margin-top: 25px;
    font-size: 22px;
    animation: fadeIn 1s ease-in-out;
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

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    animation: fadeIn 0.3s;
}

.modal-content button {
    margin: 10px;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#confirmBtn {
    background: red;
    color: white;
}

#btn {
    padding: 12px 20px;
    background: #27ae60;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 16px;
    transition: 0.3s;
}

#btn:hover {
    background: #219150;
}
</style>


</head>
<div class="navbar">
    <h2>🛍️ MyStore</h2>
    <div>
        <a href="index.php">Home</a>
        <a href="cart.php">Panier</a>
    </div>
</div> 
<body>

   

<div class="container">

<div class="top-bar">
    <a href="index.php">⬅ Continuer shopping</a>
    <h1>🛒 Mon Panier</h1>
</div>

<?php $total = 0; ?>

<?php foreach($produits as $produit): 
    $quantity = $cart[$produit['id']];
    $subtotal = $produit['prix'] * $quantity;
    $total += $subtotal;

    $images = explode(',', $produit['image']);
?>

<div class="cart-item">

    <img src="jerseys/<?= $images[0]; ?>">

    <div class="info">
        <h3><?= $produit['nom']; ?></h3>
        <p class="price"><?= $produit['prix']; ?> DH</p>
        <div style="display:flex; align-items:center; gap:10px;">
    
            <a href="update_cart.php?id=<?= $produit['id']; ?>&action=decrease" class="btn">-</a>
    
             <span><?= $quantity; ?></span>
    
            <a href="update_cart.php?id=<?= $produit['id']; ?>&action=increase" class="btn">+</a>

        </div>
        <p>Sous-total: <?= $subtotal; ?> DH</p>
    </div>

    <button class="btn" onclick="openModal('remove_from_cart.php?id=<?= $produit['id']; ?>')">
    Supprimer
    </button>

</div>

<?php endforeach; ?>

<div class="total-box">
    Total: <?= $total; ?> DH
</div>
<div style="text-align:center; margin-top:20px;">
    <a href="checkout.php" id="btn">Commander</a>
</div>

</div>


<div id="modal" class="modal">
    <div class="modal-content">
        <p>Supprimer ce produit du panier ?</p>
        <button id="confirmBtn">Oui</button>
        <button onclick="closeModal()">Non</button>
    </div>
</div>




<script>
let deleteUrl = "";

function openModal(url) {
    deleteUrl = url;
    document.getElementById("modal").style.display = "flex";
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}

document.getElementById("confirmBtn").onclick = function() {
    window.location.href = deleteUrl;
};
</script>
</body>
</html>