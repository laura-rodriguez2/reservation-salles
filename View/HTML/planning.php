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
            require '../../Model/month.php';
            try{
                $month = new Month(month:$_GET['month'] ?? null, year:$_GET['year'] ?? null);
            } catch(\Exception $e) {
                $month = new Month();
            }
        ?>
        <h1><?= $month->toString(); ?></h1>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>