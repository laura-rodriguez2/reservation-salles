<?php
session_start();
require '../../Model/bdd.php';
require '../../Model/Month.php'; //Contient les fonctions pour faire le calendrier
require '../../Model/events.php'; //Contient les fonctions permettant d'afficher les réservations
$pdo = get_pdo();
$events = new \Model\Events($pdo);
$month = new Month(month: $_GET['month'] ?? null, year: $_GET['year'] ?? null);
$start = $month->getFirstDay();
$start = $start->format(format: 'N') === '1' ? $start : $month->getFirstDay()->modify(modifier:'last monday'); 
$weeks = $month->getWeeks();
$end = (clone $start)->modify(modifier: '+' . (6 + 7 * ($weeks - 1)) . 'days');
$events = $events->getEventsBetweenByDay($start, $end);


$year = (isset($_GET['year'])) ? $_GET['year'] : date("Y");
$week = (isset($_GET['week'])) ? $_GET['week'] : date('W');
if ($week > 52) {   //pour passer à l'année suivante
    $year++;
    $week = 1;
} elseif ($week < 1) {  //pour passer à l'année précédente
    $year--;
    $week = 52;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/planning.css' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Planning</title>
</head>

<body>
    <header>
        <?php
        require_once('header_footer/header.php');
        ?>
    </header>

    <main>
        <!--Passer à la semaine précédente ou à la suivante -->
        <a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week == 1 ? 52 : $week - 1) . '&year=' . ($week == 1 ? $year - 1 : $year); ?>"class="btn btn-info">&lt;</a>
        <a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week == 52 ? 1 : 1 + $week) . '&year=' . ($week == 52 ? 1 + $year : $year); ?>"class="btn btn-info">&gt;</a>
        <a href="reservation-form.php" class="btn btn-info add_reserv">Réserver</a> 

        <table border="1px">
            <tr>
                <td>Employee</td>
                <?php
                if ($week < 10) {
                    $week = '0' . $week;
                }
                for ($day = 1; $day <= 7; $day++) {
                    $d = strtotime($year . "W" . $week . $day);

                    echo "<td>" . date('l', $d) . "<br>" . date('d M', $d) . "</td>";
                }
                
               foreach($eventsForDay as $event): ?> 
                    <div class="calendar__event">
                        <?= (new DateTime($event['debut']))->format(format:'H:i') ?> - <a href="./reservation.php?id=<?= $event['id'];
                        ?>"><?= h($event['titre']); ?></a>
                    </div>
                <?php endforeach; ?>
               
            </tr>
        </table>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>