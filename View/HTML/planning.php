<?php

// require('../../Model/bdd.php');
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
        <nav class="navbar navbar-dark bg-primary mb-3">
            <a href="" class="navbar-brand"> Planning </a>
        </nav>

        <?php 
            require '../../Model/Month.php';
            $month = new Month(month:$_GET['month'] ?? null, year: $_GET['year'] ?? null);
            $start = $month->getFirstDay();
            $start = $start->format(format: 'N') === '1' ? $start : $month->getFirstDay()->modify(modifier:'last monday'); 
        ?>

        <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <h1><?= $month->toString(); ?></h1>
        <div>
            <a href="planning.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year;?>" class="btn btn-primary">&lt;</a>
            <a href="planning.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year;?>" class="btn btn-primary">&gt;</a>
        </div>
        </div>

        <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?> weeks">
            <?php for ($i = 0; $i < $month->getWeeks(); $i++){ ?>
            <tr>
                <?php 
                foreach($month->days as $k => $day){ 
                    $date = (clone $start)->modify( modifier:"+" . ($k + $i * 7) . "days")
                ?>
                <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?>">
                    <?php if ($i === 0){ ?>
                        <div class="calendar__weekday"><?= $day; ?></div>
                    <?php }?>
                        <div class="calendar__day"><?= $date->format(format:'d'); ?></div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>