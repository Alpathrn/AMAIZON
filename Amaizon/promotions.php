<!DOCTYPE html>
<html>

<?php
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Promotions',
    'page' => 'promotions'
];
include('head.php');
?>

<body scroll="no">
    <?php
    include('menu.php')
    ?>
    <div id="content" class="container">
        <h1>Bienvenue sur Amaizon ! <span style="font-size: 14px;">Faites comme à la maison</span></h1>
        <h2>Promotions</h2>
        <div class="row">
            <?php
            $req = $bdd->query('SELECT * FROM articles WHERE promotion > 0 ORDER BY id DESC');
            while ($tmp = $req->fetch()) {
                include('article_bloc.php');
            }
            ?>
        </div>
    </div>
</body>

</html>