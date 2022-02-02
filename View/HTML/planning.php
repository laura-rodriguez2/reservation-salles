<?php
session_start();
require '../../Model/bdd.php';
require '../../Model/Month.php'; //Contient les fonctions pour faire le calendrier
require '../../Model/events.php'; //Contient les fonctions permettant d'afficher les réservations
$pdo = get_pdo();
$events = new \Model\Events($pdo);
$month = new Month(month: $_GET['week'] ?? null, year: $_GET['year'] ?? null);
$start = $month->getFirstDay();
$start = $start->format(format: 'W') === '1' ? $start : $month->getFirstDay()->modify(modifier: 'last monday');
$weeks = 1;
$end = (clone $start)->modify(modifier: '+' . (6 + 7 * ($weeks - 1)) . 'weeks');
$events = $events->getEventsBetweenByDay($start, $end);
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
        <nav class="calendar_nav">
            <h1><?= $month->toString(); ?></h1>
            <div>
                <a href="planning.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-info">&lt;</a>
                <a href="planning.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-info">&gt;</a>&emsp13;
                <a href="reservation-form.php" class="btn btn-info add_reserv">Réserver</a>
            </div>
        </nav>

        <table class="calendar__table--<?= $weeks; ?> weeks">
            <?php for ($i = 0; $i < $weeks; $i++) : ?>
                <tr>
                    <td>Heures/Jours</td>
                <!-- <td>AFFICHER HEURES ICI SVP FAITES QUE CA MARCHE</td>  -->

                    <?php
                    foreach ($month->days as $k => $day) :
                        $date = (clone $start)->modify(modifier: "+" . ($k + $i * 7) . "days");
                        $eventsForDay = $events[$date->format(format: 'Y-m-d')] ?? [];
                    ?>
                    
                        <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?>">
                            <?php if ($i === 0) : ?>
                                <div class="calendar__weekday"><?= $day ?></div>
                            <?php endif; ?>
                            
                            
                            <div class="calendar__day"><?= $date->format(format: 'd'); ?></div>
                            
                            <?php foreach ($eventsForDay as $event) : ?>
                                <div class="calendar__event">
                                    <?= (new DateTime($event['debut']))->format(format: 'H:i') ?> - <a href="./reservation.php?id=<?= $event['id'];
                                        ?>"><?= h($event['titre']); ?></a>
                                </div>
                            <?php endforeach; ?>
                        </td>
                    <?php endforeach; ?>
                    </td>
                <?php endfor; ?>
                </tr>
                <?php for ($hour = 8; $hour <= 19; $hour++) { ?>
                    <tr>
                        <td>
                            <?= $hour;
                            echo 'H00' ?>
                        </td>
                    </tr>
                <?php }
                ?>
                <?php  ?>
        </table>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>