<?php
session_start();
require '../../Model/bdd.php';
require '../../Model/Month.php'; //Contient les fonctions pour faire le calendrier
require '../../Model/events.php'; //Contient les fonctions permettant d'afficher les réservations

$pdo = get_pdo();
$sql = "SELECT reservations.id, titre, description, debut, fin, reservations.id_utilisateur, utilisateurs.id, utilisateurs.login FROM `reservations` INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id  ";
$prepare = $pdo->prepare($sql);
$prepare->execute();
$reservations = $prepare->fetchAll(PDO::FETCH_ASSOC);

$year = (isset($_GET['year'])) ? $_GET['year'] : date("Y");
$week = (isset($_GET['week'])) ? $_GET['week'] : date('W');




if ($week > 52) {   //52 semaines dans l'année donc après 52 passer à l'année suivante
    $year++;
    $week = 1;
} elseif ($week < 1) {  //là pour passer à l'année précédente
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
        <a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week == 1 ? 52 : $week - 1) . '&year=' . ($week == 1 ? $year - 1 : $year); ?>" class="btn btn-info">&lt;</a>
        <a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week == 52 ? 1 : 1 + $week) . '&year=' . ($week == 52 ? 1 + $year : $year); ?>" class="btn btn-info">&gt;</a>
        <a href="reservation-form.php" class="btn btn-info add_reserv">Réserver</a>

        <table border="1px">
            <?php

$monday = date('d', strtotime('monday this week'));
$tuesday = date('d', strtotime('tuesday this week'));
$wednesday = date('d', strtotime('wednesday this week'));
$thursday = date('d', strtotime('thursday this week'));
$friday = date('d', strtotime('friday this week'));
$saturday = date('d', strtotime('saturday this week'));
$sunday = date('d', strtotime('sunday this week'));

// echo "$tuesday";

$NbrCol = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi','Vendredi', 'Samedi','Dimanche');
$array = array($monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);



            // $NbrCol = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
            // $array = count($NbrCol);

            $NbrLigne = 19; //a droite les heures
            echo '<tr>';
            echo '<td>Heures/Jours</td>';
            foreach ($NbrCol as $k) {
                echo '<td>' . $k . '</td>';
            }
            echo '</tr>';
            // -------------------------------------------------------
            // lignes suivantes
            for ($i = 8; $i <= $NbrLigne; $i++) {

                // echo '<tr>';
            
                for ($j = 0; $j <= isset($array[$j]); $j++) {
    // echo $array[$j];
                    // $weekdate = date("d", mktime(0,0,0,date("n"),date("d")-$NbrCol+$i+1,date("y")));
                    // echo '<th id="t_head">'.$weekdate.'</th>';
                    // 1ere colonne (colonne 0)
                    if ($j == 0 ) {

                        echo '<td>' . $i . 'H00</td>'; //HEURES
                    }
                    // colonnes suivantes
                    // if ($i == $j) {
                    //     echo '<td bgcolor="#FFCC66"></td>';
                    // } else {
                    //     echo '<td></td>';
                    // }
                    // echo $i;

                    $resa = false;

                    foreach ($reservations as $reservation) {
                        $HeureJour = $i . $j; //LIER HEURE ET JOUR DU PLANNING

                        list($date, $heure) = explode(' ', $reservation['debut']);  //separation de la date et de l'heure
                        // echo "$date,$heure";

                        list($heure_h, $heure_min, $heure_sec) = explode(':', $heure);  //on explode la variable heure pour separer l'heure, les minutes et les secondes
                    
                        // $heure_h = date("H", mktime($heure_h));
                        // echo "$heure_h"; //afficher heure

                        list($date_annee, $date_mois, $date_jour) = explode('-', $date);  //on explode la variable date pour separer l'année, le mois et le jour
                        // echo "$date_jour";  //afficher Jour

                        $heureJourReserv = $heure_h . $date_jour; //LIER HEURE ET JOUR DE RESERVATION
                        // echo "$HeureJour";

                        // if ($date_jour == $array && $heure_h == $i) {
                        //     echo "<td>test</td>"; //PB LE ARRAY RENVOIE UN SEUL CHIFFE EX : 7 ET DAS LA BDD LE JOUR C'est 07 PEUT ETRE FAIRE UN DATETIME 
                        // }

                        // echo $HeureJour;
                        // echo '&'.$heureJourReserv;

                        $titreResa = $reservation["titre"]; // titre de la réservation
                        $idResa = $reservation["id"]; //id de la réservation
                        $loginResa = $reservation['login']; // login de la reservation

// echo "$HeureJour &";
// echo "$heureJourReserv";  
                    }
                    // echo '&'.$HeureJour;
                    // echo '&'.$heureJourReserv;

                    if ($HeureJour == $heureJourReserv) {
                            echo "<td>$idResa";
                            echo "$titreResa" ;
                            echo "$loginResa" ;
                            echo 'uuu</td>';
                        }
                        else {
                            echo '<td>dispo</td>';
                        }
                }
                
                echo '</tr>';
                // echo "$array";
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