<?php
require '../../Model/bdd.php';
require '../../Model/Month.php';
require '../../Model/Events.php';
$pdo = get_pdo();
$events = new \Model\Events($pdo);

if(!isset($_GET['id'])) {
    header ('location: /index.php');
}
try {
    $event = $events->find($_GET['id']);
} catch (\Exception $e) {
    // e404();
}
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
        <h1><?= h($event->getName()); ?></h1>

        <ul>
            <li>Date: <?= $event->getStart()->format('d/m/Y'); ?></li>
            <li>Heure de démarrage: <?= $event->getStart()->format('H:i'); ?></li>
            <li>Heure de fin: <?= $event->getEnd()->format('H:i'); ?></li>
            <li>
                Description: <br>
                <?= h($event->getDescription()); ?>
            </li>
        </ul>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>