
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Déposer une annonce</h1>
<form action="detail_annonce.php" method="post">
    <p>
        <label for="prix_de_depart">Prix de réserve: </label>
        <input type="number" name="prix_de_depart" id="prix_de_depart">
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
        <input type="text" name="voiture_puissance" id="voiture_puissance">
    </p>
    <p>
        <label for="voiture_annee">Année: </label>
        <input type="text" name="voiture_annee" id="voiture_annee">
    </p>
    <p>
        <label for="voiture_couleur">Couleur: </label>
        <input type="text" name="voiture_couleur" id="voiture_couleur">
    </p>
    <p>
        <label for="voiture_description">Description: </label>
        <input type="text" name="voiture_description" id="voiture_description">
    </p>  
    <p>
        <input type="submit" value="Ajouter" name="submit_add_annonce">
    </p>
</form>


    
</body>
</html>