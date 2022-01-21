<?php
session_start();
require('../../Model/bdd.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/profil.css' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Profil</title>
</head>

<body>
    <header>
        <?php
        require_once('header_footer/header.php');
        ?>
    </header>
    <main>
        <form id="form_inscription" action="" method="POST">
            <h2 class="lr_h2">Modifier mes informations</h1><br>
                    <input type="text" class="box-input" name="newlogin" value="<?php echo $_SESSION['login']; ?>"/><br>
                    <input type="password" class="box-input" name="newmdp" placeholder="Mot de passe" required /><br>
                    <input type="password" class="box-input" name="newmdp2" placeholder="Confirmez votre mot de passe" required /><br><br>
                    <input type="submit" name="submit" value="Enregistrer mes informations" class="btn btn-secondary btn-lg" /><br><br>
                    <a href="deconnexion.php"><input class="btn btn-secondary btn-lg" type="button" value="Déconnexion"></a>

<?php if(isset($_POST['button'])){
    $user->delete($_SESSION['user']['id']);
}
?>
            <input class="box-input" type="button" id="supprimer" name="supprimer" value="Supprimer mon compte"> <br><br>
        </form>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>