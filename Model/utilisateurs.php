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
    $requete_co = $this->bdd->query("SELECT * FROM utilisateurs WHERE login = '$login'");
    $resultat2 = $requete_co ->fetch();

    if($password == $resultat2['password'])
    {
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        $this->id = $resultat2['id'];
        $this->login= $resultat2['login'];
    }

    $info = array($this->id , $this->login);
    return $info;
}

public function disconnect(){
    session_unset();
    session_destroy();
    $this->id = null;
    $this->login= null;
}

public function update($login, $password){
    $hash = password_hash($this->password, PASSWORD_DEFAULT);
    $requete_update = $this->bdd->query("UPDATE utilisateurs SET login = '$login', password='$password' WHERE login = '$this->login'");
    $requete_update->execute(array(
            'id' => $this->id,
            'login' => "Update",
            'password' => $hash,
        ));
}
public function delete() {
    $requete_supp = $this->bdd->query("DELETE FROM utilisateurs WHERE login = '$this->login'");
    $this->disconnect();
}
}
?>