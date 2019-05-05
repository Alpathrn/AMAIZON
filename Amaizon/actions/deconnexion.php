<?php
session_start();
unset($_SESSION['utilisateur']);
unset($_SESSION['panier']);
header('Location: ../index.php');
