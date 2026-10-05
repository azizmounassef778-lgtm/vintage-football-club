<?php
session_start();
require "connexion.php";


$cart_count = 0;

if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $q) {
        $cart_count += $q;
    }
}


$stmt = $pdo->query("SELECT * FROM produits");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vintage Football Club</title>

<style>

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:#f5f5f5;
}



.navbar{
    background:linear-gradient(135deg,#000,#1a1a1a);
    color:white;
    padding:10px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.navbar a{
    color:white;
    text-decoration:none;
    margin-left:20px;
    transition:.3s;
}

.navbar a:hover{
    color:#27ae60;
}



h1{
    text-align:center;

    margin-top:30px;
    margin-bottom:10px;

    font-size:42px;

    letter-spacing:2px;

    color:#222;
}



.container{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
    gap:20px;
    padding:20px;
}



.card{
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
    transition:.3s;
    text-align:center;
}

.card:hover{
    transform:translateY(-10px) scale(1.02);
}



.card > img{
    width:100%;
    height:300px;
    object-fit:cover;
}



.content{
    padding:15px;
}

.title{
    font-size:18px;
    font-weight:bold;
    margin-bottom:10px;
}

.price{
    color:#27ae60;
    font-size:18px;
    font-weight:bold;
    margin-bottom:10px;
}

.desc{
    color:#555;
    font-size:14px;
}



.buttons{
    display:flex;
    justify-content:center;
    gap:10px;
    margin-top:15px;
}

.btn{
    display:inline-block;
    padding:10px 15px;
    color:white;
    text-decoration:none;
    border-radius:8px;
    transition:.3s;
}

.btn:hover{
    transform:scale(1.05);
}



.details{
    background:linear-gradient(135deg,#3498db,#2980b9);
}

.details:hover{
    background:linear-gradient(135deg,#2980b9,#1f6391);
}



.cart{
    background:linear-gradient(135deg,#27ae60,#219150);
}

.cart:hover{
    background:linear-gradient(135deg,#219150,#1a7340);
}



.images{
    display:flex;
    justify-content:center;
    gap:5px;
    padding:10px;
}

.images img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:5px;
}
.navbar h2{
    margin:0;
}

.navbar h2 img{
    width:90px;
    height:90px;
    object-fit:cover;

    border-radius:50%;

    border:3px solid white;

    box-shadow:0 0 15px rgba(255,255,255,.3);

    transition:.3s;
}

.navbar h2 img:hover{
    transform:scale(1.1) rotate(5deg);
}

.brand{
    display:flex;
    align-items:center;
    gap:12px;

    margin:0;

    color:white;
    font-size:28px;
    font-weight:bold;

    letter-spacing:1px;
}

.brand img{
    width:65px;
    height:65px;

    object-fit:cover;

    border-radius:50%;

    border:3px solid white;

    box-shadow:0 0 15px rgba(255,255,255,.3);

    transition:.3s;
}

.brand img:hover{
    transform:scale(1.1) rotate(5deg);
}

.subtitle{
    text-align:center;

    color:#777;

    font-size:18px;

    margin-top:-10px;

    margin-bottom:30px;

    letter-spacing:.5px;
}

footer{
    background:linear-gradient(135deg,#000,#1a1a1a);

    color:white;

    text-align:center;

    padding:25px;

    margin-top:50px;

    font-size:14px;

    letter-spacing:1px;

    box-shadow:0 -3px 10px rgba(0,0,0,.2);
}

footer p{
    margin:0;
}
</style>

</head>

<body>



<div class="navbar">

    <h2 class="brand">
    <img src="jerseys/logo vintage.png">
    Vintage FC
</h2>

    <div>

    <a href="index.php">Home</a>

    <a href="cart.php">
        🛒 Panier (<?= $cart_count ?>)
    </a>

    <?php if(isset($_SESSION['admin'])): ?>

        <a href="admin.php">
            ⚙ Admin
        </a>

        <a href="logout.php">
            🚪 Logout
        </a>

    <?php else: ?>

        <a href="admin_login.php">
            🔐 Admin Login
        </a>

    <?php endif; ?>

</div>
</div>

<h1>Vintage Football Club</h1>
<p class="subtitle">
    Discover rare and legendary football jerseys
</p>

<div class="container">

<?php foreach($produits as $produit): ?>

<div class="card">

    <?php
    $images = explode(',', $produit['image']);
    ?>

    

    <img src="jerseys/<?= $images[0] ?? 'default.jpg'; ?>" alt="">



    <div class="images">

        <?php foreach($images as $img): ?>

            <img src="jerseys/<?= $img; ?>" alt="">

        <?php endforeach; ?>

    </div>

    

    <div class="content">

        <div class="title">
            <?= htmlspecialchars($produit['nom']); ?>
        </div>

        <div class="price">
            <?= $produit['prix']; ?> DH
        </div>

        <div class="desc">
            <?= htmlspecialchars($produit['description']); ?>
        </div>

        <div class="buttons">

            <a
            href="product.php?id=<?= $produit['id']; ?>"
            class="btn details">
                Voir détails
            </a>

            <a
            href="add_to_cart.php?id=<?= $produit['id']; ?>"
            class="btn cart">
                Ajouter au panier
            </a>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>
<footer>
    <p>© 2026 Vintage Football Club - All Rights Reserved</p>
</footer>
</body>
</html>