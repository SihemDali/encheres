<?php

require_once __DIR__."/pdo.php";
require_once __DIR__."/menu.php";

function verification() {

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
<header>
    <h1>AFFAIRE . CONCLUE . AUTO</h1>
<?php 
        afficher_menu("Menu principal", $menuPrincipal, false );
?>
</header>

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
    <input type="submit" value="Inscription" name="submit_inscription">
    </p>
    </form>

    <?php
    if (isset($_POST["submit_inscription"])) {
        $resultat2 = verification();
        if ($resultat2 === true) {         
            $query = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, email, mot_de_passe) VALUES (:nom,:prenom,:email,:password)");
            
            $query->bindValue(':nom', $_POST["nom"], PDO::PARAM_STR);
            $query->bindValue(':prenom', $_POST["prenom"], PDO::PARAM_STR);
            $query->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
            $query->bindValue(':password', $_POST["password"], PDO::PARAM_STR);         
                
            $resultat2 = $query->execute();


            echo "Votre compte a bien été créé!";

            header("Location: connexion.php");
        } else {
            echo "Tous les champs sont nécessaires";
        }
    }
    ?>

<?php require_once __DIR__."/footer.php"; ?>
</body>
</html>