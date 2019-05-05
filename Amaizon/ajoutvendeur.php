<!DOCTYPE html>
<html>

<?php
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Ajouter un vendeur',
    'page' => 'ajoutvendeur'
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
                <h1>Ajouter un vendeur</h1>
                <form method="post" action="forms/ajoutvendeur.php">
                    <?php if ($_GET['erreur'] == 'mail') { ?><p class="erreur">Ce mail est déjà utilisé.</p> <?php } ?>
                    <input class="form-control" type="text" name="prenom" placeholder="Prénom" autofocus required />
                    <input class="form-control" type="text" name="nom" placeholder="Nom" required />
                    <input class="form-control" type="email" name="mail" placeholder="Email" required />
                    <input class="form-control" type="password" name="mdp" placeholder="Mot de passe" required />
                    <input class="form-control" type="text" name="telephone" placeholder="Telephone (ex: +33650246789)" required />
                    <textarea class="form-control" name="adresse" rows="3" placeholder="Adresse" required></textarea>
                    <input class="btn" type="submit" value="Ajouter" /><br />
                    <span>Retour <a href="espaceadmin.php">espace admin</a></span>
                </form>
            </div>
        </div>
    </div>
</body>

</html>