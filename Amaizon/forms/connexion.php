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
    header('Location: ../' . $_POST['redirection']);
} else {
    header('Location: ../connexion.php?erreur=' . $erreur . '&redirection=' . $_POST['redirection']);
}
