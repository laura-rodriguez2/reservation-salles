<?php
session_start();
require '../../Model/bdd.php';
require '../../Model/Month.php';
require '../../Model/Events.php';
$pdo = get_pdo();
$events = new \Model\Events($pdo);


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/reservation.css' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Réservation</title>
</head>

<body>
    <header>
        <?php
        require_once('header_footer/header.php');
        ?>
    </header>
    <main>
        <?php if ($_SESSION == true) {
            if (isset($_GET['id']) and !empty($_GET['id'])) {
                $get_id = htmlspecialchars($_GET['id']);
                $events = $pdo->prepare('SELECT * FROM reservations WHERE id = ?');
                $events->execute(array($get_id));
                if ($events->rowCount() == 1) {
                    $events = $events->fetch();
                    $titre = $events['titre'];
                    $contenu = $events['description'];
                } else {
                    die('Cet events n\'existe pas !');
                }
            } else {
                die('Erreur');
            } ?>
            <ul>
                <h1>Détail de la réservation</h1>
                <h2><?= h($events['titre']); ?></h2>
                <li>Du <?= $events['debut']; ?></li>
                <li>à <?= $events['fin']; ?></li>
                <li> Description: <?= h($events['description']); ?></li>
            </ul>
                <?php } else { ?>
                                <div class="error">
<?php
                    echo 'Erreur : Vous devez être connecté pour voir les réservations';
                    ?>
                <a href="connexion.php" class="btn btn-info add_reserv">Se connecter</a>
                <a href="inscription.php" class="btn btn-info add_reserv">S'inscrire</a>
                <a href="planning.php" class="btn btn-primary add_reserv">Retourner au planning</a>
            </div>
        <?php } ?>
    </main>

    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>