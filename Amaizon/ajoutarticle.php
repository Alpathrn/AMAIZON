<!DOCTYPE html>
<html>

<?php
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Ajouter un article',
    'page' => 'ajoutarticle'
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
                <h1>Ajouter un article</h1>
                <form method="post" action="forms/ajoutarticle.php" enctype="multipart/form-data">
                    <?php if ($_GET['erreur'] == 1) { ?><p class="erreur">Incorrect, Réessayez.</p> <?php } ?>
                    <input class="form-control" type="text" name="nom" placeholder="Nom" autofocus required />
                    <textarea class="form-control" name="description" rows="3" placeholder="Description"></textarea>
                    <select class="form-control" name="categorie" required>
                        <option value="" disabled selected>Catégorie</option>
                        <?php
                        $req = $bdd->query('SELECT * FROM categories');
                        while ($tmp = $req->fetch()) { ?>
                            <option value="<?php echo $tmp['id'] ?>"><?php echo $tmp['nom'] ?></option>
                        <?php } ?>
                    </select>
                    <input class="form-control" type="number" name="prix" placeholder="Prix (en €)" required />
                    <input class="form-control" type="text" name="couleur" placeholder="Couleur (Si vide = Couleur unique)" />
                    <input class="form-control" type="text" name="taille" placeholder="Taille (Si vide = Taille unique)" />
                    <input class="form-control" type="number" name="stock" placeholder="Quantité de stock" required />
                    <div class="file-input">
                        <label for="photo" style="margin-right:10px;">Photo:</label>
                        <input type="file" name="photo" id="photo" required />
                    </div>
                    <input class="btn" type="submit" value="Ajouter" /><br />
                    <span>Vous avez déjà ajouté cet article? <a href="ajoutstock.php">Ajoutez un stock</a></span>
                </form>
            </div>
        </div>

    </div>
</body>

</html>