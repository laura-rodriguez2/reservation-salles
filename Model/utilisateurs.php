<?php 
require('../../Model/bdd.php');

class Utilisateurs{
private $id;
public $login;
private $password;

public function __construct()
{
    
}

public function register($login){
    $requete = $bdd->query("INSERT INTO utilisateurs (login, password) VALUES ('$login', '$password')");

    $requete1 = $bdd->query("SELECT * FROM utilisateurs WHERE login = '$login'");
    $resultat = $requete1 ->fetch();

    return $resultat;  
}

public function connect($login, $password){
    $requete3 = $connexion->query("SELECT * FROM utilisateurs WHERE login = '$login'");
    $resultat2 = $requete3 ->fetch();
}

public function disconnect(){
    session_unset();
    session_destroy();
    $this->id = null;
    $this->login= null;
    $this->password= null;
}
public function update($login, $password){
    $requete = $connexion->query("UPDATE utilisateurs SET login = '$login', password='$password', WHERE login = '$this->login'"); 
}

// C'est une fonction qui permet de verif si l'user est co **
public function isConnected(){
    if (isset($this->login)) {
      return true;
    }
    else
    {
      return false;
    }
}
public function getAllInfos(){
    $info = array($this->id , $this->login);
    return $info;
}
}
?>