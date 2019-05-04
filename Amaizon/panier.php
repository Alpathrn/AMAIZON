<!DOCTYPE html>
<html>

<?php
session_start();
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Panier',
    'page' => 'panier'
];
include('head.php');
?>

<body scroll="no">
    <?php
    include('menu.php')
    ?>
    <div id="content" class="container">
        <h1>Bienvenue sur Amaizon ! <span style="font-size: 14px;">Faites comme à la maison</span></h1>
        <h2>Panier</h2>
        <div id="panier">
            <?php
            $total = 0;
            foreach ($_SESSION['panier'] as $key => $value) {
                $reqarticle = $bdd->query('SELECT * FROM articles WHERE id = ' . $value['article_id']);
                $article = $reqarticle->fetch();
                $reqstock = $bdd->query('SELECT * FROM stocks WHERE id = ' . $key);
                $stock = $reqstock->fetch();
                $total += $article['prix'] * $value['quantite'] ?>
                <div class="row justify-content-start">
                    <div class="col-sm-1 stock-img-container"><img alt="" src="<?php echo (chemin_photo('images/articles/', $article['id'])) ?>" /></div>
                    <div class="col-sm" style="text-align:left;"><span class="stock-article-nom"><?php echo $article['nom'] ?></span>
                        / <span><?php echo $stock['taille'] ?></span>
                        / <span><?php echo $stock['couleur'] ?></span>
                    </div>
                    <div class="col-sm-2 prix">
                        <?php echo $article['prix'] * $value['quantite'] ?> €
                    </div>
                    <div class="col-sm-2 row">
                        <div style="width:50px;"><a href="">-</a></div>
                        <div style="width:50px;"><?php echo $value['quantite'] ?></div>
                        <div style="width:50px;"><a href="">+</a></div>
                    </div>

                    <div class="col-sm-1">
                        <a href=""><img alt="supprimer" src="images/supprimer.png" width="20px" height="20px" /></a>
                    </div>
                </div>
            <?php } ?>
            <div style="text-align: right; padding-right: 32px; margin-top: 40px;">
                <div id="prix-total"><?php echo $total ?> € </div><br />
                <a id="commander" href="">Commander</a>
            </div>
        </div>
    </div>
</body>

</html>