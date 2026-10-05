<?php
session_start();
require "connexion.php";

$cart = $_SESSION['cart'] ?? [];

if(empty($cart)) {
    echo "<h2 style='text-align:center;'>🛒 Panier vide</h2>";
    exit();
}


$nom = $_POST['nom'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];

$ids = array_keys($cart);
$ids_string = implode(',', $ids);

$stmt = $pdo->query("SELECT * FROM produits WHERE id IN ($ids_string)");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);


$total = 0;
foreach($produits as $produit) {
    $total += $produit['prix'] * $cart[$produit['id']];
}


$stmt = $pdo->prepare("INSERT INTO commandes (nom, email, adresse, total) VALUES (?, ?, ?, ?)");
$stmt->execute([$nom, $email, $adresse, $total]);

$commande_id = $pdo->lastInsertId();


foreach($produits as $produit) {
    $stmt = $pdo->prepare("INSERT INTO commande_items (commande_id, produit_id, quantite, prix) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $commande_id,
        $produit['id'],
        $cart[$produit['id']],
        $produit['prix']
    ]);
}


unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Confirmation</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f9;
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
}


.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
}

.box {
    background: white;
    padding: 40px;
    text-align: center;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    animation: fadeIn 0.5s ease;
}

.icon {
    font-size: 50px;
    color: #27ae60;
}

h2 {
    margin: 15px 0;
}

.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 20px;
    background: #27ae60;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    transition: 0.3s;
}

.btn:hover {
    background: #219150;
}


@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

</head>

<body>

<div class="navbar">
    <h2>🛍️ MyStore</h2>
    <a href="index.php">Home</a>
</div>

<div class="container">
    <div class="box">
        <div class="icon">✅</div>
        <h2>Commande confirmée !</h2>
        <p>Merci <b><?= htmlspecialchars($nom); ?></b> pour votre achat 🎉</p>
        <p>Total payé: <b><?= $total; ?> DH</b></p>

        <a href="index.php" class="btn">Retour au shop</a>
    </div>
</div>

</body>
</html>