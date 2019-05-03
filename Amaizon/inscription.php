<!DOCTYPE html>
<html>

<?php
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Inscription',
    'page' => 'inscription'
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
                <h1>Inscription</h1>
                <form method="post" action="forms/inscription.php">
                    <?php if ($_GET['erreur'] == 'mail') { ?><p class="erreur">Ce mail est déjà utilisé.</p> <?php } ?>
                    <input class="form-control" type="text" name="prenom" placeholder="Prénom" autofocus required />
                    <input class="form-control" type="text" name="nom" placeholder="Nom" required />
                    <input class="form-control" type="email" name="mail" placeholder="Email" required />
                    <input class="form-control" type="password" name="mdp" placeholder="Mot de passe" required />
                    <input class="form-control" type="text" name="telephone" placeholder="Telephone (ex: +33650246789)" required />
                    <textarea class="form-control" name="adresse" rows="3" placeholder="Adresse" required></textarea>
                    <br />
                    <select class="form-control" name="type" required>
                        <option value="acheteur">Acheteur</option>
                        <option value="vendeur">Vendeur</option>
                        <option value="deux">Les deux</option>
                    </select>
                    <input class="form-control" type="text" name="nomcarte" placeholder="Nom sur la carte" required />
                    <input class="form-control" type="text" name="numcarte" placeholder="Numéro de carte bancaire" pattern=".{16}" required title="16 caractères requis." />
                    <input class="form-control" type="month" name="expiration" required />
                    <input class="form-control" type="text" name="cvv" placeholder="CVV" pattern=".{3}" required title="3 caractères requis." />
                    <input type="hidden" name="redirection" value="<?php echo $_GET['redirection'] ?>" />
                    <input class="btn" type="submit" value="Me connecter" /><br />
                    <span>Vous avez déjà un compte? <a href="connexion.php?redirection=<?php echo $_GET['redirection'] ?>">Connectez vous</a></span>
                </form>
            </div>
        </div>
    </div>
</body>

</html>