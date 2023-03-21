<?php

require_once __DIR__ . "/pdo.php";
require_once __DIR__ . "/menu.php";
require __DIR__ . "/session.php";

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

        <h1>Edition profil: </h1>
        <form action="" method="post">
            <p>
                <label for="nom">Nom: </label>
                <input type="text" name="nom" id="nom" value="<?php echo $_SESSION["nom"]?>">
            </p>
            <p>
                <label for="prenom">Prénom: </label>
                <input type="text" name="prenom" id="prenom" value="<?php echo $_SESSION["prenom"]?>">
            </p>
            <p>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" value="<?php echo $_SESSION["email"]?>">
            </p>
            <p>
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password" value="">
            </p>
           
            <p class="input">
                <input type="submit" value="Modifier" name="submit_modification">
            </p>
        </form>
    </section>
    <?php
    if (isset($_POST["submit_modification"])) {
        // $resultat2 = verification();
        // if ($resultat2 === true) {           

            $query = $pdo->prepare('UPDATE utilisateur
            SET nom = :nom, prenom = :prenom, email = :email, mot_de_passe = :password
            WHERE id = $_SESSION["id"] ');

            $query->bindValue(':nom', $_POST["nom"], PDO::PARAM_STR);
            $query->bindValue(':prenom', $_POST["prenom"], PDO::PARAM_STR);
            $query->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
        
            $password = $_POST["password"];
            $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            
            $resultat3 = $query->execute();

           // echo "Votre compte a bien été modifié!";
            header("Location: connexion.php");
        } else { ?>
            <p> Tous les champs sont nécessaires! </p>
    <?php }
   // }



 require_once __DIR__ . "/footer.php"; ?>
</body>

</html>