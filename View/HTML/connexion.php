<?php
require('../../Model/bdd.php');
require('../../Model/utilisateurs.php');
if(isset($_POST['formconnexion'])){
<<<<<<< HEAD
    if(isset($_POST['login']) AND isset($_POST['password']){
        $login = htmlspecialchars($_POST['login']);
        $password =htmlspecialchars($_POST['password']);
        $user = new User($login, $password);
        $_SESSION['utilisateurs'] = $user_co;
        $user_co = $user->connect();
        echo "Je suis connect";
    }
}
=======
    if(isset($_POST['loginconnect']) AND isset($_POST['passwordconnect'])){
        $login = htmlspecialchars($_POST['loginconnect']);
        $password = htmlspecialchars($_POST['passwordconnect']);
        $user = new User($login, $password);
        $user_co = $user->connect($login, $password);
        $_SESSION['user'] = $user_co;
    }
}

>>>>>>> master
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/connexion.css' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Connexion</title>
</head>

<body>
    <header>
        <?php
        require_once('header_footer/header.php');
        ?>
    </header>
    <main>
    <div id="deplacement_form"> 
            <form id="form_inscription" method="POST" action=""> 
                <h1 class="lr_h2">Connexion</h1><br>
                <input type="text" class="box-input" name="loginconnect" placeholder="Login"><br>
                <input type="password" class="box-input" name="passwordconnect" placeholder="Password"><br><br>
                <input type="submit" class="btn btn-secondary btn-lg" name="formconnexion" value="Se connecter !"><br><br>
                <p class="lr_h2">Vous n'avez pas de compte? <a id="color_link" href="inscription.php">Inscrivez-vous ici</a></p> 
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