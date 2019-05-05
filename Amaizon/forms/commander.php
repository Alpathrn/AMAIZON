<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$req = $bdd->query('SELECT * FROM utilisateurs WHERE ID = ' . $_SESSION['utilisateur']['ID']);
$erreur = false;
$utilisateur = $req->fetch();

if ($utilisateur['typecarte'] == $_POST['typecarte']) {
    if (strtolower($utilisateur['nomcarte']) == strtolower($_POST['nomcarte'])) {
        if ($utilisateur['numcarte'] == $_POST['numcarte']) {
            if ($utilisateur['expiration'] == $_POST['expiration']) {
                if ($utilisateur['cvv'] == $_POST['cvv']) {
                    $bdd->prepare(
                        'INSERT INTO 
                        commandes (utilisateur_id, prenom, nom, adresse, telephone, date, prix_total) 
                        VALUES 
                        (' . $_SESSION['utilisateur']['ID'] . ', ?, ?, ?, ?, ' . time() . ', 0)'
                    )->execute(array($_POST['prenom'], $_POST['nom'], $_POST['adresse'], $_POST['telephone']));

                    $reqcommande = $bdd->query('SELECT * FROM commandes ORDER BY id DESC');
                    $commande = $reqcommande->fetch();

                    foreach ($_SESSION['panier'] as $key => $value) {
                        $reqarticle = $bdd->query('SELECT * FROM articles WHERE id = ' . $value['article_id']);
                        $article = $reqarticle->fetch();
                        $prix = $article['promotion'] == '0' ? $article['prix'] : $article['prix'] - ($article['prix'] * $article['promotion'] / 100);
                        $reqstock = $bdd->query('SELECT * FROM stocks WHERE id = ' . $key);
                        $stock = $reqstock->fetch();

                        $bdd->prepare(
                            'INSERT INTO 
                            ventes (utilisateur_id, article_id, stock_id, commande_id, quantite, prix) 
                            VALUES 
                            (' . $_SESSION['utilisateur']['ID'] . ', ' . $article['id'] . ', ' . $stock['id'] . ', ' . $commande['id'] . ', ?, ?)'
                        )->execute(array($value['quantite'], $prix * $value['quantite']));

                        $reduire_stock = $bdd->prepare('UPDATE stocks SET stock = stock - ' . $value['quantite'] . ' WHERE id = ?');
                        $reduire_stock->execute(array($stock['id']));

                        $total += $prix * $value['quantite'];
                    }

                    $req = $bdd->prepare('UPDATE commandes SET prix_total = ? WHERE id = ?');
                    $req->execute(array($total, $commande['id']));

                    unset($_SESSION['panier']);
                    unset($_SESSION['dernier_formulaire']);

                    header('Location: ../commande.php?validation=oui&id=' . $commande['id']);
                } else {
                    $erreur = 'cvv';
                }
            } else {
                $erreur = 'expiration';
            }
        } else {
            $erreur = 'num';
        }
    } else {
        $erreur = 'nom';
    }
} else {
    $erreur = 'type';
}
if ($erreur) {
    $_SESSION['dernier_formulaire'] = $_POST;
    header('Location: ../commander.php?erreur=' . $erreur);
}
