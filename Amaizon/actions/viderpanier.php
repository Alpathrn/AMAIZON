<?php
session_start();
$_SESSION['panier'] = array();
header('Location: ../panier.php');
