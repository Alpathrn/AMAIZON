<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$req = $bdd->prepare('UPDATE articles SET promotion = ' . $_POST['promotion'] . ' WHERE ID = ?');
$req->execute(array($_POST['id']));

header('Location: ../espacevente.php');
