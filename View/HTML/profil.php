<?php
session_start();
require('../../Model/bdd.php');
$pdo = get_pdo();

if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
    $requtilisateur = $pdo->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $requtilisateur->execute(array($_SESSION['id']));
    $infoutilisateur = $requtilisateur->fetch();

    if (isset($_POST['newlogin']) && !empty($_POST['newlogin']) && $_POST['newlogin'] != $infoutilisateur['login']) {
        $login = $_POST['newlogin'];
        $requetelogin = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $requetelogin->execute(array($login));
        $loginexist = $requetelogin->rowCount();

        if ($loginexist !== 0) {
            $msg = "Le login existe déjà !";
        } else {
            $newlogin = htmlspecialchars($_POST['newlogin']);
            $insertlogin = $pdo->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
            $insertlogin->execute(array($newlogin, $_SESSION['id']));
            $_SESSION['login'] = $newlogin;
            header('Location: profil.php');
        }
    }
}
if (isset($_POST['newmdp']) && !empty($_POST['newmdp']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2'])) {
    $mdp1 = $_POST['newmdp'];
    $mdp2 = $_POST['newmdp2'];

    if ($mdp1 == $mdp2) {
        $hachage = password_hash($mdp1, PASSWORD_BCRYPT);
        $insertmdp = $pdo->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
        $insertmdp->execute(array($hachage, $_SESSION['id']));
        header('Location: profil.php');
    } else {
        $msg = "Vos mots de passes ne correspondent pas !";
    }
}
if (isset($_POST['newlogin']) && $_POST['newlogin'] == $infoutilisateur['login']) {
    header('Location: profil.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href='../CSS/profil.css' />
    <link rel="icon" href="../MEDIAS/vr_universe_icon.png">
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
            <h1>Modifier mes informations :</h1><br>
                <input type="text" class="box-input" name="newlogin" value="<?php echo $_SESSION['login']; ?>" />
                <input type="password" class="box-input" name="newmdp" placeholder="Mot de passe" required />
                <input type="password" class="text" name="newmdp2" placeholder="Confirmez votre mot de passe" required />
                <input type="submit" name="submit" value="Enregistrer mes informations" class="btn btn-info btn-lg" /><br>
                <a href="deconnexion.php"><input class="btn btn-danger btn-lg" type="button" value="Déconnexion"></a>
        </form>
    </main>
    <footer>
        <?php
        require_once('header_footer/footer.php');
        ?>
    </footer>

</html>
</body>