<?php
session_start();
require '../../Model/bdd.php';
require '../../Model/reservations.php';
$pdo = get_pdo();
if (isset($_POST['reserver'])) {
    if (strlen(htmlspecialchars($_POST['titre'])) >= 2) {
        if (strlen(htmlspecialchars($_POST['desc'])) >= 4) {
            if (isset($_POST['date-debut']) && isset($_POST['date-debut-heure']) && isset($_POST['date-fin']) && isset($_POST['date-debut-heure'])) {

                $userid = $_SESSION['id'];
                $titre = htmlspecialchars($_POST['titre']);
                $desc = htmlspecialchars($_POST['desc']);
                
                $array = array($_POST['date-debut'], $_POST['date-debut-heure']);
                $datedebut = implode(" ", $array);

                // $heurefin = ($_POST['date-debut-heure']);
                // date('H:i:s',(strtotime ( '+1 H' , strtotime ( $heurefin) ) ));

                // $heurefin = new DateTime($_POST['date-debut-heure']); // For today/now, don't pass an arg.
                // $heurefin->modify("+1 day");
                
                $timestamp = strtotime($_POST['date-debut-heure']) + 60*60;
                $heurefin = date('H:i', $timestamp);

                $timestamp1 = strtotime($_POST['date-debut']);
                $heurefin1 = date('H:i', $timestamp1);

                // echo $heurefin;//11:09


                $array = array($heurefin1, $heurefin);
                $datefin = implode(" ", $array);
                var_dump($datefin);

                $stmt = $pdo->prepare("INSERT INTO reservations (titre,description,debut,fin,id_utilisateur) VALUES ('$titre','$desc','$datedebut','$datefin','$userid')");
                $stmt->execute();
                header("location: planning.php");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/reservation-form.css' />
    <link rel="icon" href="../MEDIAS/vr_universe_icon.png">
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
        <?php
        if ($_SESSION == true) { 
            echo $timestamp;
            echo ($_POST['date-debut-heure']);
            ?>

            <form action="reservation-form.php" method="POST">
                <h1>Réserver une salle</h1>
                <label for="titre">Titre:</label><br />
                <input type="text" name="titre"><br />
                <label for="desc">Description:</label><br />
                <textarea name="desc" rows="4" cols="40" minlenght="10"></textarea><br />
                <p>Veuillez réserver de 1 heure en 1 heure</p>
                <label for="date-debut">Date de début:</label><br />
                <input class="date" type="date" name="date-debut">
                <input class="date" type="time" name="date-debut-heure" min="08:00" max="19:00" required><br />
                <!-- <label for="date-fin">Date de fin:</label><br />
                <input class="date" type="date" name="date-fin">
                <input class="date" type="time" name="date-fin-heure" min="08:00" max="19:00" required><br /> -->
                <!-- <p>Votre réservation vous donne accès à une salle privé, veuillez arriver  5minutes avant l'heure de début ! </p> -->
                <input class="btn btn-info" type="submit" name="reserver" value="Réserver">
            </form>

    </main>
<?php
        } else {
            echo "Vous devez être connecté pour reserver !";
            echo "<a href='connexion.php'>Connexion</a>";
        }
?>
<footer>
    <?php
    require_once('header_footer/footer.php');
    ?>
</footer>

</html>
</body>