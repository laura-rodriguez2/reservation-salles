<?php
require('../../Model/bdd.php');
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
                        <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
                        <input class="text" type="password" name="password2" placeholder="Confirmation du mot de passe" required="">
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
    </body>
</html>