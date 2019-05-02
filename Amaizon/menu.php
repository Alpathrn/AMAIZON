<?php
session_start();
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
                while ($tmp = $req->fetch()) {
                    ?>
                    <li><a href="#category?id=<?php echo $tmp['id'] ?>"><?php echo $tmp['nom'] ?></a></li>
                <?php
            }
            ?>
            </ul>
        </li>
        <li class="menu-li">Ventes Flash
            <ul>
                <li><a href="">Meilleures Ventes</a></li>
                <li><a href="">Promotions</a></li>
            </ul>
        </li>
        <li class="menu-li">Vendre
            <ul>
                <li><a href="">Espace de vente</a></li>
            </ul>
        </li>
    </ul>
    <div id="menu-bottom">
        <?php if (!$_SESSION['utilisateur']) { ?>
            <a class="bottom-link" href="connexion.php?redirection=<?php echo str_replace('/Amaizon/', '', $_SERVER['REQUEST_URI']) ?>">Me connecter</a>
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
            <a class="bottom-link" href="">Mon compte</a>
            <a class="bottom-link" href="">Espace Admin</a>
            <a class="bottom-link" href="actions/deconnexion.php?redirection=<?php echo str_replace('/Amaizon/', '', $_SERVER['REQUEST_URI']) ?>">
                Me déconnecter
            </a>
        <?php } ?>
        <a id="cart-button" href="">
            <img alt="panier" src="images/panier.png" width="20px" style="margin-top: -4px;" />
            PANIER
        </a>
    </div>
</div>