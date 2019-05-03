<!DOCTYPE html>
<html>

<?php
session_start();
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Ajouter un stock',
    'page' => 'ajoutstock'
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
                <h1>Ajouter un stock</h1>
                <form method="post" action="forms/ajoutstock.php">
                    <?php if ($_GET['erreur'] == 1) { ?><p class="erreur">Incorrect, Réessayez.</p> <?php } ?>
                    <select class="form-control" name="article" required>
                        <option value="" disabled selected>Selectionnez un de vos articles</option>
                        <?php
                        $req = $bdd->query('SELECT * FROM articles WHERE vendeur_id = ' . $_SESSION['utilisateur']['ID']);
                        while ($tmp = $req->fetch()) { ?>
                            <option value="<?php echo $tmp['id'] ?>"><?php echo $tmp['nom'] ?></option>
                        <?php } ?>
                    </select>
                    <input class="form-control" type="text" name="couleur" placeholder="Couleur" required />
                    <input class="form-control" type="text" name="taille" placeholder="Taille" required />
                    <input class="form-control" type="number" name="stock" placeholder="Quantité de stock" required />
                    <input class="btn" type="submit" value="Ajouter" />
                </form>
            </div>
        </div>

    </div>
</body>

</html>