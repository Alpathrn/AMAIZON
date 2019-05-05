<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$req = $bdd->query('SELECT mail FROM utilisateurs');
$erreur = false;

while ($tmp = $req->fetch()) {
    if ($tmp['mail'] == $_POST['mail']) {
        $erreur = true;
        header('Location: ../inscription.php?erreur=mail&redirection=' . $_POST['redirection']);
    }
}
$req->closeCursor();

if (!$erreur) {
    $redirection = $_POST['redirection'];
    unset($_POST['redirection']);

    $bdd->prepare(
        'INSERT INTO 
        utilisateurs (prenom, nom, mail, mdp, adresse, telephone, type, typecarte, nomcarte, numcarte, expiration, cvv, admin, actif) 
        VALUES 
        (:prenom, :nom, :mail, :mdp, :adresse, :telephone, :type, :typecarte, :nomcarte, :numcarte, :expiration, :cvv, 0, 1)'
    )->execute($_POST);

    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE mail = ?');
    $req->execute(array($_POST['mail']));
    $tmp = $req->fetch();
    $_SESSION['utilisateur'] = $tmp;
    $req->closeCursor();

    if ($_SESSION['panier']) {
        $bdd->prepare(
            'INSERT INTO paniers (panier, id) VALUES (?, ?)'
        )->execute(array(serialize($_SESSION['panier']), $_SESSION['utilisateur']['ID']));
    }

    header('Location: ../' . $redirection);
}
