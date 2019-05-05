<!DOCTYPE html>
<html>

<?php
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$req = $bdd->prepare('SELECT * FROM categories WHERE id = ?');
$req->execute(array($_GET['id']));
$categorie = $req->fetch();

$page = (object)[
    'title' => 'Amaizon - ' . $categorie['nom'],
    'page' => 'category'
];
include('head.php');
?>

<body scroll="no">
    <?php
    include('menu.php')
    ?>
    <div id="content" class="container">
        <h1>Bienvenue sur Amaizon ! <span style="font-size: 14px;">Faites comme à la maison</span></h1>
        <h2>Meilleures ventes</h2>
        <?php
        // Requête qui permet de classer les articles les mieux vendus en les triant par ordre décroissant du nombre de stocks vendus.
        $reqordre = $bdd->query('SELECT SUM(quantite) as nombre_ventes, article_id FROM ventes GROUP BY article_id ORDER BY nombre_ventes DESC');

        $top_articles_livres = array();
        $top_articles_musique = array();
        $top_articles_vetements = array();
        $top_articles_sportsloisirs = array();

        while ($tmp = $reqordre->fetch()) {
            $reqarticle = $bdd->query('SELECT * FROM articles WHERE id = ' . $tmp['article_id']);
            $article = $reqarticle->fetch();
            if (count($top_articles_livres) < 4 && $article['categorie'] == 1) {
                $top_articles_livres[$article['id']] = $tmp['nombre_ventes'];
            }
            if (count($top_articles_musique) < 4 && $article['categorie'] == 2) {
                $top_articles_musique[$article['id']] = $tmp['nombre_ventes'];
            }
            if (count($top_articles_vetements) < 4 && $article['categorie'] == 3) {
                $top_articles_vetements[$article['id']] = $tmp['nombre_ventes'];
            }
            if (count($top_articles_sportsloisirs) < 4 && $article['categorie'] == 4) {
                $top_articles_sportsloisirs[$article['id']] = $tmp['nombre_ventes'];
            }
        }
        ?>
        <h2>Livres</h2>
        <div class="row">
            <?php
            $articles = 0;
            foreach ($top_articles_livres as $id => $ventes) {
                $reqarticle = $bdd->query('SELECT * FROM articles WHERE id = ' . $id);
                $tmp = $reqarticle->fetch();
                $custom = 'Total vendus : ' . $ventes;
                include('article_bloc.php');
                $articles += 1;
            }
            if (!$articles) { ?>
                <div class="center-container" style="height:300px;">
                    <div class="center">Pas de ventes dans cette catégorie</div>
                </div>
            <?php }
        ?>
        </div>
        <h2>Musique</h2>
        <div class="row">
            <?php
            $articles = 0;
            foreach ($top_articles_musique as $id => $ventes) {
                $reqarticle = $bdd->query('SELECT * FROM articles WHERE id = ' . $id);
                $tmp = $reqarticle->fetch();
                $custom = 'Total vendus : ' . $ventes;
                include('article_bloc.php');
                $articles += 1;
            }
            if (!$articles) { ?>
                <div class="center-container" style="height:300px;">
                    <div class="center">Pas de ventes dans cette catégorie</div>
                </div>
            <?php }
        ?>
        </div>
        <h2>Vêtements</h2>
        <div class="row">
            <?php
            $articles = 0;
            foreach ($top_articles_vetements as $id => $ventes) {
                $reqarticle = $bdd->query('SELECT * FROM articles WHERE id = ' . $id);
                $tmp = $reqarticle->fetch();
                $custom = 'Total vendus : ' . $ventes;
                include('article_bloc.php');
                $articles += 1;
            }
            if (!$articles) { ?>
                <div class="center-container" style="height:300px;">
                    <div class="center">Pas de ventes dans cette catégorie</div>
                </div>
            <?php }
        ?>
        </div>
        <h2>Sports & Loisirs</h2>
        <div class="row">
            <?php
            $articles = 0;
            foreach ($top_articles_sportsloisirs as $id => $ventes) {
                $reqarticle = $bdd->query('SELECT * FROM articles WHERE id = ' . $id);
                $tmp = $reqarticle->fetch();
                $custom = 'Total vendus : ' . $ventes;
                include('article_bloc.php');
                $articles += 1;
            }
            if (!$articles) { ?>
                <div class="center-container" style="height:300px;">
                    <div class="center">Pas de ventes dans cette catégorie</div>
                </div>
            <?php }
        ?>
        </div>
    </div>
</body>

</html>