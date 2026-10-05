<?php
session_start();
require "connexion.php";

if(!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
$stmt->execute([$id]);

$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$produit){
    die("Produit introuvable");
}

$images = explode(',', $produit['image']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $produit['nom'] ?></title>

<style>

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:#f5f5f5;
}



.navbar{
    background:black;
    color:white;
    padding:15px 30px;
}

.navbar a{
    color:white;
    text-decoration:none;
}



.container{
    max-width:1100px;
    margin:40px auto;
    background:white;
    border-radius:15px;
    padding:30px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);

    display:flex;
    gap:40px;
    align-items:flex-start;
}



.left{
    flex:1;
}

.main-image{
    width:100%;
    height:500px;
    object-fit:cover;
    border-radius:10px;
    transition:0.3s;
}

.gallery{
    display:flex;
    gap:10px;
    margin-top:15px;
    flex-wrap:wrap;
}

.gallery img{
    width:90px;
    height:90px;
    object-fit:cover;
    border-radius:8px;
    border:2px solid #eee;
    transition:.3s;
    cursor:pointer;
}

.gallery img:hover{
    transform:scale(1.05);
}



.right{
    flex:1;
}

.title{
    font-size:32px;
    margin-bottom:15px;
}

.price{
    font-size:28px;
    font-weight:bold;
    color:#27ae60;
    margin-bottom:20px;
}

.description{
    line-height:1.7;
    color:#555;
    margin-bottom:25px;
}



.buttons{
    display:flex;
    gap:15px;
}

.btn{
    text-decoration:none;
    color:white;
    padding:12px 20px;
    border-radius:8px;
    transition:.3s;
}

.cart{
    background:#27ae60;
}

.cart:hover{
    background:#219150;
}

.back{
    background:#3498db;
}

.back:hover{
    background:#2980b9;
}



@media(max-width:900px){

.container{
    flex-direction:column;
}

.main-image{
    height:350px;
}

}

</style>
</head>

<body>

<div class="navbar">
    <a href="index.php">⬅ Retour à la boutique</a>
</div>

<div class="container">

    

    <div class="left">

        <img
          id="mainImage"
          src="jerseys/<?= $images[0] ?? 'default.jpg'; ?>"
          class="main-image"
          alt="">

        <div class="gallery">

            <?php foreach($images as $img): ?>

                 <img src="jerseys/<?= $img; ?>" class="thumb" onclick="changeImage(this)" alt="">

            <?php endforeach; ?>

        </div>

    </div>

    

    <div class="right">

        <h1 class="title">
            <?= $produit['nom']; ?>
        </h1>

        <div class="price">
            <?= $produit['prix']; ?> DH
        </div>

        <div class="description">
            <?= $produit['description']; ?>
        </div>

        <div class="buttons">

            <a
            href="add_to_cart.php?id=<?= $produit['id']; ?>"
            class="btn cart">
                🛒 Ajouter au panier
            </a>

            <a
            href="index.php"
            class="btn back">
                ⬅ Retour
            </a>

        </div>

    </div>

</div>

<script>

function changeImage(img){

    document.getElementById("mainImage").src = img.src;

}

</script>

</body>
</html>