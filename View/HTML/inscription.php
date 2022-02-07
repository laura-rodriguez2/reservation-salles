<?php
session_start();
require('../../Model/bdd.php');
require('../../Model/utilisateurs.php');
if (isset($_POST['submit'])){
    if (isset($_POST['login']) AND isset($_POST['password']) AND isset($_POST['password2'])) {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        $user = new User ($login, $password, $password2);
        $user_register = $user->register($login, $password);
    } 
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/inscription.css'/>
    <link rel="icon" href="../MEDIAS/vr_universe_icon.png">
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
                    <h1>S'inscrire :</h1>
                        <input class="box-input" type="text" name="login" placeholder="Login" required />
                        <input class="box-input" type="password" name="password" placeholder="Mot de passe" required />
                        <input class="text" type="password" name="password2" placeholder="Confirmation du mot de passe" required="">
                        <input class="btn btn-info btn-lg" type="submit" name="submit" value="S'inscrire" /> 
                        <p class="lr_h2">Déjà inscrit ? <a class="lien_connexion" href="connexion.php">Connectez-vous ici</a></p> 
                </form>
            </div>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>
    </body>
</html>