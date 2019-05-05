<?php
session_start();
if ($_GET['redirection']) {
    $redirection = $_GET['redirection'];
} else {
    $redirection = str_replace('/Amaizon/', '', $_SERVER['REQUEST_URI']);
}
?>

<div id="menu">
    <a id="logo" class="fill" href="index.php">
        <img alt="logo" src="images/amaizon_transparent.png" width="100px" height="100px" />
    </a>
    <ul>
        <li class="menu-li">Catégories
            <ul>
                <?php
                $req = $bdd->query('SELECT * FROM categories');
                while ($tmp = $req->fetch()) { ?>
                    <li><a href="categorie.php?id=<?php echo $tmp['id'] ?>" class="<?php selected($page, $tmp['nomsimple']) ?>"><?php echo $tmp['nom'] ?></a></li>
                <?php } ?>
            </ul>
        </li>
        <li class="menu-li">Ventes Flash
            <ul>
                <li><a href="top_ventes.php" class="<?php selected($page, 'top_ventes') ?>">Meilleures Ventes</a></li>
                <li><a href="promotions.php" class="<?php selected($page, 'promotions') ?>">Promotions</a></li>
            </ul>
        </li>
        <?php if ($_SESSION['utilisateur']['type'] == 'deux' or $_SESSION['utilisateur']['type'] == 'vendeur') { ?>
            <li class="menu-li">Vendre
                <ul>
                    <li><a href="espacevente.php" class="<?php selected($page, 'espacevente') ?>">Espace de vente</a></li>
                </ul>
            </li>
        <?php } ?>
    </ul>
    <div id="menu-bottom">
        <?php if (!$_SESSION['utilisateur']) { ?>
            <a class="bottom-link <?php selected($page, 'connexion') ?>" href="connexion.php?redirection=<?php echo $redirection ?>">Me connecter</a>
            <a class="bottom-link <?php selected($page, 'inscription') ?>" href="inscription.php?redirection=<?php echo $redirection ?>">M'inscrire</a>
        <?php } else { ?>
            <div id="utilisateur">
                <div class="center">
                    <img alt="utilisateur" src="images/utilisateur.png" width="30px" height="30px">
                    <div>
                        <span><?php echo ucfirst($_SESSION['utilisateur']['prenom']) . ' ' . strtoupper($_SESSION['utilisateur']['nom']) ?></span>
                        <span><?php echo $_SESSION['utilisateur']['mail'] ?></span>
                    </div>
                </div>
            </div>
            <a class="bottom-link <?php selected($page, 'moncompte') ?>" href="moncompte.php">Mon compte</a>
            <?php if ($_SESSION['utilisateur']['admin']) { ?><a class="bottom-link <?php selected($page, 'espaceadmin') ?>" href="espaceadmin.php">Espace Admin</a><?php } ?>
            <a class="bottom-link" href="actions/deconnexion.php">
                Me déconnecter
            </a>
        <?php } ?>
        <a id="cart-button" href="panier.php">
            <img alt="panier" src="images/panier.png" width="20px" style="margin-top: -4px;" />
            PANIER <?php if (count($_SESSION['panier'])) echo '(' . count($_SESSION['panier']) . ')' ?>
        </a>
    </div>
</div>