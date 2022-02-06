<?php
session_start();
require '../../Model/bdd.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/planning.css' />
    <link rel="icon" href="../MEDIAS/vr_universe_icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>FAQ</title>
</head>

<body>
    <header>
        <?php require_once('header_footer/header.php');
        ?>
    </header>
    <main>
        <h1>Foire aux questions</h1><br>
        <h2>J’ai un problème médicale. Puis-je tout de même faire de la VR ?</h2>
        <p>
            Si vous êtes cardiaque ou épileptique la réponse est non. Dans les autres, il conviendra de choisir les expériences et la durée d’utilisation du casque qui vous correspondent le mieux. Notre centre de réalité virtuelle est accessible aux personnes en fauteuil.
        </p>
        <h2>A partir de quel age peut-on faire de la réalité virtuelle ?</h2>
        <p>
            Les enfants de moins de 8 ans pourront tester brièvement la réalité virtuelle avec Fruit Ninja ou Invasion. Pour profiter pleinement des autres jeux et expériences, il vaut mieux donc avoir plus de 8 ans.
        </p>
        <h2>Jouer en VR avec des lunettes ?</h2>
        <p>
            Il est recommandé de retirer vos lunettes ou de porter des lentilles de contact pour participer à une partie. En revanche, selon les tailles des lunettes, nous ferons ensemble un test afin de voir si vous pouvez les garder lors de vos expériences en réalité virtuelle.
        </p>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>
</body>

</html>