<?php 
class Month{
    public $days = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
    
    private $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'];
    
    private $month;
    private $year;
    /**
     * Month constructor
     * @param int $month Le mois compris entre 1 et 12
     * @param int $year L'année
     * @throws Exception
     */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if($month === null){
            $month = intval(date(format: 'N'));
        }
        if($year === null){
            $year = intval(date(format: 'Y'));
        }
        if($month < 1 || $month > 12 ){
            throw new \Exception(message: "Le mois $month n'est pas valide");
        }
        if($year < 1970) {
            throw new \Exception(message: "L'année est inférieur à 1970");
        }
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Renvoie 1er jour du mois
     * @return \DateTime
     */
    public function getFirstDay (): \DateTime {
        return new \DateTime(datetime:"{$this->year}-{$this->month}-01");
    }

    /**
     * Retourne le mois en toute lettre (ex: Janvier 2021)
     * @return string
     */
    public function toString(): string {
        return $this->months[$this->month - 1] .''. $this->year;
    }

    public function getWeeks (): int {
        $start = $this->getFirstDay();
        $end = (clone $start)->modify(modifier:'+1 month -1 day');
        $weeks = intval($end->format(format:'W')) - intval($start->format(format:'W')) + 1;
        if ($weeks < 0) {
            $weeks = intval($end->format(format:'W'));
        }
        return $weeks;
    }

    /**
     * Est-ce que le jour est dans le mois en cours
     * @param \DateTime $date
     * @return bool
     */
    public function withinMonth (\DateTime $date): bool {
        return $this->getFirstDay()->format( format: 'Y-m') === $date->format( format: 'Y-m');
    }
}
?>