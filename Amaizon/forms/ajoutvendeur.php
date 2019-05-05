<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$req = $bdd->query('SELECT mail FROM utilisateurs');
$erreur = false;

while ($tmp = $req->fetch()) {
    if ($tmp['mail'] == $_POST['mail']) {
        $erreur = true;
        header('Location: ../ajoutvendeur.php?erreur=mail');
    }
}
$req->closeCursor();

if (!$erreur) {

    $bdd->prepare(
        'INSERT INTO 
        utilisateurs (prenom, nom, mail, mdp, adresse, telephone, type, typecarte, nomcarte, numcarte, expiration, cvv, admin, actif) 
        VALUES 
        (:prenom, :nom, :mail, :mdp, :adresse, :telephone, "vendeur", "Visa", "-", "0000000000000000", "2019-05", "000", 0, 1)'
    )->execute($_POST);

    header('Location: ../espaceadmin.php');
}
