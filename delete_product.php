<?php
session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

require "connexion.php";

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: admin.php");
exit();
?>