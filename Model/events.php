<?php 
class Events{

    /**
     * Récupère les évènements commencant entre 2 dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getEventsBetween(\DateTime $start, \DateTime $end): array{
        $pdo = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '');
        $sql = "SELECT * FROM reservations WHERE debut BETWEEN '{$start->format(format: 'Y-m-d 00:00:00')}' AND '{$end->format(format: 'Y-m-d 23:59:59')}'";
        $statement = $pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }

    /**
     * Récupère les évènements commencant entre 2 dates indexé par jours
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getEventsBetweenByDay(\DateTime $start, \DateTime $end): array{
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach($events as $event) {
            $date = explode('', $event['start'])[0];
            if (!isset($days[$date])){
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;

    }

}
?>