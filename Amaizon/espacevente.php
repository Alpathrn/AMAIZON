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
                        <input class="btn" type="submit" value="Modifier photo de profil" />
                    </form>
                    <form method="post" action="forms/uploadphoto.php?type=couverture" enctype="multipart/form-data">
                        <input type="file" name="photo" required />
                        <input class="btn" type="submit" value="Modifier photo de couverture" />
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="center-container" style="height: 150px;">
                <div id="ajout" class="center">
                    <a class="btn" href="ajoutarticle.php">+ Ajouter un article</a>
                    <a class="btn" href="ajoutstock.php">+ Ajouter un stock</a>
                </div>
            </div>
            <div id="stocks">
                <?php
                $req = $bdd->query('SELECT * FROM articles WHERE vendeur_id = ' . $_SESSION['utilisateur']['ID'] . ' ORDER BY id DESC');
                while ($tmp = $req->fetch()) {
                    $reqstock = $bdd->query('SELECT * FROM stocks WHERE article_id = ' . $tmp['id']);
                    while ($tmpstock = $reqstock->fetch()) { ?>
                        <div class="stock">
                            <div class="stock-nom" <?php if ($tmpstock['stock'] <= 0) { ?>style="text-decoration: line-through;" <?php } ?>>
                                <span style="font-size: 18px; font-weight: 500;"><?php echo $tmp['nom'] ?></span>
                                / <span><?php echo $tmpstock['taille'] ?></span>
                                / <span><?php echo $tmpstock['couleur'] ?></span>
                            </div>
                            <?php
                            $lien = "";
                            if ($tmpstock['stock'] > 0) {
                                $lien = 'actions/changerstock.php?type=diminuer&id=' . $tmpstock['id'];
                            }
                            ?>
                            <div><a class="btn" href="<?php echo $lien ?>">-</a></div>
                            <div><?php echo $tmpstock['stock'] ?></div>
                            <div><a class="btn" href="actions/changerstock.php?type=augmenter&id=<?php echo $tmpstock['id'] ?>">+</a></div>
                            <a href="actions/supprimerstock.php?id=<?php echo $tmpstock['id'] ?>"><img alt="supprimer" src="images/supprimer.png" width="20px" height="20px" /></a>
                        </div>
                    <?php }
            } ?>
            </div>
        </div>
    </div>
</body>

</html>