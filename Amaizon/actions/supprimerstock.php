<?php
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$bdd->exec('DELETE FROM stocks WHERE id = ' . $_GET['id']);
header('Location: ../espacevente.php');
