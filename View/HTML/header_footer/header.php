<?php
session_start();
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
    <header>
        <?php 
        if($_SESSION == true){
        ?>
        <nav>   
            <ul class="lr_nav_header">
                <img src="../MEDIAS/vr_universe.png" width="20%">
                <li><a class="lr_li_header" href="index.php"> Accueil</a></li>
                <li><a class="lr_li_header" href="planning.php"> Planning</a></li>
                <li><a class="lr_li_header" href="inscription.php"> Réservation</a></li>
                <li><a class="lr_li_header" href="connexion.php"> Déconnexion</a></li> 
            </ul>
        </nav>
        <?php 
            } else{ 
        ?>
        <nav>   
            <div class="lr_nav_header">
                <img src="../MEDIAS/vr_universe.png" width="20%">
            </div> 
            <ul class="lr_nav_header">
                <li><a class="lr_li_header" href="index.php"> Accueil</a></li>
                <li><a class="lr_li_header" href="planning.php"> Planning</a></li>
                <li><a class="lr_li_header" href="inscription.php"> Inscription</a></li>
                <li><a class="lr_li_header" href="connexion.php"> Connexion</a></li> 
            </ul>
        </nav>
        <?php 
            }
        ?>
    </header>

</html>
</body>