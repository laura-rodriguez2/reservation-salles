<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href='../CSS/index.css' />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity=
        "sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"crossorigin="anonymous">
        <title>Index</title>
    </head>
    <body>
        <header id="al_header">
            <?php 
                require_once("header_footer/header.php")
            ?>
        </header>
        <main>
            <div class="al_scroll-snap">
                <div class="al_bloc">
                    <img class="image" src="../MEDIAS/fond1-2.0.png">
                </div>
                <div class="al_bloc">
                    <p>reserver ue salle pour nimporte quel evenements
                    particulier voici la liste des meilleurs jeux 
                    que nous pouvons vous proposer:</p> </br>
                    <ul>
                        <li>arizona sunshin</li>
                        <li>drive club vr</li>
                    </ul>
                </div>
        </main>
        <footer>
            <?php 
                require_once("header_footer/footer.php")
            ?>
        </footer>
    </body>

</html>
