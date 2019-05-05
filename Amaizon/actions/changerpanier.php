<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

foreach ($_SESSION['panier'] as $key => $value) {
    if ($key == $_GET['id']) {
        if ($_GET['type'] == 'augmenter') {
            $reqstock = $bdd->query('SELECT * FROM stocks WHERE id = ' . $key);
            $stock = $reqstock->fetch();
            if ($stock['stock'] > $_SESSION['panier'][$key]['quantite']) {
                $_SESSION['panier'][$key]['quantite'] += 1;
            }
        } elseif ($_GET['type'] == 'diminuer') {
            $_SESSION['panier'][$key]['quantite'] -= 1;
        }
        if ($_SESSION['panier'][$key]['quantite'] == 0 or $_GET['type'] == 'supprimer') {
            unset($_SESSION['panier'][$key]);
        }

        if ($_SESSION['utilisateur']) {
            $reqpanier = $bdd->query('SELECT * FROM paniers WHERE id = ' . $_SESSION['utilisateur']['ID']);
            $panier = $reqpanier->fetch();
            if (!$panier) {
                $bdd->prepare(
                    'INSERT INTO paniers (panier, id) VALUES (?, ?)'
                )->execute(array(serialize($_SESSION['panier']), $_SESSION['utilisateur']['ID']));
            } else {
                $bdd->prepare(
                    'UPDATE paniers SET panier = ? WHERE id = ?'
                )->execute(array(serialize($_SESSION['panier']), $_SESSION['utilisateur']['ID']));
            }
        }
    }
}

header('Location: ../panier.php');
