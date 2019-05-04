<!DOCTYPE html>
<html>

<?php
session_start();
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$req = $bdd->query('SELECT * FROM articles WHERE id = ' . $_GET['id']);
$article = $req->fetch();

$page = (object)[
    'title' => 'Amaizon - ' . $article['nom'],
    'page' => 'article'
];
include('head.php');
?>

<body scroll="no">
    <?php
    include('menu.php')
    ?>
    <div id="content" class="container">
        <h1>Bienvenue sur Amaizon ! <span style="font-size: 14px;">Faites comme à la maison</span></h1>
        <div id="article-page" class="row justify-content-between" style="margin-top: 40px;">
            <div class="col-lg-5 center-container" style="height: 400px;">
                <img id="article-image" alt="" src="<?php echo (chemin_photo('images/articles/', $article['id'])) ?>" />
            </div>
            <div class="col-lg-7 center-container" style="margin-top: 10px;">
                <form class="center" style="max-width: 600px;" action="forms/ajoutpanier.php">
                    <h2><?php echo $article['nom'] ?></h2>
                    <h3><?php echo $article['prix'] ?> €</h3>
                    <div class="label">Description :</div>
                    <p style="width:400px;"><?php echo $article['description'] ?></p>
                    <div class="label">Modèle :</div>
                    <select class="form-control" name="stock" required>
                        <?php
                        $req = $bdd->query('SELECT * FROM stocks WHERE article_id = ' . $_GET['id']);
                        while ($tmp = $req->fetch()) { ?>
                            <option value="<?php echo $tmp['id'] ?>" <?php if ($tmp['stock'] == 0) echo "disabled" ?>><?php echo $tmp['couleur'] ?> / <?php echo $tmp['taille'] ?> (<?php echo $tmp['stock'] ?> restants)</option>
                        <?php } ?>
                    </select>
                    <div class="label">Quantité :</div>
                    <input class="form-control" type="number" name="stock" value="1" required />
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
                    <input class="btn" type="submit" value="Ajouter au panier" />
                </form>
            </div>
</body>

</html>