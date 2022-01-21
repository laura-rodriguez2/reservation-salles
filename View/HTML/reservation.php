<?php
session_start();
require '../../Model/bdd.php';
require '../../Model/Month.php';
require '../../Model/events.php';
$pdo = get_pdo();
$events = new Events($pdo);

if(!isset($_GET['id'])) {
    header ('location: /index.php');
}
try {
    $event = $events->find($_GET['id']);
} catch (\Exception $e) {
    echo "Page 404";
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
        <h1><?= $even->getName(); ?></h1>

        <ul>
            <li>Date: <?= $even->getStart()->format('d/m/Y'); ?></li>
            <li>Heure de démarrage: <?= $even->getStart()->format('H:i'); ?></li>
            <li>Heure de fin: <?= $even->getEnd()->format('H:i'); ?></li>
            <li>
                Description: <br>
                <?= $even->getDescription(); ?>
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