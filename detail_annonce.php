 <?php
require __DIR__."/class/Annonce.php";
require __DIR__."/pdo.php";

if(isset($_POST["submit_add_annonce"])) {
    $annonce1 = new Annonce($_POST["prix_depart"], $_POST["date_fin"],$_POST["voiture_modele"],$_POST["voiture_marque"],$_POST["voiture_puissance"], $_POST["voiture_annee"],$_POST["voiture_couleur"],$_POST["voiture_description"]);
    $annonce2->save($pdo);
}


// On prépare une requête
$query = $pdo->prepare('SELECT * FROM annonce WHERE id = :id');

// On remplace la variable intermédiaire
$query->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

// On execute la requête
$query->execute();

// On récupère l'utilisateur dans un tableau associatif
// On utilise fetch si on récupère un seul élement
$annonce = $query->fetch(PDO::FETCH_ASSOC);


// DEUXIEME REQUETE POUR LE FORMILAIRE


// TROISIEME REQUETE POUR RECUP ENCHERE 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
</head>
<body>
    
    <img src="" alt="">
   
    <h2><?php echo "Votre annonce a été ajoutée avec succès!";?></h2> <br>
    <h3>Détails annonce:<?php echo $annonce["voiture_modele"]; ?> </h3>
    <p>Date de réserve : <?php echo $annonce["prix_depart"]; ?></p>
    <p>Date de fin des enchères : <?php echo $annonce["date_fin"]; ?></p>
    <p>Modèle : <?php echo $annonce["voiture_modele"]; ?></p>
    <p>Marque : <?php echo $annonce["voiture_marque"]; ?></p>
    <p>Puissance : <?php echo $annonce["voiture_puissance"]; ?></p>
    <p>Année : <?php echo $annonce["voiture_annee"]; ?></p>
    <p>Couleur : <?php echo $annonce["voiture_couleur"]; ?></p>
    <p>Description : <?php echo $annonce["voiture_description"]; ?></p>

    <form method="post">
        <p>
            <input type="text">
        </p>
        <input type="submit" value="Valider enchère">
    </form>

</body>
</html>