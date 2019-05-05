<!DOCTYPE html>
<html>

<?php
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$page = (object)[
    'title' => 'Amaizon - Espace Admin',
    'page' => 'espaceadmin'
];
include('head.php');
?>

<body scroll="no">
    <?php
    include('menu.php')
    ?>
    <div id="content" class="container">
        <h1>Bienvenue sur Amaizon ! <span style="font-size: 14px;">Faites comme à la maison</span></h1>
        <h2>Espace Admin</h2>
        <div class="row justify-content-between">
            <div class="col-7">
                <h3 style="margin-top:40px;">Vendeurs</h3>
                <p style="margin-bottom: 0px;">Désactiver un utilisateur le bloque à la connexion et rend invisible ses articles.</p>
            </div>
            <div class="col-5" style="position: relative;">
                <div id="boutons" style="position:absolute;right:0;bottom:0;">
                    <a href="ajoutvendeur.php">+ Ajouter un vendeur</a>
                </div>
            </div>
        </div>
        <div id="liste">
            <?php
            $ureq = $bdd->query('SELECT * FROM utilisateurs WHERE type = "vendeur" OR type = "deux"');
            while ($u = $ureq->fetch()) {
                if ($u['ID'] != $_SESSION['utilisateur']['ID']) { ?>
                    <div class="row justify-content-start">
                        <div class="col-sm-1 stock-img-container"><img alt="" src="<?php echo (chemin_photo('images/profils/', $u['ID'])) ?>" /></div>
                        <div class="col-sm" style="text-align:left;<?php if ($u['actif'] == '0') { ?>text-decoration:line-through;<?php } ?>">
                            <a href="actions/changerutilisateur.php?type=<?php echo $u['actif'] == '1' ? 'desactiver' : 'activer' ?>&id=<?php echo $u['ID'] ?>"><?php echo ucfirst($u['prenom']) . ' ' . strtoupper($u['nom']) ?></a>
                            <span><?php echo $u['mail'] ?></span>
                        </div>
                        <div class=" col-sm-1">
                            <a href="actions/changerutilisateur.php?type=<?php echo $u['actif'] == '1' ? 'desactiver' : 'activer' ?>&id=<?php echo $u['ID'] ?>">
                                <img alt="desactiver" src="images/<?php echo $u['actif'] == '1' ? 'visible' : 'invisible' ?>.png" width="20px" height="20px" />
                            </a>
                        </div>
                    </div>
                <?php }
        } ?>

        </div>
    </div>
</body>

</html>