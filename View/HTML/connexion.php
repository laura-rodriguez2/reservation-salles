<?php
session_start();
require('../../Model/bdd.php');

if (isset($_POST['formconnexion'])) {
    $loginconnect = htmlspecialchars($_POST['loginconnect']);
    $passwordconnect = $_POST['passwordconnect'];
    $bdd = new PDO('mysql:host=localhost;dbname=reservationsalles', 'root', '');

    if (!empty($loginconnect) and !empty($passwordconnect)) {
        $requeteutilisateur = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?"); // SAVOIR SI LE MEME LOGIN EST PRIS
        $requeteutilisateur->execute(array($loginconnect));   // Execute le prepare
        $result = $requeteutilisateur->fetchAll();   // Return TOUTE la requete ( tableau )
        if (count($result) > 0) { // S'il trouve pas de même login, il return mauvais login
            $sqlPassword = $result[0]['password'];  // Récupere le resultat du tableau (0)  /!\ SI PAS LE 0 ça marche pas /!\ et la colonne password
            if (password_verify($passwordconnect, $sqlPassword)) // Si passwordconnect est hashé et qu'il est pareil que sql password c'est bon 
            {
                $_SESSION['id'] = $result[0]['id'];
                $_SESSION['login'] = $result[0]['login'];
                header("Location: profil.php");
            } else {
                $erreur = "Mauvais mot de passe !";
            }
        } else {
            $erreur = "Mauvais login !";
        }
    } else {
        $erreur = "Tous les champs doivent être remplis !";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/connexion.css' />
    <link rel="icon" href="../MEDIAS/vr_universe_icon.png">
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
                <h1>Connexion :</h1><br>
                <input type="text" class="box-input" name="loginconnect" placeholder="Login">
                <input type="password" class="text" name="passwordconnect" placeholder="Password">
                <input type="submit" class="btn btn-info btn-lg" name="formconnexion" value="Se connecter !">
                <p class="lr_h2">Vous n'avez pas de compte ? <a class="lien_inscription" href="inscription.php">Inscrivez-vous ici</a></p>
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