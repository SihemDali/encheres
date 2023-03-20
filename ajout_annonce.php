<?php
require_once __DIR__ . "/pdo.php";
require_once __DIR__ . "/menu.php";
require_once __DIR__ . "/session.php";
require_once __DIR__ . "/Class/Annonce.php";

//Méthode avec fonction save(): 
// if(isset($_POST["submit_add_annonce"])) {
//    $annonce1 = new Annonce($_POST["prix_depart"], $_POST["date_fin"],$_POST["voiture_modele"],$_POST["voiture_marque"],$_POST["voiture_puissance"], $_POST["voiture_annee"],$_POST["voiture_couleur"],$_POST["voiture_description"],$_GET["id"]);
//    var_dump($annonce1);
//     // $annonce1->save($pdo);
//     // header("Location: detail_annonce.php?id=".$pdo->lastInsertId()); 
//   }
//Méthode sans fonction save()
if (isset($_POST["submit_add_annonce"])) {
    $query = $pdo->prepare("INSERT INTO annonce (prix_depart, date_fin, voiture_modele, voiture_marque, voiture_puissance, voiture_annee, voiture_couleur, voiture_description, utilisateur_id) VALUES (:prix_depart, :date_fin, :voiture_modele, :voiture_marque, :voiture_puissance, :voiture_annee, :voiture_couleur, :voiture_description, :utilisateur_id)");

    $query->bindValue(':prix_depart', $_POST["prix_depart"], PDO::PARAM_STR);
    $query->bindValue(':date_fin', $_POST["date_fin"], PDO::PARAM_STR);
    $query->bindValue(':voiture_modele', $_POST["voiture_modele"], PDO::PARAM_STR);
    $query->bindValue(':voiture_marque', $_POST["voiture_marque"], PDO::PARAM_STR);
    $query->bindValue(':voiture_puissance', $_POST["voiture_puissance"], PDO::PARAM_STR);
    $query->bindValue(':voiture_annee', $_POST["voiture_annee"], PDO::PARAM_STR);
    $query->bindValue(':voiture_couleur', $_POST["voiture_couleur"], PDO::PARAM_STR);
    $query->bindValue(':voiture_description', $_POST["voiture_description"], PDO::PARAM_STR);
    $query->bindValue(':utilisateur_id', $_SESSION["id"], PDO::PARAM_STR);

    $resultat = $query->execute();
    header("Location: detail_annonce.php?id=" . $pdo->lastInsertId());
    echo "Votre annonce a bien été ajoutée";

    //echo $pdo->lastInsertId();
    //pdo nous retourne l'id de ce qu'il vient de créer 
    //si pas de redirection, pas besoin de: 

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

    <p>
        <?php

        if (isset($_POST["submit_add_annonce"])) {
            $query = $pdo->prepare("INSERT INTO annonce (prix_depart, date_fin, voiture_modele, voiture_marque, voiture_puissance, voiture_annee, voiture_couleur, voiture_description, utilisateur_id) VALUES (:prix_depart, :date_fin, :voiture_modele, :voiture_marque, :voiture_puissance, :voiture_annee, :voiture_couleur, :voiture_description, :utilisateur_id)");

            echo " Votre annonce a bien été ajoutée! ";
        }

        // else {
        //     return false;

        //     //header("Location: .php"); 

        // }
        ?>
    </p>
    <section class="form_style">
        <h1>Déposer une annonce</h1>
        <form method="post">
            <p>
                <label for="prix_depart">Prix de réserve: </label>
                <input type="number" name="prix_depart" id="prix_depart" min="500">
            </p>
            <p>
                <label for="date_fin">Date de fin des enchères: </label>
                <input type="date" name="date_fin" id="date_fin">

            </p>
            <p>
                <label for="voiture_modele">Modèle: </label>
                <input type="text" name="voiture_modele" id="voiture_modele">
            </p>
            <p>
                <label for="voiture_marque">Marque: </label>
                <input type="text" name="voiture_marque" id="voiture_marque">
            </p>
            <p>
                <label for="voiture_puissance">Puissance: </label>
                <input type="number" name="voiture_puissance" id="voiture_puissance">
            </p>
            <p>
                <label for="voiture_annee">Année: </label>
                <input type="number" name="voiture_annee" id="voiture_annee">
            </p>
            <p>
                <label for="voiture_couleur">Couleur: </label>
                <input type="text" name="voiture_couleur" id="voiture_couleur">
            </p>
            <p>
                <label for="voiture_description">Description: </label>
                <textarea name="voiture_description" id="voiture_description" cols="30" rows="10"></textarea>
            </p>
            <p class="input">
                <input type="submit" value="Ajouter" name="submit_add_annonce">
            </p>
    </section>

    </main>

    <div>
        <?php require_once __DIR__ . "/footer.php"; ?>
    </div>


</body>

</html>