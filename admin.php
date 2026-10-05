<?php
session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

require "connexion.php";

$stmt = $pdo->query("SELECT * FROM produits ORDER BY id DESC");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<style>

body{
    font-family:Arial,sans-serif;
    margin:0;
    background:#f4f4f4;
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
    transition:.3s;;
}

.container{
    width:90%;
    margin:30px auto;
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.btn{
    background:#27ae60;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:5px;
}

.btn:hover{
    background:#219150;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th,td{
    padding:12px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:black;
    color:white;
}

.edit{
    background:#3498db;
    color:white;
    padding:6px 10px;
    text-decoration:none;
    border-radius:4px;
}

.delete{
    background:red;
    color:white;
    padding:6px 10px;
    text-decoration:none;
    border-radius:4px;
}

img{
    width:70px;
    height:70px;
    object-fit:cover;
}

</style>

</head>
<body>

<div class="navbar">
    <h2>Admin Dashboard</h2>

    <a href="logout.php">Logout</a>
    <a href="index.php">Home</a>
</div>

<div class="container">

<div class="top">
    <h2>Produits</h2>

    <a href="add_product.php" class="btn">
        Ajouter Produit
    </a>
</div>

<table>

<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Nom</th>
    <th>Prix</th>
    <th>Actions</th>
</tr>

<?php foreach($produits as $produit): ?>

<tr>

<td><?= $produit['id']; ?></td>

<td>
<?php
$images = explode(',', $produit['image']);
?>
<img src="jerseys/<?= $images[0]; ?>">
</td>

<td><?= $produit['nom']; ?></td>

<td><?= $produit['prix']; ?> DH</td>

<td>

<a
href="edit_product.php?id=<?= $produit['id']; ?>"
class="edit">
Modifier
</a>

<a
href="delete_product.php?id=<?= $produit['id']; ?>"
class="delete"
onclick="return confirm('Supprimer ce produit ?')">
Supprimer
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

</div>

</body>
</html>