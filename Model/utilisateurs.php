<?php 
require('../../Model/bdd.php');

class User {
private $id;
public $login;
public $password;

    public function __construct($login, $password) {
        $this->login = $login;
        $this->password = $password;
        $this->password2 = $password2;
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
    if (strlen($this->login) > 60) {
        echo "L'identifiant doit faire moins de 60 caractères";
    }

    elseif ($this->password !== $this->password2) {
        echo "Le mot de passe et la confirmation sont différents";
    }
    elseif ($this->password == $this->password2) {
$hash = password_hash($this->password, PASSWORD_DEFAULT);
$bdd = $this->getBdd();
$requete_register = $bdd->prepare("INSERT INTO  utilisateurs (login, password) VALUES(?, ?)");
$requete_register->execute([
    'login' => $this->login,
    'password' => $hash]);
return [$this->login, $hash]; 
}

public function connect($login, $password){
    
}

public function disconnect(){
    session_unset();
    session_destroy();
    $this->id = null;
    $this->login= null;
    $this->password= null;
}
public function update($login, $password){
    
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