<?php
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
if ($_GET['type'] == 'visible') {
    $req = $bdd->prepare('UPDATE articles SET visible = 1 WHERE id = ?');
    $req->execute(array($_GET['id']));
} elseif ($_GET['type'] == 'invisible') {
    $req = $bdd->prepare('UPDATE articles SET visible = 0 WHERE id = ?');
    $req->execute(array($_GET['id']));
} elseif ($_GET['type'] == 'vider') {
    $req = $bdd->prepare('UPDATE stocks SET stock = 0 WHERE article_id = ?');
    $req->execute(array($_GET['id']));
}
header('Location: ../article.php?id=' . $_GET['id']);
