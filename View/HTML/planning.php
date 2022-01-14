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
        <div class="planning_container_table">
            <table>
                <thead>
                    <tr>
                        <th class="vide"></th>
                        <th class="jour">Lun.<br> <?php echo $jour_semaine = date('d/m', strtotime('monday this week'));?></th>
                        <th class="jour">Mar.<br> <?php echo $jour_semaine = date('d/m', strtotime('tuesday this week'));?></th>
                        <th class="jour">Mer.<br> <?php echo $jour_semaine = date('d/m', strtotime('wednesday this week'));?></th>
                        <th class="jour">Jeu.<br> <?php echo $jour_semaine = date('d/m', strtotime('thursday this week'));?></th>
                        <th class="jour">Ven.<br> <?php echo $jour_semaine = date('d/m', strtotime('friday this week'));?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include('../../Model/bdd.php');
                    // require_once('../../Model/reservations');

                    // $dbco = connectPdo();
                    $requete_resa = $bdd->prepare("SELECT * FROM utilisateurs INNER JOIN reservations ON utilisateurs.id = reservations.id_utilisateur WHERE week(debut) = week(curdate())");
                    $requete_resa->execute();
                    $info_reservation = $requete_resa->fetchAll();

                    /*var_dump($info_reservation);*/
                            //On créer les heures
                    for($heure = 8; $heure <= 19; $heure++)
                    {
                        ?>
                        <tr>
                            <td class="heure"><p><?php echo $heure . "h";?></p></td>
                            <?php
                            //génération des cellules
                            for($jour = 1; $jour<=5; $jour++) {
                                //si on à des réservations,
                                if(!empty($info_reservation))
                                {
                                    foreach($info_reservation as $resa => $Hresa) { //sépare les réservations
                                        $JH = explode(" ", $Hresa["debut"]);//sélection la ligne correspondant à l'heure de début

                                        $H = explode(":", $JH[1]);//explose l'heure
                                        $heure_resa = date("G", mktime($H[0], $H[1], $H[2], 0, 0, 0));//récupère uniquement l'heure sans le 0

                                        $J = explode("-", $JH[0]);//explose la date
                                        $jour_resa = date("N", mktime(0, 0, 0, $J[1], $J[2], $J[0]));//récupère le numéro du jour

                                        $case_resa = $heure_resa . $jour_resa;//crée un numéro de réservation

                                        $titre = $Hresa["titre"];
                                        $login = $Hresa["login"];
                                        $id = $Hresa["id"];

                                        /* var_dump($titre);
                                        var_dump($id);*/

                                        //Crée un numéro pour chaque cellules
                                        $case = $heure . $jour;

                                        if($case == $case_resa) {
                                            ?>
                                            <td class="resa"><a href="reservation.php?evenement=<?php echo $id;?>"><p><?php echo $titre;?></p><p><?php echo $login;?></p></a></td>
                                            <?php
                                            break;
                                        }
                                        else
                                        {
                                            $case = null;
                                        }
                                    }
                                    if ($case == null)
                                    {
                                        ?>
                                        <td class="case"><a href="reservation-form.php?heure_debut=<?php echo $heure;?>&amp;date_debut=<?php echo $jour;?>">Réserver un créneau</a></td>
                                        <?php
                                    }
                                }
                                else //si la case n'est pas réservé
                                    {
                                        ?>
                                        <td class="case"><a href="reservation-form.php?heure_debut=<?php echo $heure;?>&amp;date_debut=<?php echo $jour;?>">Réserver un créneau</a></td>
                                        <?php
                                    }
                            }
                            ?>
                        </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>