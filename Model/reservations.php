<?php 
class Reservations{
private $id;
public $titre;
public $description;
public $debut;
public $fin;
private $id_utilisateur;

public function __construct(){
    $this->bdd = $this->Getbdd();
}
public function Getbdd(){
    $bdd = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '');
    return $bdd;
}

// public function Getreservation(\DateTime $debut, \DateTime $fin) : array{
// $requete_sql = $this->bdd->prepare("SELECT * FROM reservations WHERE debut BETWEEN '(start->format(format 'Y-m-d 00:00:00'  ")
// }
}
?>