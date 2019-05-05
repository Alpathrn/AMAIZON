<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$bdd->prepare(
    'UPDATE utilisateurs SET typecarte = ?, nomcarte = ?, numcarte = ?, expiration = ?, cvv = ?
    WHERE ID = ' . $_SESSION['utilisateur']['ID']
)->execute(array($_POST['typecarte'], $_POST['nomcarte'], $_POST['numcarte'], $_POST['expiration'], $_POST['cvv']));

$req = $bdd->query('SELECT * FROM utilisateurs WHERE ID = ' . $_SESSION['utilisateur']['ID']);
$utilisateur = $req->fetch();

$_SESSION['utilisateur'] = $utilisateur;

header('Location: ../moncompte.php?succes=carte');
