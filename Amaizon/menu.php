<div id="menu">
    <a id="logo" class="fill" href="">
        <img alt="logo" src="amaizon_transparent.png" width="100px" height="100px" />
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
        <a class="bottom-link" href="">Mon compte</a>
        <a class="bottom-link" href="">Espace Admin</a>
        <a id="cart-button" href="">
            <img alt="panier" src="panier.png" width="20px" style="margin-top: -4px;" />
            PANIER
        </a>
    </div>
</div>