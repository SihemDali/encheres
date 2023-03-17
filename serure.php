<?php
require __DIR__."/class/Annonce.php";
require __DIR__."/pdo.php";
require __DIR__."/menu.php";

if(isset($_POST["submit_add_annonce"])) {
    $annonce1 = new Annonce($_POST["prix_depart"], $_POST["date_fin"],$_POST["voiture_modele"],$_POST["voiture_marque"],$_POST["voiture_puissance"], $_POST["voiture_annee"],$_POST["voiture_couleur"],$_POST["voiture_description"],$_POST["utilisateur_id"]);
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
if(isset($_POST["submit_enchere"])) {
    $query = $pdo->prepare("INSERT INTO enchere 
    (date, prix, annonce_id, utilisateur_id) VALUES (:date, :prix, :annonce_id, :utilisateur_id)");

    $query->bindValue(':date', $_POST["date"], PDO::PARAM_STR);
    $query->bindValue(':prix', $_POST["prix"], PDO::PARAM_STR);
    $query->bindValue(':annonce_id', $_POST["annonce_id"], PDO::PARAM_STR);
    $query->bindValue(':utilisateur_id', $_POST["utilisateur_id"], PDO::PARAM_STR);
    $query->bindValue(':voiture_puissance', $_POST["voiture_puissance"], PDO::PARAM_STR);   
    $query->bindValue(':voiture_annee', $_POST["voiture_annee"], PDO::PARAM_STR);
    $query->bindValue(':voiture_couleur', $_POST["voiture_couleur"], PDO::PARAM_STR);
    $query->bindValue(':voiture_description', $_POST["voiture_description"], PDO::PARAM_STR);
    $query->bindValue(':utilisateur_id',1, PDO::PARAM_STR);
    

    $resultat = $query->execute();

// TROISIEME REQUETE POUR RECUP ENCHERE 
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
    <img src="/images/Mini.jpg" alt="imagemini">
<?php 
        afficher_menu("Menu principal", $menuPrincipal, false );
?>
</header>

    <img src="" alt="">

   <section>
       <h2><?php echo "Votre annonce a été ajoutée avec succès!";?></h2> <br>
       <h3>Détails annonce:<?php echo $annonce["voiture_modele"]; ?> </h3>
       <p>Prix de réserve : <?php echo $annonce["prix_depart"]; ?></p>
       <p>Date de fin des enchères : <?php echo $annonce["date_fin"]; ?></p>
       <p>Modèle : <?php echo $annonce["voiture_modele"]; ?></p>
       <p>Marque : <?php echo $annonce["voiture_marque"]; ?></p>
       <p>Puissance : <?php echo $annonce["voiture_puissance"]; ?></p>
       <p>Année : <?php echo $annonce["voiture_annee"]; ?></p>
       <p>Couleur : <?php echo $annonce["voiture_couleur"]; ?></p>
       <p>Description : <?php echo $annonce["voiture_description"]; ?></p>
   </section>
<section>
      <form method="post">
        <p>
            <input type="text">
        </p>
        <input type="submit" value="Valider enchère"name="submit_enchere">
    </form>
    <?php 
        afficher_menu("Menu principal", $menuPrincipal, false );
       
/**********  $query = $pdo->prepare("SELECT prix FROM enchere");*/
// $query = $pdo->prepare("INSERT INTO prix FROM enchere");

//         // On execute la requête
//         $query->execute();
        
        // On récupère un tableau avec un utilisateur par ligne
        // On utilise fetchAll
        $enchere = $query->fetchAll(PDO::FETCH_ASSOC);
        

    foreach ($enchere as $key=>$enchere){?>
    <p> Enchère : <?php echo $enchere["prix"]; ?> </p> 
    <?php } ?>
</section>



  
    <footer>
    Tous droits réservés - 2023 - 
<?php afficher_menu("Menu footer", $menuFooter, false); ?>
</footer>
</body>
</html>


<!-- <?php 
if (isset($_SESSION["nom"])){
    echo $_SESSION["nom"];
}
 }
?> -->

<script>
    setTimeout(() => {
        //if  {
          window.location.href="connexion.php" ;
       // }
    }, 1000);

</script>

<?php
require_once __DIR__."/pdo.php";
require_once __DIR__."/menu.php";
require_once __DIR__."/session.php";


if(isset($_POST["submit_add_annonce"])) {
    $query = $pdo->prepare("INSERT INTO annonce (prix_depart, date_fin, voiture_modele, voiture_marque, voiture_puissance, voiture_annee, voiture_couleur, voiture_description, utilisateur_id) VALUES (:prix_depart, :date_fin, :voiture_modele, :voiture_marque, :voiture_puissance, :voiture_annee, :voiture_couleur, :voiture_description, :utilisateur_id)");

    $query->bindValue(':prix_depart', $_POST["prix_depart"], PDO::PARAM_STR);
    $query->bindValue(':date_fin', $_POST["date_fin"], PDO::PARAM_STR);
    $query->bindValue(':voiture_modele', $_POST["voiture_modele"], PDO::PARAM_STR);
    $query->bindValue(':voiture_marque', $_POST["voiture_marque"], PDO::PARAM_STR);
    $query->bindValue(':voiture_puissance', $_POST["voiture_puissance"], PDO::PARAM_STR);   
    $query->bindValue(':voiture_annee', $_POST["voiture_annee"], PDO::PARAM_STR);
    $query->bindValue(':voiture_couleur', $_POST["voiture_couleur"], PDO::PARAM_STR);
    $query->bindValue(':voiture_description', $_POST["voiture_description"], PDO::PARAM_STR);
    $query->bindValue(':utilisateur_id', 5, PDO::PARAM_STR);
    
    $resultat = $query->execute();

    //header("Location: detail_annonce.php"); 
 
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

<p >
    <?php
  
        if(isset($_POST["submit_add_annonce"])) {         

            $query = $pdo->prepare("INSERT INTO annonce (prix_depart, date_fin, voiture_modele, voiture_marque, voiture_puissance, voiture_annee, voiture_couleur, voiture_description, utilisateur_id) VALUES (:prix_depart, :date_fin, :voiture_modele, :voiture_marque, :voiture_puissance, :voiture_annee, :voiture_couleur, :voiture_description, :utilisateur_id)");
            header("Location: detail_annonce.php");
                   
             }
  
  
?>
</p>
<section class="form_style">
<h1>Déposer une annonce</h1>
<form  method="post" >
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
<?php require_once __DIR__."/footer.php"; ?>  
</div>

</body>
</html>