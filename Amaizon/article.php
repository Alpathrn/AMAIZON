<!DOCTYPE html>
<html>

<?php
session_start();
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$req = $bdd->query('SELECT * FROM articles WHERE id = ' . $_GET['id']);
$article = $req->fetch();
$req = $bdd->query('SELECT * FROM utilisateurs WHERE ID = ' . $article['vendeur_id']);
$vendeur = $req->fetch();

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
                <form class="center" style="max-width: 600px;" method="post" action="forms/ajoutpanier.php">
                    <h2><?php echo $article['nom'] ?></h2>
                    <?php
                    $req = $bdd->query('SELECT * FROM stocks WHERE article_id = ' . $_GET['id']);
                    $stock_total = 0;
                    while ($tmp = $req->fetch()) {
                        $stock_total += $tmp['stock'];
                    } ?>
                    <h3 <?php if ($stock_total == 0) { ?>style="text-decoration: line-through;" <?php } ?>>
                        <?php echo $article['prix'] ?> €
                    </h3>
                    <div class="label">Vendu par :</div>
                    <p style="width:400px;"><?php echo ucfirst($vendeur['prenom']) . ' ' . strtoupper($vendeur['nom']) ?></p>
                    <div class="label">Description :</div>
                    <p style="width:400px;"><?php echo $article['description'] ?></p>
                    <div class="label">Modèle :</div>
                    <select class="form-control" name="stock_id" required>
                        <?php if ($stock_total == 0) { ?><option disabled selected>Plus de stock</option><?php } ?>
                        <?php
                        $req = $bdd->query('SELECT * FROM stocks WHERE article_id = ' . $_GET['id']);
                        while ($tmp = $req->fetch()) { ?>
                            <option value="<?php echo $tmp['id'] ?>" <?php if ($tmp['stock'] == 0) echo "disabled" ?>><?php echo $tmp['couleur'] ?> / <?php echo $tmp['taille'] ?> (<?php echo $tmp['stock'] ?> restants)</option>
                        <?php } ?>
                    </select>
                    <div class="label">Quantité :</div>
                    <input class="form-control" type="number" name="quantite" value="1" required />
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
                    <input class="btn" type="submit" value="Ajouter au panier" <?php if ($stock_total == 0 or $_SESSION['utilisateur']['type'] == 'vendeur') { ?>disabled<?php } ?> />
                    <?php if ($_SESSION['utilisateur']['type'] == 'vendeur') { ?>
                        <span>Vous ne pouvez pas acheter car vous êtes vendeur.</span>
                    <?php } ?>
                    <?php if ($_GET['succes']) { ?> <div class="alert alert-success">Ajouté au panier !</div> <?php } ?>
                    <?php if ($_GET['erreur']) { ?> <div class="alert alert-danger">Pas assez de stock...</div> <?php } ?>

                    <?php if ($_SESSION['utilisateur']['admin']) { ?>
                        <div class="admin-boutons">
                            <a href="actions/changerarticle.php?type=<?php echo $article['visible'] == '1' ? 'invisible' : 'visible' ?>&id=<?php echo $article['id'] ?>">
                                <img alt="visibilite" src="images/<?php echo $article['visible'] == '1' ? 'visible' : 'invisible' ?>.png" width="20px" height="20px" />
                                Rendre <?php echo $article['visible'] == "1" ? 'invisible' : 'visible' ?>
                            </a>
                            <a href="actions/changerarticle.php?type=vider&id=<?php echo $article['id'] ?>">
                                <img alt="visibilite" src="images/supprimer.png" width="15px" height="15px" />
                                Vider les stocks
                            </a>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>