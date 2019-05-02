<!DOCTYPE html>
<html>

<?php
include('fonctions.php');
$bdd = new PDO('mysql:host=localhost;dbname=amaizon;charset=utf8', 'root', 'root');

$page = (object)[
    'title' => 'Amaizon - Template',
    'page' => 'template'
];
include('head.php');
?>

<body scroll="no">
    <?php
    include('menu.php')
    ?>
    <div id="content" class="container">
        <!-- CONTENU ICI -->
        <h1>CONTENU IC</h1>
        <!-- CONTENU ICI -->
    </div>
</body>

</html>