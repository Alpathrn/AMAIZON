<!DOCTYPE html>
<html>

<?php
session_start();
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Commander',
    'page' => 'commander'
];
include('head.php');
?>

<body scroll="no">
    <?php
    include('menu.php')
    ?>
    <div id="content" class="container">
        <div class="center-container">
            <div class="center formulaire">
                <h1>Commander</h1>
                <form method="post" action="forms/commander.php">
                    <input class="form-control" type="text" name="prenom" placeholder="Prénom de livraison" value="<?php echo ucfirst($_SESSION['utilisateur']['prenom']) ?>" autofocus required />
                    <input class="form-control" type="text" name="nom" placeholder="Nom de livraison" value="<?php echo strtoupper($_SESSION['utilisateur']['nom']) ?>" required />
                    <textarea class="form-control" name="adresse" rows="3" placeholder="Adresse de livraison" required><?php echo $_SESSION['utilisateur']['adresse'] ?></textarea>
                    <input class="form-control" type="text" name="telephone" placeholder="Telephone" value="<?php echo $_SESSION['utilisateur']['telephone'] ?>" required />
                    <br />
                    <input class="form-control" type="text" name="nomcarte" placeholder="Nom sur la carte" required />
                    <input class="form-control" type="text" name="numcarte" placeholder="Numéro de carte bancaire" pattern=".{16}" required title="16 caractères requis." />
                    <input class="form-control" type="month" name="expiration" required />
                    <input class="form-control" type="text" name="cvv" placeholder="CVV" pattern=".{3}" required title="3 caractères requis." />
                    <?php foreach ($_SESSION['panier'] as $key => $value) {
                        $reqarticle = $bdd->query('SELECT * FROM articles WHERE id = ' . $value['article_id']);
                        $article = $reqarticle->fetch();
                        $reqstock = $bdd->query('SELECT * FROM stocks WHERE id = ' . $key);
                        $stock = $reqstock->fetch();
                        $total += $article['prix'] * $value['quantite'];
                    } ?>
                    <div style="margin: 16px 0px;text-align: right;">
                        <span style="margin-right: 16px;">Total :</span>
                        <span id="prix-total"><?php echo $total ?> €</span>
                    </div>
                    <?php if ($_GET['erreur'] == 'carte') { ?> <div class="alert alert-danger">Informations bancaires incorrectes.</div> <?php } ?>
                    <input id="commander" style="margin: 0px;" type="submit" value="Passer Commande" /><br />
                    <span>Ce n'est pas ce que vous voulez commander? <a href="panier.php">Retournez au panier</a></span>
                </form>
            </div>
        </div>
    </div>
</body>

</html>