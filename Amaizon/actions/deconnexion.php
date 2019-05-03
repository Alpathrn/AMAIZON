<?php
session_start();
$_SESSION['utilisateur'] = false;
header('Location: ../index.php');
