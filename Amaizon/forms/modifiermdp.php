<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$erreur = false;

if ($_POST['ancien'] == $_SESSION['utilisateur']['mdp']) {
    if ($_POST['mdp'] == $_POST['confirmation']) {
        $bdd->prepare('UPDATE utilisateurs SET mdp = ? WHERE ID = ?')->execute(array($_POST['mdp'], $_SESSION['utilisateur']['ID']));
        $_SESSION['utilisateur']['mdp'] = $_POST['mdp'];
        header('Location: ../moncompte.php?succes=mdp');
    } else {
        $erreur = 1;
    }
} else {
    $erreur = 1;
}

if ($erreur) {
    header('Location: ../modifiermdp.php?erreur=' . $erreur);
}
