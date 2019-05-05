<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$_SESSION['panier'] = array();
if ($_SESSION['utilisateur']) {
    $reqpanier = $bdd->query('SELECT * FROM paniers WHERE id = ' . $_SESSION['utilisateur']['ID']);
    $panier = $reqpanier->fetch();
    if (!$panier) {
        $bdd->prepare(
            'INSERT INTO paniers (panier, id) VALUES (?, ?)'
        )->execute(array(serialize($_SESSION['panier']), $_SESSION['utilisateur']['ID']));
    } else {
        $bdd->prepare(
            'UPDATE paniers SET panier = ? WHERE id = ?'
        )->execute(array(serialize($_SESSION['panier']), $_SESSION['utilisateur']['ID']));
    }
}
header('Location: ../panier.php');
