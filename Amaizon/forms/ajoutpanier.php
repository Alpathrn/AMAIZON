<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$req = $bdd->query('SELECT * FROM stocks WHERE id = ' . $_POST['stock_id']);
$stock = $req->fetch();
$_POST['quantite'] = intval($_POST['quantite']);

if ($_POST['quantite'] <= $stock['stock']) {
    if (!$_SESSION['panier']) {
        $_SESSION['panier'] = array();
    }
    $in_panier = false;
    foreach ($_SESSION['panier'] as $key => $value) {
        if ($key == $stock['id']) $in_panier = true;
    }
    if ($in_panier) {
        $_SESSION['panier'][$stock['id']]['quantite'] += $_POST['quantite'];
    } else {
        $_SESSION['panier'][$stock['id']] = array("article_id" => $_POST['id'], "quantite" => $_POST['quantite']);
    }
    header('Location: ../article.php?succes=1&id=' . $_POST['id']);
} else {
    header('Location: ../article.php?erreur=1&id=' . $_POST['id']);
}
