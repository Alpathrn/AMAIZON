<?php
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
if ($_GET['type'] == 'desactiver') {
    $req = $bdd->prepare('UPDATE utilisateurs SET actif = 0 WHERE ID = ?');
    $req->execute(array($_GET['id']));
    $req = $bdd->prepare('UPDATE articles SET visible = 0 WHERE vendeur_id = ?');
    $req->execute(array($_GET['id']));
} elseif ($_GET['type'] == 'activer') {
    $req = $bdd->prepare('UPDATE utilisateurs SET actif = 1 WHERE ID = ?');
    $req->execute(array($_GET['id']));
    $req = $bdd->prepare('UPDATE articles SET visible = 1 WHERE vendeur_id = ?');
    $req->execute(array($_GET['id']));
}
header('Location: ../espaceadmin.php');
