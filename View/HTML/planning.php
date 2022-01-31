<?php
session_start();
require '../../Model/bdd.php';
require '../../Model/Month.php'; //Contient les fonctions pour faire le calendrier
require '../../Model/events.php'; //Contient les fonctions permettant d'afficher les réservations
$pdo = get_pdo();

// $sql = "SELECT reservations.id, titre, description, debut, fin, id_utilisateur , utilisateurs.login FROM `reservations` 
// INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id  "; // inner join de la table reservations et utilisateur via les id des 2 tables
// $prep = $pdo->prepare($sql);
// $prep->execute();
// $reservations = $prep->fetchAll(PDO::FETCH_ASSOC);

// $NbrCol = 19;
// $NbrLigne = 19;

// echo '<table border="1" width="400">';
// // 1ere ligne (ligne 0)
//    echo '<tr>';
//    echo '<td bgcolor="#CCCCCC">i X j</td>';
//    for ($j=1; $j<=$NbrCol; $j++) {
//       echo '<td bgcolor="#FFFF66">'.$j.'</td>';
//    }
//    echo '</tr>';


$year = (isset($_GET['year'])) ? $_GET['year'] : date("Y");
$week = (isset($_GET['week'])) ? $_GET['week'] : date('W');
// $hour = (isset($_GET['hour'])) ? $_GET['hour'] : date("h");

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


        <!-- <thead>
                    <tr>
                        <th>Heures/Jours</th>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                    </tr>
        </thead> -->
        <table border="1px">
            <?php
            // $NbrCol : le nombre de colonnes
            // $NbrLigne : le nombre de lignes
            // $NbrCol = 7; //en haut les jours
            $NbrCol = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
            $array = count($NbrCol);

            // $NbrLigne = 19;
            $NbrLigne = 19; //a droite les heures


            // --------------------------------------------------------
            // on affiche en plus sur les 1ere ligne et 1ere colonne 
            // les valeurs a multiplier (dans des cases en couleur)
            // le tableau fera donc 10 x 10
            // --------------------------------------------------------
            // echo '<table border="1" width="400">';
            // 1ere ligne (ligne 0)
            echo '<tr>';
            echo '<td>Heures/Jours</td>';
            // for () { 
            // $d = strtotime($year . "W" . $week . $j); //ICI
            //
            foreach ($NbrCol as $k) {
                echo '<td>' . $k . '</td>';
                //
                // echo '<td>Lundi</td>';
                // echo '<td>Mardi</td>';
                // echo '<td>Mercredi</td>';
                // echo '<td>Jeudi</td>';
                // echo '<td>Vendredi</td>';
                // echo '<td>Samedi</td>';
                // echo '<td>Dimanche</td>';
            }
            echo '</tr>';
            // -------------------------------------------------------
            // lignes suivantes
            for ($i = 8; $i <= $NbrLigne; $i++) {
                // echo '<tr>';
                for ($j = 1; $j <= $array; $j++) {

                    // 1ere colonne (colonne 0)
                    if ($j == 1) {

                        echo '<td>' . $i . 'H00</td>'; //HEURES
                    }
                    // colonnes suivantes
                    if ($i == $j) {
                        echo '<td bgcolor="#FFCC66">';
                    } else {
                        echo '<td>';
                    }
                    // ------------------------------------------
                    // AFFICHAGE ligne $i, colonne $j
                    echo "<a href='reservation-form.php'>Réserver</a>"; //CASES RESERVER
                    // ------------------------------------------
                    echo '</td>';
                }
                echo '</tr>';
                $j = 1;
            }
            // echo '</table>';
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