<?php
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$req = $bdd->prepare('UPDATE stocks SET stock = ' . $_POST['stock'] . ' WHERE id = ?');
$req->execute(array($_POST['id']));

header('Location: ../espacevente.php');
