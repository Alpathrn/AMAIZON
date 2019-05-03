<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$_POST['prix'] = floatval($_POST['prix']);
$_POST['categorie'] = intval($_POST['categorie']);

$couleur = $_POST['couleur'];
unset($_POST['couleur']);
$taille = $_POST['taille'];
unset($_POST['taille']);
$stock = $_POST['stock'];
unset($_POST['stock']);

$bdd->prepare(
    'INSERT INTO 
    articles (vendeur_id, nom, prix, description, categorie) 
    VALUES 
    (' . $_SESSION['utilisateur']['ID'] . ', :nom, :prix, :description, :categorie)'
)->execute($_POST);

$req = $bdd->query('SELECT * FROM articles ORDER BY id DESC');
$tmp = $req->fetch();
$article_id = $tmp['id'];

$bdd->prepare(
    'INSERT INTO 
    stocks (article_id, couleur, taille, stock) 
    VALUES 
    (' . $article_id . ', ?, ?, ?)'
)->execute(array($couleur, $taille, $stock));

if ($_FILES['error'] == 0) {
    $infosfichier = pathinfo($_FILES['photo']['name']);
    $extension_upload = $infosfichier['extension'];
    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'tiff');
    if (in_array($extension_upload, $extensions_autorisees)) {
        $chemin = '../images/articles/' . $article_id;
        foreach ($extensions_autorisees as $value) {
            if (file_exists($chemin . '.' . $value)) unlink($chemin . '.' . $value);
        }
        move_uploaded_file($_FILES['photo']['tmp_name'], $chemin . '.' . $extension_upload);
    }
}

header('Location: ../espacevente.php');
