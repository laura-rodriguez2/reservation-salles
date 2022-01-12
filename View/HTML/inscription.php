<?php
require('../../Model/bdd.php');
if (isset($_POST['submit'])){
    $erreur = "";  
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

if (!empty($_POST['login']) AND !empty($_POST['email']) AND !empty($_POST['password'])){
    $loginlenght = strlen($login);  //Permet de calculer la longueur du login
    $requete=$bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? "); 
    $requete->execute(array($login));
    $loginexist= $requete->rowCount();
    ($requete);
    $id_droits= 1;

    if ($loginlenght > 255)
    $erreur= "Votre pseudo ne doit pas depasser 255 caractères !";        
    if($loginexist !== 0)
            $erreur = "Login déjà pris !";
    if($erreur == ""){
        $hashage = password_hash($password, PASSWORD_BCRYPT);
        $insertmbr=$bdd->prepare(register($login));
        $insertmbr->execute(
        $erreur = "Votre compte à bien été créer !";
    }
}
    else{
        $erreur="Tout les champs doivent être remplis !";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/inscription.css' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Inscription</title>
</head>

<body>
    <header>
        <?php
        require_once('header_footer/header.php');
        ?>
    </header>
    <main>
    <div id="pasdenom">
                <form id="form_inscription" action="" method="POST">
                    <h1 class="lr_h2">S'inscrire</h1>
                        <input type="text" class="box-input" name="login" placeholder="Login" required />
                        <input type="email" class="box-input" name="email" placeholder="email" required />
                        <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
                        <input type="password" class="box-input" name="password2" placeholder="Confirmez votre mot de passe" required />
                        <input type="submit" name="submit" value="S'inscrire" class="btn btn-secondary btn-lg" /> 
                        <p class="lr_h2">Déjà inscrit? <a id="color_link" href="connexion.php">Connectez-vous ici</a></p> 
                </form>
            </div>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>