<?php
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$bdd->exec('UPDATE stocks SET stock = 0 WHERE id = ' . $_GET['id']);
header('Location: ../espacevente.php');
