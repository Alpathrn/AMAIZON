<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$_POST['article'] = intval($_POST['article']);
$_POST['couleur'] = $_POST['couleur'] ?: 'Couleur unique';
$_POST['taille'] = $_POST['taille'] ?: 'Taille unique';

$bdd->prepare(
    'INSERT INTO 
    stocks (article_id, couleur, taille, stock) 
    VALUES 
    (:article, :couleur, :taille, :stock)'
)->execute($_POST);

header('Location: ../espacevente.php');
