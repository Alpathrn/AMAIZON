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
            <div class="col-lg-5 compte-infos">
                <h3>Mes informations</h3>
                <div class="row">

                    <div class="col-12" style="height: 20px;"></div>
                    <div class="col-3">Compte</div>
                    <div class="col-7"><?php if ($utilisateur['admin']) {
                                            echo "Admin";
                                        } elseif ($utilisateur['type'] == 'acheteur') {
                                            echo "Acheteur";
                                        } elseif ($utilisateur['type'] == 'vendeur') {
                                            echo "Vendeur";
                                        } elseif ($utilisateur['type'] == 'deux') {
                                            echo "Acheteur & Vendeur";
                                        } ?></div>
                    <div class="col-2"></div>

                    <div class="col-12" style="height: 20px;"></div>
                    <div class="col-3">Nom</div>
                    <div class="col-7"><?php echo ucfirst($utilisateur['prenom']) . ' ' . strtoupper($utilisateur['nom']) ?></div>
                    <div class="col-2" style="text-align: right;">
                        <a href="modifierinfos.php">Modifier</a>
                    </div>
                    <div class="col-3">Mail</div>
                    <div class="col-7"><?php echo $utilisateur['mail'] ?></div>
                    <div class="col-2"></div>
                    <div class="col-3">Adresse</div>
                    <div class="col-7"><?php echo $utilisateur['adresse'] ?></div>
                    <div class="col-2"></div>
                    <div class="col-3">Téléphone</div>
                    <div class="col-7"><?php echo $utilisateur['telephone'] ?></div>
                    <div class="col-2"></div>

                    <div class="col-12" style="height: 20px;"></div>
                    <div class="col-3">Type Carte</div>
                    <div class="col-7"><?php echo $utilisateur['typecarte'] ?></div>
                    <div class="col-2" style="text-align: right;">
                        <a href="modifierinfocarte.php">Modifier</a>
                    </div>
                    <div class="col-3">Nom Carte</div>
                    <div class="col-7"><?php echo $utilisateur['nomcarte'] ?></div>
                    <div class="col-2"></div>
                    <div class="col-3">Numéro</div>
                    <div class="col-7"><?php echo substr($utilisateur['numcarte'], 0, -4) . '****' ?></div>
                    <div class="col-2"></div>
                    <div class="col-3">Expiration</div>
                    <div class="col-7"><?php echo $utilisateur['expiration'] ?></div>
                    <div class="col-2"></div>
                    <div class="col-3">CVV</div>
                    <div class="col-7">***</div>
                    <div class="col-2"></div>

                    <div class="col-12" style="height: 20px;"></div>
                    <div class="col-3">MdP</div>
                    <div class="col-7"><?php echo str_repeat("*", strlen($utilisateur['mdp'])) ?></div>
                    <div class="col-2" style="text-align: right;">
                        <a href="modifiermdp.php">Modifier</a>
                    </div>
                </div>
                <?php if ($_GET['succes'] == 'mdp') { ?> <div class="alert alert-success">Mot de passe modifié !</div> <?php } ?>
                <?php if ($_GET['succes'] == 'carte') { ?> <div class="alert alert-success">Informations bancaires modifiées !</div> <?php } ?>
                <?php if ($_GET['succes'] == 'perso') { ?> <div class="alert alert-success">Informations personnelles modifiées !</div> <?php } ?>
            </div>
            <div class="col-lg-5 compte-commandes">
                <h3>Mes commandes</h3>
                <?php $reqcommandes = $bdd->query('SELECT * FROM commandes WHERE utilisateur_id = ' . $_SESSION['utilisateur']['ID'] . ' ORDER BY date DESC');
                $total = 0;
                while ($commande = $reqcommandes->fetch()) {
                    $total += $commande['prix_total'];
                    ?>
                    <div class="col-12" style="height: 20px;"></div>
                    <div class="row justify-content-between">
                        <div class="col">
                            <a href="commande.php?id=<?php echo $commande['id'] ?>">Commande #<?php echo $commande['id'] ?></a>
                        </div>
                        <div class="col"><?php echo strftime("%e %B %Y", $commande['date']) ?></div>
                        <div class="col prix"><?php echo $commande['prix_total'] ?> €</div>
                    </div>
                <?php }
            ?>
                <div style="text-align: right; margin-top: 20px;">
                    <span id="prix-total"><?php echo $total ?> € </span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>