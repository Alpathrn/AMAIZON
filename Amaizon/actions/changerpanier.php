<?php
session_start();

foreach ($_SESSION['panier'] as $key => $value) {
    if ($key == $_GET['id']) {
        if ($_GET['type'] == 'augmenter') {
            $_SESSION['panier'][$key]['quantite'] += 1;
        } elseif ($_GET['type'] == 'diminuer') {
            $_SESSION['panier'][$key]['quantite'] -= 1;
        }
        if ($_SESSION['panier'][$key]['quantite'] == 0 or $_GET['type'] == 'supprimer') {
            unset($_SESSION['panier'][$key]);
        }
    }
}

header('Location: ../panier.php');
