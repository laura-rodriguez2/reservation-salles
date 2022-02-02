<?php
require('../../Model/bdd.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset ="utf-8">
        <link rel="stylesheet" href="../CSS/header.css"  />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <header>
        <?php
            if(($_SESSION ==true)){
        ?>
            <a href="index.php"><img src="../MEDIAS/vr_universe.png" href="./index.php"width="15%"></a>
            <a class="al_header_color" href="index.php">Accueil</a>
            <a class="al_header_color" href="planning.php">Planning</a>
            <a class="al_header_color" href="reservation-form.php">Réservation</a>
            <a class="al_header_color" href="profil.php">Profil</a>
            <a class="al_header_color" href="deconnexion.php">Déconnexion</a>
        <?php
            }else{
        ?>
            <a href="index.php"><img src="../MEDIAS/vr_universe.png" href="./index.php"width="15%"></a>
            <a class="al_header_color" href="index.php">Accueil</a>
            <a class="al_header_color" href="planning.php">Planning</a>
            <a class="al_header_color" href="inscription.php">Inscription</a>
            <a class="al_header_color" href="connexion.php">Connexion</a>
        <?php
            }
        ?>
        </header>
    </body>
</html>