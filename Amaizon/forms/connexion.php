<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$req = $bdd->query('SELECT * FROM utilisateurs');
$success = false;

while ($tmp = $req->fetch()) {

    if ($_POST['username'] == $tmp['mail'] and $_POST['password'] == $tmp['mdp']) {
        $success = true;
        $_SESSION['utilisateur'] = $tmp;
    }
}

$req->closeCursor();

if ($success) {
    header('Location: ../' . $_POST['redirection']);
}
if (!$success) {
    header('Location: ../connexion.php?erreur=1&redirection=' . $_POST['redirection']);
}
