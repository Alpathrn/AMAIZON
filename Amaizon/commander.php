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
                    <select class="form-control" name="typecarte" required>
                        <option disabled <?php echo $_SESSION['dernier_formulaire'] ? '' : 'selected' ?>>Type de carte</option>
                        <option value="Visa" <?php echo $_SESSION['dernier_formulaire']['typecarte'] == 'Visa' ? 'selected' : '' ?>>Visa</option>
                        <option value="Mastercard" <?php echo $_SESSION['dernier_formulaire']['typecarte'] == 'Mastercard' ? 'selected' : '' ?>>Mastercard</option>
                        <option value="American Express" <?php echo $_SESSION['dernier_formulaire']['typecarte'] == 'American Express' ? 'selected' : '' ?>>American Express</option>
                        <option value="Paypal" <?php echo $_SESSION['dernier_formulaire']['typecarte'] == 'Paypal' ? 'selected' : '' ?>>Paypal</option>
                    </select>
                    <input value="<?php echo $_SESSION['dernier_formulaire']['nomcarte'] ?>" class="form-control" type="text" name="nomcarte" placeholder="Nom sur la carte" required />
                    <input value="<?php echo $_SESSION['dernier_formulaire']['numcarte'] ?>" class="form-control" type="text" name="numcarte" placeholder="Numéro de carte bancaire" pattern=".{16}" required title="16 caractères requis." />
                    <input value="<?php echo $_SESSION['dernier_formulaire']['expiration'] ?>" class="form-control" type="month" name="expiration" required />
                    <input value="<?php echo $_SESSION['dernier_formulaire']['cvv'] ?>" class="form-control" type="text" name="cvv" placeholder="CVV" pattern=".{3}" required title="3 caractères requis." />
                    <?php unset($_SESSION['dernier_formulaire']) ?>
                    <?php foreach ($_SESSION['panier'] as $key => $value) {
                        $reqarticle = $bdd->query('SELECT * FROM articles WHERE id = ' . $value['article_id']);
                        $article = $reqarticle->fetch();
                        $prix = $article['promotion'] == '0' ? $article['prix'] : $article['prix'] - ($article['prix'] * $article['promotion'] / 100);
                        $reqstock = $bdd->query('SELECT * FROM stocks WHERE id = ' . $key);
                        $stock = $reqstock->fetch();
                        $total += $prix * $value['quantite'];
                    } ?>
                    <div style="margin: 16px 0px;text-align: right;">
                        <span style="margin-right: 16px;">Total :</span>
                        <span id="prix-total"><?php echo $total ?> €</span>
                    </div>
                    <?php if ($_GET['erreur'] == 'type') { ?> <div class="alert alert-danger">Type de carte incorrect.</div> <?php } ?>
                    <?php if ($_GET['erreur'] == 'nom') { ?> <div class="alert alert-danger">Nom de la carte incorrect.</div> <?php } ?>
                    <?php if ($_GET['erreur'] == 'num') { ?> <div class="alert alert-danger">Numéro de la carte incorrect.</div> <?php } ?>
                    <?php if ($_GET['erreur'] == 'expiration') { ?> <div class="alert alert-danger">Date d'expiration incorrect.</div> <?php } ?>
                    <?php if ($_GET['erreur'] == 'cvv') { ?> <div class="alert alert-danger">CVV incorrect.</div> <?php } ?>
                    <input id="commander" style="margin: 0px;" type="submit" value="Passer Commande" /><br />
                    <span>Ce n'est pas ce que vous voulez commander? <a href="panier.php">Retournez au panier</a></span>
                </form>
            </div>
        </div>
    </div>
</body>

</html>