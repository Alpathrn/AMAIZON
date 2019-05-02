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
            <div class="center" id="connexion">
                <h1>Connexion</h1>
                <form method="post" action="forms/connexion.php">
                    <?php if ($_GET['erreur'] == 1) { ?><p class="erreur">Incorrect, Réessayez.</p> <?php } ?>
                    <!-- Si erreur dans les entrées (mdp invalide ou champ non renseigné) -->
                    <input class="form-control" type="text" name="username" placeholder="Email" autofocus />
                    <input class="form-control" type="password" name="password" placeholder="Mot de passe" />
                    <input type="hidden" name="redirection" value="<?php echo $_GET['redirection'] ?>" />
                    <input class="btn" type="submit" value="Me connecter" />
                </form>
            </div>
        </div>

    </div>
</body>

</html>