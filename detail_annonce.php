<?php
 $pdo = new PDO("mysql:dbname=enchere;host=localhost", "root", "");

if(isset($_POST["submit_add_annonce"])) {
    $query = $pdo->prepare("INSERT INTO annonce (prix_depart, date_fin, voiture_modele, voiture_marque, voiture_puissance, voiture_annee, voiture_couleur, voiture_description) VALUES (:prix_depart, :date_fin, :voiture_modele, :voiture_marque, :voiture_puissance, :voiture_annee, :voiture_couleur, :voiture_description)");

    $query->bindValue(':prix_depart', $_POST["prix_de_depart"], PDO::PARAM_STR);
    $query->bindValue(':date_fin', $_POST["date_fin"], PDO::PARAM_STR);
    $query->bindValue(':voiture_modele', $_POST["voiture_modele"], PDO::PARAM_STR);
    $query->bindValue(':voiture_marque', $_POST["voiture_marque"], PDO::PARAM_STR);
    $query->bindValue(':voiture_puissance', $_POST["voiture_puissance"], PDO::PARAM_STR);
    $query->bindValue(':voiture_annee', $_POST["voiture_annee"], PDO::PARAM_STR);
    $query->bindValue(':voiture_couleur', $_POST["voiture_couleur"], PDO::PARAM_STR);
    $query->bindValue(':voiture_description', $_POST["voiture_description"], PDO::PARAM_STR);
    

    $resultat = $query->execute();

    echo "Votre annonce a bien été créée";    

  



 }





?>