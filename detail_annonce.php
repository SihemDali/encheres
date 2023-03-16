<!-- <?php
require __DIR__."/class/Annonce.php";
require __DIR__."/pdo.php";

if(isset($_POST["submit_add_annonce"])) {
    $annonce1 = new Annonce($_POST["prix_depart"], $_POST["date_fin"],$_POST["voiture_modele"],$_POST["voiture_marque"],$_POST["voiture_puissance"], $_POST["voiture_annee"],$_POST["voiture_couleur"],$_POST["voiture_description"]);
    $annonce2->save($pdo);
}

?>
creation d'une page pdo.php
<?php
$pdo = new PDO("mysql:dbname=enchere;host=localhost", "root", "");
?> -->

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
   
    <?php echo "Votre annonce a été ajoutée avec succès!";?>
    <p>Détails annonce: </p>


    
</body>
</html>