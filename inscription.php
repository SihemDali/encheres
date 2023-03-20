<?php

require_once __DIR__ . "/pdo.php";
require_once __DIR__ . "/menu.php";

function verification()
{

    if (!isset($_POST["nom"]) || $_POST["nom"] === "") {
        return false;
    }
    if (!isset($_POST["prenom"]) || $_POST["prenom"] === "") {
        return false;
    }
    if (!isset($_POST["email"]) || $_POST["email"] === "") {
        return false;
    }
    if (!isset($_POST["password"]) || $_POST["password"] === "") {
        return false;
    }
    if (!isset($_POST["password_confirm"]) || $_POST["password_confirm"] === "") {
        return false;
    }

    return true;
}

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

        <h1>Inscription: </h1>
        <form action="" method="post">
            <p>
                <label for="nom">Nom: </label>
                <input type="text" name="nom" id="nom">
            </p>
            <p>
                <label for="prenom">Prénom: </label>
                <input type="text" name="prenom" id="prenom">
            </p>
            <p>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email">
            </p>
            <p>
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password">
            </p>
            <p>
                <label for="password_confirm">Confirmation mot de passe:</label>
                <input type="password" name="password_confirm" id="password_confirm">
            </p>
            <p class="input">
                <input type="submit" value="S'inscrire" name="submit_inscription">
            </p>
        </form>
    </section>
    <?php
    if (isset($_POST["submit_inscription"])) {
        $resultat2 = verification();
        if ($resultat2 === true) {
            $query = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, email, mot_de_passe) VALUES (:nom,:prenom,:email,:password)");

            $query->bindValue(':nom', $_POST["nom"], PDO::PARAM_STR);
            $query->bindValue(':prenom', $_POST["prenom"], PDO::PARAM_STR);
            $query->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
            //Pour chiffrer le password: utiliser fonction password_hash
            $password = $_POST["password"];
            $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            //Cette fonction a besoin de 2 paramètres: le mdp normal et l'algorithme: password_default

            $resultat2 = $query->execute();

            echo "Votre compte a bien été créé!";
            //redirection vers connexion
            header("Location: connexion.php");
        } else { ?>
            <p> Tous les champs sont nécessaires! </p>
    <?php }
    }




    ?>

    <?php require_once __DIR__ . "/footer.php"; ?>
</body>

</html>