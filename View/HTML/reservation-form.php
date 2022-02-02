<?php
session_start();
require '../../Model/bdd.php';
require '../../Model/reservations.php';
if (isset($_POST['reserver'])) {
    if (strlen(htmlspecialchars($_POST['titre'])) >= 2) {
        if (strlen(htmlspecialchars($_POST['desc'])) >= 4) {
            if (isset($_POST['date-debut']) && isset($_POST['date-debut-heure']) && isset($_POST['date-fin']) && isset($_POST['date-debut-heure'])) {

                $userid = $_SESSION['id'];
                $titre = htmlspecialchars($_POST['titre']);
                $desc = htmlspecialchars($_POST['desc']);
                $array = array($_POST['date-debut'], $_POST['date-debut-heure']);
                $datedebut = implode(" ", $array);
                $array = array($_POST['date-fin'], $_POST['date-fin-heure']);
                $datefin = implode(" ", $array);
                $pdo = new PDO('mysql:host=localhost;dbname=reservationsalles', 'root', '');
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
    if ($_SESSION == true){ ?>
        <div>
            <section>
                <form action="reservation-form.php" method="POST">
                    <h1>Réserver une salle</h1>
                    <label for="titre">Titre:</label><br />
                    <input type="text" name="titre"><br />
                    <label for="desc">Description:</label><br />
                    <textarea name="desc" rows="4" cols="40" minlenght="10"></textarea><br />
                    <label for="date-debut">Date de début:</label><br />
                    <input class="date" type="date" name="date-debut">
                    <input class="date" type="time" name="date-debut-heure" min="08:00" max="19:00" required><br />
                    <label for="date-fin">Date de fin:</label><br />
                    <input class="date" type="date" name="date-fin">
                    <input class="date" type="time" name="date-fin-heure" min="08:00" max="19:00" required><br />
                    <input class="btn btn-info" type="submit" name="reserver" value="Réserver">
                </form>
        </div>
        </section>
    </main>
    <?php
    }
    else {
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