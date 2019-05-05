<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$erreur = false;

	$bdd->prepare('UPDATE utilisateurs SET nom = ? WHERE ID = ?')->execute(array($_POST['nom'], $_SESSION['utilisateur']['ID']));
	$_SESSION['utilisateur']['nom'] = $_POST['nom'];
	$bdd->prepare('UPDATE utilisateurs SET prenom = ? WHERE ID = ?')->execute(array($_POST['prenom'], $_SESSION['utilisateur']['ID']));
	$_SESSION['utilisateur']['prenom'] = $_POST['prenom'];
	$bdd->prepare('UPDATE utilisateurs SET mail = ? WHERE ID = ?')->execute(array($_POST['mail'], $_SESSION['utilisateur']['ID']));
	$_SESSION['utilisateur']['mail'] = $_POST['mail'];
	$bdd->prepare('UPDATE utilisateurs SET telephone = ? WHERE ID = ?')->execute(array($_POST['telephone'], $_SESSION['utilisateur']['ID']));
	$_SESSION['utilisateur']['telephone'] = $_POST['telephone'];
	$bdd->prepare('UPDATE utilisateurs SET adresse = ? WHERE ID = ?')->execute(array($_POST['adresse'], $_SESSION['utilisateur']['ID']));
	$_SESSION['utilisateur']['adresse'] = $_POST['adresse'];

    header('Location: ../moncompte.php?succes=perso');

if ($erreur) {
    header('Location: ../modifierinfos.php?erreur=' . $erreur);
}
