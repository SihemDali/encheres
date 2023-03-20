<?php
require_once __DIR__ . "/menu.php";

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


        <div>
            <?php
            if (isset($_SESSION["id"])) {


                afficher_menu("Menu principal", $menudeconnexion, false);
            }   ?>
        </div>

        <div class="bonjour">
            <?php
            if (isset($_SESSION["nom"])) {

                echo " " . " Bonjour" . " " . $_SESSION["nom"]  . " " . $_SESSION["prenom"] . " ! ";    ?>
            <?php } else {
                afficher_menu("Menu principal", $menuPrincipal, false);
            } ?>
            </p>


    </header>


    <section class="form_style">
        <h1>Formulaire de contact</h1>
        <form action="contact.php" method="post">
            <p>
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom">
            </p>
            <p>
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom">
            </p>
            <p>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </p>
            <p>
                <label for="telephone">Téléphone</label>
                <input type="phone" name="telephone" id="telephone">
            </p>
            <p>
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10"></textarea>
            </p>
            <input type="submit" value="Envoyer" name="submit_contact">
        </form>
    </section>

    <?php if ($_SERVER['REQUEST_METHOD'] === "POST") { ?>


        <h1>Votre message a bien été envoyé</h1>
        <p>Nom: <?= $_POST["nom"]; ?></p>
        <p>Prénom: <?= $_POST["prenom"]; ?></p>
        <p>Email: <?= $_POST["email"]; ?></p>
        <p>Téléphone: <?= $_POST["telephone"]; ?></p>
        <p>Message: <?= nl2br($_POST["message"]); ?></p>

    <?php  } ?>

    <div>
        <?php require_once __DIR__ . "/footer.php"; ?>
    </div>
</body>

</html>