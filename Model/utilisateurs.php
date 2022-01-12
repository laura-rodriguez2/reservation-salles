<?php 
require('../../Model/bdd.php');

class Utilisateurs{
private $id;
public $login;
private $password;

public function register($login){
    $requete = $bdd->query("INSERT INTO utilisateurs (login, password) VALUES ('$login', '$password')");

    $requete1 = $bdd->query("SELECT * FROM utilisateurs WHERE login = '$login'");
    $resultat = $requete1 ->fetch();

    return $resultat;  
}
}
?>