<?php
require('../../Model/bdd.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/header.css' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <header class=al_header>
        <?php 
        if(($_SESSION == true)){
        ?>
        <nav>  
            <div class="lr_nav_header">
                <img src="../MEDIAS/vr_universe.png" width="15%">
            </div>
            <ul class="lr_li_header">
                <li><a class="al_header_color" href="index.php"> Accueil</a></li>
                <li><a class="al_header_color" href="planning.php"> Planning</a></li>
                <li><a class="al_header_color" href="reservation-form.php"> Réservation</a></li>
                <li><a class="al_header_color" href="profil.php"> Profil </a></li>
                <li><a class="al_header_color" href="deconnexion.php"> Déconnexion</a></li> 
            </ul>
        </nav>
        <?php 
            } else{ 
        ?>
        <nav>
            <div class="lr_nav_header">
                <img src="../MEDIAS/vr_universe.png" width="15%">
            <ul class="lr_li_header">
                <li><a class="al_header_color" href="index.php"> Accueil</a></li>
                <li><a class="al_header_color" href="planning.php"> Planning</a></li>
                <li><a class="al_header_color" href="inscription.php"> Inscription</a></li>
                <li><a class="al_header_color" href="connexion.php"> Connexion</a></li> 
            </ul>
        
        </nav>
        <?php 
            }
        ?>
    </header>

</html>
</body>