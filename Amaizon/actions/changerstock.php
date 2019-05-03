<?php
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
if ($_GET['type'] == 'augmenter') {
    $req = $bdd->prepare('UPDATE stocks SET stock = stock + 1 WHERE ID = ?');
    $req->execute(array($_GET['id']));
} elseif ($_GET['type'] == 'diminuer') {
    $req = $bdd->prepare('UPDATE stocks SET stock = stock - 1 WHERE ID = ?');
    $req->execute(array($_GET['id']));
}
header('Location: ../espacevente.php');
