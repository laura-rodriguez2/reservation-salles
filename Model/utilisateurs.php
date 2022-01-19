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

public function checklogin($login) {
    $requete_same_login = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $requete_same_login->execute([$login]);
    $loginExist = $requete_same_login->fetch();
    return $loginExist;
}

public function register($login, $password){
    $checklogin = $this->checklogin($login);
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
            $requete_register->execute(array($login,$hash)); 
            header('location: connexion.php');
        }
    }
    else{
       echo "Login déjà pris.";
    }
}

public function connect($login, $password){
    $requete_co = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $requete_co->execute([$this->login]);
    $user = $requete_co->fetch(); 
    if ($user AND password_verify($this->password, $user['password'])) {
        $this->id           = $user['id'];
        $this->login        = $user['login'];
        $this->password     = $user['password'];
        $this->connect      = "1";      
        echo "connecté !";
        // return $tab = ['id' => $this->id, 'login' => $this->login, 'password' => $this->password, 'connect' => $this->connect];
    } 
    else {
     echo "Mot de passe ou identifiant incorrect"; 
    }
}
}
