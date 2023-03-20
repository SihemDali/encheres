<?php
require_once __DIR__ . "/pdo.php";
require_once __DIR__ . "/menu.php";
include __DIR__ . "/session.php";
//demarrer une session en haut de page, pour avoir accès au tableau $_SESSION dans les pages sur lesquelles on a besoin d'être connecté
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>
</head>

<body>
    <div>
        <img src="/images/Mini.jpg" alt="" class="image_fond">
    </div>

    <header>
        <h1>AFFAIRE . CONCLUE . AUTO</h1>

        <?php
        afficher_menu("Menu principal", $menuPrincipal, false);
        ?>
    </header>



    <section class="form_style">
        <h1>Connexion: </h1>
        <form method="post">
            <p>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email">
            </p>
            <p>
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password">
            </p>

            <p class="input">
                <input type="submit" value="Se connecter" name="submit_connexion">
            </p>
        </form>
        <?php


        if (isset($_POST["submit_connexion"])) {
            $query = $pdo->prepare('SELECT * FROM utilisateur WHERE email = :email');
            $query->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch();

            //var_dump($user);
            if ($user) {

                if (password_verify($_POST["password"], $user["mot_de_passe"])) {

                    $_SESSION["user"] = $user;
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["nom"] = $user["nom"];
                    $_SESSION["prenom"] = $user["prenom"];
                    $_SESSION["id"] = $user["id"];

                    $_SESSION["user"] = $user;
                    //un tableau de session, est juste un tableau dans lequel on sauvegarde ce dont on a besoin: email, id...
                    header("Location: index.php");
                    //echo "Bonjour" ." ". $_SESSION["nom"]." ! ";              

                } else {  ?>

                    <p> Email ou mot de passe incorrect! </p>
                <?php

                }
            } else { ?>
                <p> Email ou mot de passe incorrect! </p>
        <?php }
        }

        ?>
    </section>


    <?php require_once __DIR__ . "/footer.php"; ?>
</body>

</html>