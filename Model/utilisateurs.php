<?php 
require('../../Model/bdd.php');

class User {
private $id;
public $login;
public $password;

    public function __construct($login, $password, $password2 = NULL) {
        $this->login = $login;
        $this->password = $password;
        $this->password2 = $password2;
        $this->bdd = $this->getBdd();
    }
    
public function getBdd ()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '');
        return $bdd;
    }

public function getId(){
    return $this->id;
}

public function getLogin(){
    return $this->login;
}

public function checklogin() {

    $requete_same_login = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $requete_same_login->execute([$this->login]);
    $loginExist = $requete_same_login->fetch();
    return $loginExist;
}

public function register($login, $password){
    $checklogin = $this->checklogin();

    if ($checklogin == FALSE) {
    if (strlen($this->login) > 50) {
        echo "L'identifiant doit faire moins de 50 caractères";
    }

    elseif ($this->password !== $this->password2) {
        echo "Le mot de passe et la confirmation sont différents";
    }
    elseif ($this->password == $this->password2) {
$hash = password_hash($this->password, PASSWORD_DEFAULT);
$bdd = $this->getBdd();
$requete_register = $bdd->prepare("INSERT INTO  utilisateurs (login, password) VALUES(?, ?)");
$requete_register->execute(array($login,$password)); 
}
}
}
public function connect($login, $password){
session_start();
$requete_co = $connexion->query("SELECT * FROM utilisateurs WHERE login = '$login'");
$resultat = $requete_co ->fetch();
if($password == $resultat['password']){
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        $this->id = $resultat['id'];
        $this->login= $resultat['login'];
}

    $info = array($this->id , $this->login, $this->email, $this->firstname, $this->lastname);
    return $info;
}
}
