<?php
require_once __DIR__."/pdo.php";
require_once __DIR__."/menu.php";

if(isset($_POST["submit_add_annonce"])) {
    $query = $pdo->prepare("INSERT INTO annonce (prix_depart, date_fin, voiture_modele, voiture_marque, voiture_puissance, voiture_annee, voiture_couleur, voiture_description, utilisateur_id) VALUES (:prix_de_
    depart, :date_fin, :voiture_modele, :voiture_marque, :voiture_puissance, :voiture_annee, :voiture_couleur, :voiture_description, :utilisateur_id)");

    $query->bindValue(':prix_depart', $_POST["prix_depart"], PDO::PARAM_STR);
    $query->bindValue(':date_fin', $_POST["date_fin"], PDO::PARAM_STR);
    $query->bindValue(':voiture_modele', $_POST["voiture_modele"], PDO::PARAM_STR);
    $query->bindValue(':voiture_marque', $_POST["voiture_marque"], PDO::PARAM_STR);
    $query->bindValue(':voiture_puissance', $_POST["voiture_puissance"], PDO::PARAM_STR);   
    $query->bindValue(':voiture_annee', $_POST["voiture_annee"], PDO::PARAM_STR);
    $query->bindValue(':voiture_couleur', $_POST["voiture_couleur"], PDO::PARAM_STR);
    $query->bindValue(':voiture_description', $_POST["voiture_description"], PDO::PARAM_STR);
    $query->bindValue(':utilisateur_id',1, PDO::PARAM_STR);
    

    $resultat = $query->execute();



    //header("Location: detail_annonce.php");

    //var_dump( $resultat);   
 
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

<p>
    <?php
if(isset($_POST["submit_add_annonce"])) {
    $query = $pdo->prepare("INSERT INTO annonce (prix_depart, date_fin, voiture_modele, voiture_marque, voiture_puissance, voiture_annee, voiture_couleur, voiture_description, utilisateur_id) VALUES (:prix_depart, :date_fin, :voiture_modele, :voiture_marque, :voiture_puissance, :voiture_annee, :voiture_couleur, :voiture_description, :utilisateur_id)");

    echo "Votre annonce a bien été ajoutée! ";
     }
?>
</p>

<h1>Déposer une annonce</h1>
<form action="" method="post">
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
    <p>
        <input type="submit" value="Ajouter" name="submit_add_annonce">
    </p>
</form>

    
</body>
</html>