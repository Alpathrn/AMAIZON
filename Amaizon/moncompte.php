<!DOCTYPE html>
<html>

<?php
setlocale(LC_TIME, "fr_FR");
date_default_timezone_set('Europe/Paris');

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$req = $bdd->query('SELECT * FROM utilisateurs WHERE ID = ' . $_SESSION['utilisateur']['ID']);
$utilisateur = $req->fetch();
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Mon Compte',
    'page' => 'moncompte'
];
include('head.php');
?>

<body scroll="no">
    <?php
    include('menu.php')
    ?>
    <div id="content" class="container">
        <h1>Bienvenue sur Amaizon ! <span style="font-size: 14px;">Faites comme à la maison</span></h1>
        <h2>Mon Compte</h2>
        <div class="row justify-content-between" style="margin-top: 50px;">
            <div class="col-lg-7 compte-infos">
                <h3>Mes informations</h3>
                <div class="row">

                    <div class="col-12" style="height: 20px;"></div>
                    <div class="col-3">Compte</div>
                    <div class="col-9"><?php if ($utilisateur['admin']) {
                                            echo "Admin";
                                        } elseif ($utilisateur['type'] == 'acheteur') {
                                            echo "Acheteur";
                                        } elseif ($utilisateur['type'] == 'vendeur') {
                                            echo "Vendeur";
                                        } elseif ($i == 2) {
                                            echo "Acheteur & Vendeur";
                                        } ?></div>

                    <div class="col-12" style="height: 20px;"></div>
                    <div class="col-3">Nom</div>
                    <div class="col-7"><?php echo ucfirst($utilisateur['prenom']) . ' ' . strtoupper($utilisateur['nom']) ?></div>
                    <div class="col-2" style="text-align: right;">
                        <a href="">Modifier</a>
                    </div>
                    <div class="col-3">Mail</div>
                    <div class="col-9"><?php echo $utilisateur['mail'] ?></div>
                    <div class="col-3">Adresse</div>
                    <div class="col-9"><?php echo $utilisateur['adresse'] ?></div>
                    <div class="col-3">Téléphone</div>
                    <div class="col-9"><?php echo $utilisateur['telephone'] ?></div>

                    <div class="col-12" style="height: 20px;"></div>
                    <div class="col-3">Nom Carte</div>
                    <div class="col-7"><?php echo $utilisateur['nomcarte'] ?></div>
                    <div class="col-2" style="text-align: right;">
                        <a href="">Modifier</a>
                    </div>
                    <div class="col-3">Numéro</div>
                    <div class="col-9"><?php echo substr($utilisateur['numcarte'], 0, -4) . '****' ?></div>
                    <div class="col-3">Expiration</div>
                    <div class="col-9"><?php echo $utilisateur['expiration'] ?></div>
                    <div class="col-3">CVV</div>
                    <div class="col-9">***</div>

                    <div class="col-12" style="height: 20px;"></div>
                    <div class="col-3">Mot de passe</div>
                    <div class="col-7"><?php echo str_repeat("*", strlen($utilisateur['mdp'])) ?></div>
                    <div class="col-2" style="text-align: right;">
                        <a href="modifiermdp.php">Modifier</a>
                    </div>
                </div>
                <?php if ($_GET['succes'] == 'mdp') { ?> <div class="alert alert-success">Mot de passe modifié !</div> <?php } ?>
            </div>
            <div class="col-lg-4 compte-commandes">
                <h3>Mes commandes</h3>
                <?php $reqcommandes = $bdd->query('SELECT * FROM commandes WHERE utilisateur_id = ' . $_SESSION['utilisateur']['ID'] . ' ORDER BY date DESC');
                while ($commande = $reqcommandes->fetch()) { ?>
                    <div class="col-12" style="height: 20px;"></div>
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <a href="commande.php?id=<?php echo $commande['id'] ?>">Commande #<?php echo $commande['id'] ?></a>
                        </div>
                        <div class="col-6"><?php echo strftime("%e %B %Y %Hh%M", $commande['date']) ?></div>
                    </div>
                <?php }
            ?>
            </div>
        </div>
    </div>
</body>

</html>