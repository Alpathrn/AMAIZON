<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');
$req = $bdd->query('SELECT * FROM utilisateurs');

while ($tmp = $req->fetch()) {
    if ($_POST['username'] == $tmp['mail'] and $_POST['password'] == $tmp['mdp']) {
        if ($tmp['actif']) {
            $_SESSION['utilisateur'] = $tmp;
            $erreur = false;
        } else {
            $erreur = 'desactive';
        }
        break;
    } else {
        $erreur = 'identifiants';
    }
}

$req->closeCursor();

if (!$erreur) {
    $reqpanier = $bdd->query('SELECT * FROM paniers WHERE id = ' . $_SESSION['utilisateur']['ID']);
    $panier = $reqpanier->fetch();
    if ($panier) {
        if ($_SESSION['panier']) {
            foreach (unserialize($panier['panier']) as $bdd_stock_id => $bdd_value) {
                if (array_key_exists($bdd_stock_id, $_SESSION['panier'])) {
                    $_SESSION['panier'][$bdd_stock_id]['quantite'] += $bdd_value['quantite'];
                } else {
                    $_SESSION['panier'][$bdd_stock_id] = $bdd_value;
                }
            }
            $bdd->prepare(
                'UPDATE paniers SET panier = ? WHERE id = ?'
            )->execute(array(serialize($_SESSION['panier']), $_SESSION['utilisateur']['ID']));
        } else {
            $_SESSION['panier'] = unserialize($panier['panier']);
        }
    } elseif ($_SESSION['panier']) {
        $bdd->prepare(
            'INSERT INTO paniers (panier, id) VALUES (?, ?)'
        )->execute(array(serialize($_SESSION['panier']), $_SESSION['utilisateur']['ID']));
    }
    header('Location: ../' . $_POST['redirection']);
} else {
    header('Location: ../connexion.php?erreur=' . $erreur . '&redirection=' . $_POST['redirection']);
}
