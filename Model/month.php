<?php 
class Month{
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
     * Retourne le mois en toute lettre (ex: Janvier 2021)
     * @return string
     */
    public function toString(): string {
        return $this->months[$this->month - 1] .''. $this->year;
    }
}
?>