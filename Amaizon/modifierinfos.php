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
                <h1>Modifier les informations personnelles</h1>
                <?php
                $req = $bdd->query('SELECT * FROM utilisateurs WHERE ID = ' . $_SESSION['utilisateur']['ID']);
                $utilisateur = $req->fetch();
                ?>
                <form method="post" action="forms/modifierinfos.php">
                    <?php if ($_GET['erreur'] == 1) { ?><p class="erreur">Incorrect, Réessayez.</p> <?php } ?>

                    <input value="<?php echo $utilisateur['nom'] ?>" class="form-control" type="text" name="nom" placeholder="Nouveau nom" required />
                    <input value="<?php echo $utilisateur['prenom'] ?>" class="form-control" type="text" name="prenom" placeholder="Nouveau prénom" required />
                    <input value="<?php echo $utilisateur['mail'] ?>" class="form-control" type="email" name="mail" placeholder="Nouveau mail" required />
                    <input value="<?php echo $utilisateur['telephone'] ?>" class="form-control" type="text" name="telephone" placeholder="Nouveau téléphone (ex: +33606060606)" required />
                    <input value="<?php echo $utilisateur['adresse'] ?>" class="form-control" type="text" name="adresse" placeholder="Nouvelle adresse" required />

                    <input class="btn" type="submit" value="Changer les informations personnelles" /><br />
                </form>
            </div>
        </div>

    </div>
</body>

</html>