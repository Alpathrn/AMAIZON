<?php
session_start();
$_SESSION['utilisateur'] = false;
header('Location: ../' . $_GET['redirection']);
