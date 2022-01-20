<?php
require '../../Model/bdd.php';
require '../../Model/Month.php';
require '../../Model/events.php';
$pdo = get_pdo();
$events = new Events($pdo);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/reservation-form.css' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Formulaire</title>
</head>

<body>
    <header>
        <?php
        require_once('header_footer/header.php');
        ?>
    </header>
    <main>
        <?php
        try {
            $event = $events->find($_GET['id']); 
        } catch (\Exception $e) {
            echo "Error 404";
        }
        ?>
        <h1><?= $event['titre']; ?></h1>

        <ul>
            <li>Date: <?= $event->getStart()->format('d/m/Y'); ?></li>
            <li>Heure de démarrage: <?= (new DateTime($event['debut']))->format('H:i'); ?></li>
            <li>Description: <?= (new DateTime($event['description'])) ?></li>
        </ul>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>