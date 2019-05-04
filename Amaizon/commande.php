<!DOCTYPE html>
<html>

<?php
setlocale(LC_TIME, "fr_FR");
date_default_timezone_set('Europe/Paris');

session_start();
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Commande #' . $_GET['id'],
    'page' => 'commande'
];
include('head.php');
?>

<body scroll="no">
    <?php
    include('menu.php')
    ?>
    <div id="content" class="container">
        <?php
        $reqcommande = $bdd->query('SELECT * FROM commandes WHERE id = ' . $_GET['id']);
        $commande = $reqcommande->fetch();
        $reqvente = $bdd->query('SELECT * FROM ventes WHERE commande_id = ' . $commande['id']);
        ?>
        <h1>Bienvenue sur Amaizon ! <span style="font-size: 14px;">Faites comme à la maison</span></h1>
        <h2>Commande #<?php echo $_GET['id'] ?> <span style="font-size: 14px;"><?php echo strftime("%e %B %Y %Hh%M", $commande['date']) ?></span></h2>
        <?php if ($_GET['validation'] == 'oui') { ?> <div class="alert alert-success" style="margin: 16px 0px;">Votre commande a été validée !</div> <?php } ?>
        <div id="liste">
            <?php
            while ($vente = $reqvente->fetch()) {
                $reqarticle = $bdd->query('SELECT * FROM articles WHERE id = ' . $vente['article_id']);
                $article = $reqarticle->fetch();
                $reqstock = $bdd->query('SELECT * FROM stocks WHERE id = ' . $vente['stock_id']);
                $stock = $reqstock->fetch(); ?>
                <div class="row justify-content-start">
                    <div class="col-sm-1 stock-img-container"><img alt="" src="<?php echo (chemin_photo('images/articles/', $article['id'])) ?>" /></div>
                    <div class="col-sm" style="text-align:left;"><a href="article.php?id=<?php echo $article['id'] ?>" class="stock-article-nom"><?php echo $article['nom'] ?></a>
                        <span><?php echo $stock['taille'] ?></span>
                        / <span><?php echo $stock['couleur'] ?></span>
                    </div>
                    <div class="col-sm-2 prix">
                        <?php echo $vente['prix'] ?> €
                    </div>
                </div>
            <?php } ?>
            <div style="text-align: right; padding-right: 32px; margin-top: 40px;">
                <span style="margin-right: 16px;">Total :</span>
                <span id="prix-total"><?php echo $commande['prix_total'] ?> € </span>
            </div>
        </div>
    </div>
</body>

</html>