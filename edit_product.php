<?php
session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

require "connexion.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
$stmt->execute([$id]);

$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$produit){
    die("Produit introuvable");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("
        UPDATE produits
        SET nom = ?, prix = ?, description = ?, image = ?
        WHERE id = ?
    ");

    $stmt->execute([ $nom, $prix, $description, $image, $id ]);

    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Modifier Produit</title>

<style>

body{
    font-family:Arial;
    background:#f4f4f4;
}

.form-box{
    width:500px;
    margin:40px auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.1);
}

h2{
    text-align:center;
}

input,
textarea{
    width:100%;
    padding:10px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:5px;
}

button{
    width:100%;
    padding:12px;
    background:#3498db;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#2980b9;
}

.back{
    display:block;
    text-align:center;
    margin-top:15px;
}

</style>

</head>
<body>

<div class="form-box">

<h2>Modifier Produit</h2>

<form method="POST">

<input type="text" name="nom" value="<?= $produit['nom'] ?>" required>

<input type="number" step="0.01" name="prix" value="<?= $produit['prix'] ?>" required>

<textarea name="description" required><?= $produit['description'] ?></textarea>

<input type="text" name="image" value="<?= $produit['image'] ?>" required>

<button type="submit"> Enregistrer </button>

</form>

<a class="back" href="admin.php"> Retour Dashboard </a>

</div>

</body>
</html>