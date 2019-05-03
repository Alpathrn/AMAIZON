<!DOCTYPE html>
<html>

<?php
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Connexion',
    'page' => 'connexion'
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
                <h1>Connexion</h1>
                <form method="post" action="forms/connexion.php">
                    <?php if ($_GET['erreur'] == 1) { ?><p class="erreur">Incorrect, Réessayez.</p> <?php } ?>
                    <input class="form-control" type="text" name="username" placeholder="Email" autofocus />
                    <input class="form-control" type="password" name="password" placeholder="Mot de passe" />
                    <input type="hidden" name="redirection" value="<?php echo $_GET['redirection'] ?>" />
                    <input class="btn" type="submit" value="Me connecter" /><br />
                    <span>Vous n'avez pas de compte? <a href="inscription.php?redirection=<?php echo $_GET['redirection'] ?>">Inscrivez vous</a></span>
                </form>
            </div>
        </div>

    </div>
</body>

</html>