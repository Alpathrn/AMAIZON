<!DOCTYPE html>
<html>

<?php
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Modifier Infos',
    'page' => 'modifierinfos'
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
                <h1>Modifier les informations bancaires</h1>
                <?php
                $req = $bdd->query('SELECT * FROM utilisateurs WHERE ID = ' . $_SESSION['utilisateur']['ID']);
                $utilisateur = $req->fetch();
                ?>
                <form method="post" action="forms/modifierinfocarte.php">
                    <?php if ($_GET['erreur'] == 1) { ?><p class="erreur">Incorrect, Réessayez.</p> <?php } ?>
                    <select class="form-control" name="typecarte" required>
                        <option value="Visa" <?php echo $utilisateur['typecarte'] == 'Visa' ? 'selected' : '' ?>>Visa</option>
                        <option value="Mastercard" <?php echo $utilisateur['typecarte'] == 'Mastercard' ? 'selected' : '' ?>>Mastercard</option>
                        <option value="American Express" <?php echo $utilisateur['typecarte'] == 'American Express' ? 'selected' : '' ?>>American Express</option>
                        <option value="Paypal" <?php echo $utilisateur['typecarte'] == 'Paypal' ? 'selected' : '' ?>>Paypal</option>
                    </select>
                    <input value="<?php echo $utilisateur['nomcarte'] ?>" class="form-control" type="text" name="nomcarte" placeholder="Nouveau nom de la carte" autofocus />
                    <input value="<?php echo $utilisateur['numcarte'] ?>" class="form-control" type="text" name="numcarte" placeholder="Nouveau numéro de carte bancaire" pattern=".{16}" required title="16 caractères requis." />
                    <input value="<?php echo $utilisateur['expiration'] ?>" class="form-control" type="month" name="expiration" placeholder="Nouvelle date d'expiration" />
                    <input value="<?php echo $utilisateur['cvv'] ?>" class="form-control" type="text" name="cvv" placeholder="Nouveau code CVV" pattern=".{3}" required title="3 caractères requis." />

                    <input class="btn" type="submit" value="Changer les informations bancaires" /><br />
                </form>
            </div>
        </div>

    </div>
</body>

</html>