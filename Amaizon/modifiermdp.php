<!DOCTYPE html>
<html>

<?php
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Modifier MDP',
    'page' => 'modifiermdp'
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
                <h1>Modifier le MdP</h1>
                <form method="post" action="forms/modifiermdp.php">
                    <?php if ($_GET['erreur'] == 1) { ?><p class="erreur">Incorrect, Réessayez.</p> <?php } ?>
                    <input class="form-control" type="password" name="ancien" placeholder="Ancien mot de passe" autofocus />
                    <input class="form-control" type="password" name="mdp" placeholder="Nouveau mot de passe" />
                    <input class="form-control" type="password" name="confirmation" placeholder="Confirmation" />
                    <input class="btn" type="submit" value="Changer le mot de passe" /><br />
                </form>
            </div>
        </div>

    </div>
</body>

</html>