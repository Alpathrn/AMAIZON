<!DOCTYPE html>
<html>

<?php
session_start();
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Espace de Vente',
    'page' => 'index'
];
include('head.php');
?>

<body scroll="no">
    <?php
    include('menu.php')
    ?>
    <div id="content" class="container">

        <div id="photocouverture">
            <img alt="couverture" src="<?php echo (chemin_photo('images/couvertures/', $_SESSION['utilisateur']['ID'])) ?>" />
        </div>
        <div id="couverturebandeau">
            <h1><span>Bienvenue sur Amaizon ! <span style="font-size: 14px;">Faites comme à la maison</span></span></h1>
            <h2><span>Espace de vente</span></h2>
            <div id="profil">
                <div id="profil-img">
                    <img alt="profil" src="<?php echo (chemin_photo('images/profils/', $_SESSION['utilisateur']['ID'])) ?>" />
                </div>
                <div style="width: 90%; padding-top: 20px;">
                    <span style="font-size: 18px;"><?php echo ucfirst($_SESSION['utilisateur']['prenom']) . ' ' . strtoupper($_SESSION['utilisateur']['nom']) ?></span>
                    <form style="margin-top: 10px;" method="post" action="forms/uploadphoto.php?type=profil" enctype="multipart/form-data">
                        <input type="file" name="photo" required />
                        <input type="submit" value="Modifier photo de profil" />
                    </form>
                    <form method="post" action="forms/uploadphoto.php?type=couverture" enctype="multipart/form-data">
                        <input type="file" name="photo" required />
                        <input type="submit" value="Modifier photo de couverture" />
                    </form>
                </div>
            </div>
        </div>


        <div id="boutons" style="margin-top: 20px; text-align:right;">
            <a href="ajoutarticle.php">+ Ajouter un article</a>
            <a href="ajoutstock.php">+ Ajouter un stock</a>
        </div>

        <div id="liste">
            <?php
            $req = $bdd->query('SELECT * FROM articles WHERE vendeur_id = ' . $_SESSION['utilisateur']['ID'] . ' ORDER BY id DESC');
            while ($article = $req->fetch()) {
                $promotion_affiche = false;
                $reqstock = $bdd->query('SELECT * FROM stocks WHERE article_id = ' . $article['id']);
                while ($stock = $reqstock->fetch()) { ?>

                    <div class="row justify-content-between">
                        <div class="col-sm-1 stock-img-container"><img alt="" src="<?php echo (chemin_photo('images/articles/', $article['id'])) ?>" /></div>
                        <div class="col-sm" style="text-align:left;<?php if ($stock['stock'] <= 0) { ?>text-decoration: line-through;<?php } ?>"><a href="article.php?id=<?php echo $article['id'] ?>" class="stock-article-nom"><?php echo $article['nom'] ?></a>
                            <span><?php echo $stock['taille'] ?></span>
                            / <span><?php echo $stock['couleur'] ?></span>
                        </div>
                        <div class="col-sm-2 row">
                            <?php
                            $lien_moins = "";
                            if ($stock['stock'] > 0) {
                                $lien_moins = 'actions/changerstock.php?type=diminuer&id=' . $stock['id'];
                            }
                            ?>
                            <div style="width:50px;"><a href="<?php echo $lien_moins ?>">-</a></div>
                            <div style="width:50px;"><?php echo $stock['stock'] ?></div>
                            <div style="width:50px;"><a href="actions/changerstock.php?type=augmenter&id=<?php echo $stock['id'] ?>">+</a></div>
                        </div>

                        <div class="col-sm-2" style="text-align: right;">
                            <?php if (!$promotion_affiche) {
                                $promotion_affiche = true; ?>
                                <form action="forms/ajoutpromotion.php" method="post">
                                    <?php echo $article['prix'] ?>€ -
                                    <input type="number" value="<?php echo $article['promotion'] ?>" min="0" max="100" name="promotion" required /> %
                                    <input type="hidden" name="id" value="<?php echo $article['id'] ?>" />
                                    <input type="submit" style="display:none;" />
                                </form>
                            <?php } ?>
                        </div>

                        <div class="col-sm-1">
                            <a href="actions/supprimerstock.php?id=<?php echo $stock['id'] ?>">
                                <img alt="supprimer" src="images/supprimer.png" width="20px" height="20px" />
                            </a>
                        </div>
                    </div>

                <?php }
        } ?>
        </div>
    </div>
</body>

</html>