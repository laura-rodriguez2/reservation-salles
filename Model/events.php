<?php 
class Events{

    // private $pdo;

    // public function __construct(\PDO $pdo) {
    //     $this->pdo = $pdo;
    // }
    
    /**
     * Récupère les évènements commencant entre 2 dates
     * @param \DateTime $debut
     * @param \DateTime $end
     * @return array
     */
    public function getEventsBetween(\DateTime $debut, \DateTime $end): array{
        $pdo = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
        $sql = "SELECT * FROM reservations /*INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.login */ WHERE debut BETWEEN '{$debut->format(format: 'Y-m-d 00:00:00')}' AND '{$end->format(format: 'Y-m-d 23:59:59')}'";
        $statement = $pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }

    /**
     * Récupère les évènements commencant entre 2 dates indexé par jours
     * @param \DateTime $debut
     * @param \DateTime $end
     * @return array
     */
    public function getEventsBetweenByDay (\DateTime $debut, \DateTime $end): array{
        $events = $this->getEventsBetween($debut, $end);
        $days = [];
        foreach($events as $event) {
            $date = explode(" ", $event['debut'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }

}
?>