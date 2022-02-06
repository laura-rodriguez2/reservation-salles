<?php
session_start();
require '../../Model/bdd.php';

$pdo = get_pdo();
$sql = "SELECT reservations.id, titre, description, debut, fin, id_utilisateur , utilisateurs.login FROM `reservations` 
INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id";
$prepare = $pdo->prepare($sql);
$prepare->execute();
$reservations = $prepare->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/planning.css' />
    <link rel="icon" href="../MEDIAS/vr_universe_icon.png">
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

        <a href="reservation-form.php" class="btn btn-info add_reserv">Réserver</a>

        <table>
            <?php
            // CREATION DES VARIABLES DU TABLEAU
            $monday = date('d', strtotime('monday this week'));
            $tuesday = date('d', strtotime('tuesday this week'));
            $wednesday = date('d', strtotime('wednesday this week'));
            $thursday = date('d', strtotime('thursday this week'));
            $friday = date('d', strtotime('friday this week'));
            $saturday = date('d', strtotime('saturday this week'));
            $sunday = date('d', strtotime('sunday this week'));

            $NbrCol = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
            $array = array($monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);

            $NbrLigne = 19; //Heure max pour réserver


            //ON GENERE LE TABLEAU
            echo '<tr>';
            echo '<td>Heures/Jours</td>';
            foreach ($NbrCol as $k) {        //Affiche les jours en lettres en haut du planning
                echo '<td>' . $k . '</td>';
            }
            echo '</tr>';

            for ($i = 8; $i <= $NbrLigne; $i++) {       //Génère les heures (commence à 8h et fini à 19h)

                for ($j = 0; $j <= isset($array[$j]); $j++) {       //Génère les jours avec la bonne date de la semaine en cours

                    if ($j == 0) {
                        echo '<td>' . $i . 'H00</td>';
                    }

                    foreach ($reservations as $reservation) {   //AFFICHAGE DE CHAQUE RESERVATION

                        $HeureJour = $i . $array[$j]; //on lie l'heure et le jour du planning

                        list($date, $heure) = explode(' ', $reservation['debut']);  //separation de la date et de l'heure

                        list($heure_h, $heure_min, $heure_sec) = explode(':', $heure);  //on explode la variable heure pour separer l'heure, les minutes et les secondes

                        list($date_annee, $date_mois, $date_jour) = explode('-', $date);  //on explode la variable date pour separer l'année, le mois et le jour

                        $heureJourReserv = $heure_h . $date_jour; //on lie l'heure et le jour de la réservation cette fois

                        $titreReservation = $reservation["titre"]; // titre de la réservation
                        $idReservation = $reservation["id"]; //id de la réservation
                        $loginReservation = $reservation['login']; // login de la reservation

                        if ($HeureJour == $heureJourReserv) { //Affichage des réservations
                            echo "<td><a class='lien_reservation' href='reservation.php?id=$idReservation'>";
                            echo "$titreReservation </a><br>";
                            echo "De : $loginReservation <br>";
                            echo '</td>';
                        }
                    }
                    if ($j < 6) {
                        echo "<td class='dispo_reservation'>Disponible</td>";
                    }
                }
                echo '</tr>';
            }
            ?>
        </table>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>