<?php
session_start();
if ($_FILES['error'] == 0) {
    $infosfichier = pathinfo($_FILES['photo']['name']);
    $extension_upload = $infosfichier['extension'];
    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'tiff');
    if (in_array($extension_upload, $extensions_autorisees)) {
        $chemin = '../images/' . $_GET['type'] . 's/' . $_SESSION['utilisateur']['ID'];
        foreach ($extensions_autorisees as $value) {
            if (file_exists($chemin . '.' . $value)) unlink($chemin . '.' . $value);
        }
        move_uploaded_file($_FILES['photo']['tmp_name'], $chemin . '.' . $extension_upload);
    }
}
header('Location: ../espacevente.php');
