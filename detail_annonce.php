use PDO;
use Annonce;
<?php
require __DIR__ . "/class/Annonce.php";
require __DIR__ . "/pdo.php";
require __DIR__ . "/menu.php";



// PREMIERE PARTIE
if (isset($_POST["submit_add_annonce"])) {
    $annonce1 = new Annonce($_POST["prix_depart"], $_POST["date_fin"], $_POST["voiture_modele"], $_POST["voiture_marque"], $_POST["voiture_puissance"], $_POST["voiture_annee"], $_POST["voiture_couleur"], $_POST["voiture_description"], $_POST["utilisateur_id"]);
    $annonce2->save($pdo);
}


// // On prépare une requête
$query = $pdo->prepare('SELECT * FROM annonce WHERE id = :id');

// // On remplace la variable intermédiaire
$query->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

// // On execute la requête
$query->execute();

// // On récupère l'utilisateur dans un tableau associatif
// // On utilise fetch si on récupère un seul élement
$annonce = $query->fetch(PDO::FETCH_ASSOC);


// DEUXIEME REQUETE POUR LE FORMILAIRE
if (isset($_POST["submit_enchere"])) {
    $query = $pdo->prepare("INSERT INTO enchere 
    (date, prix, annonce_id, utilisateur_id) VALUES (:date, :prix, :annonce_id, :utilisateur_id)");

    $query->bindValue(':date', date("y.m.d"), PDO::PARAM_STR);
    $query->bindValue(':prix', $_POST["prix"], PDO::PARAM_INT);
    $query->bindValue(':annonce_id', $_GET['id'], PDO::PARAM_STR);
    $query->bindValue(':utilisateur_id', 2, PDO::PARAM_STR);



    $resultat = $query->execute();
}
// TROISIEME REQUETE POUR RECUP ENCHERE 


$query = $pdo->prepare('SELECT * FROM enchere WHERE annonce_id = "$_GET[id]"');

// On execute la requête
$query->execute();

$enchere = $query->fetchAll(PDO::FETCH_ASSOC);

// On récupère un tableau avec un utilisateur par ligne
// On utilise fetchAll

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
        afficher_menu("Menu principal", $menuPrincipal, false);
        ?>
    </header>


    <!-- DETAIL DE L ANNONCE -->
    <section class=detail_annonce>
        <h2>Detail de l'annonce pour le modele <?php echo $annonce["voiture_modele"]; ?></h2> <br>
        <h3>Détails annonce: </h3>
        <p>Prix de réserve : <?php echo $annonce["prix_depart"]; ?></p>
        <p>Date de fin des enchères : <?php echo $annonce["date_fin"]; ?></p>
        <p>Modèle : <?php echo $annonce["voiture_modele"]; ?></p>
        <p>Marque : <?php echo $annonce["voiture_marque"]; ?></p>
        <p>Puissance : <?php echo $annonce["voiture_puissance"]; ?></p>
        <p>Année : <?php echo $annonce["voiture_annee"]; ?></p>
        <p>Couleur : <?php echo $annonce["voiture_couleur"]; ?></p>
        <p>Description : <?php echo $annonce["voiture_description"]; ?></p>
    </section>

    <!-- FAIRE UNE ENCHERE SUR L ANNONCE -->
    <section>
        <h2>Faire un enchère</h2>
        <form method="post">

            <p>
                <label for="prix">Votre enchère:</label>
                <input type="number" name="prix" min=500>
            </p>
            <input type="submit" value="Valider enchère" name="submit_enchere">
        </form>
        <?php
      

        /**********  $query = $pdo->prepare("SELECT prix FROM enchere");*/
        // $query = $pdo->prepare("INSERT INTO prix FROM enchere");

        //         // On execute la requête
        //         $query->execute();

        // On récupère un tableau avec un utilisateur par ligne
        // On utilise fetchAll
        $enchere = $query->fetchAll(PDO::FETCH_ASSOC); ?>

    </section>

    <!-- LISTE DES ANNONCES -->
    <section>
        <h2>Liste des encheres pour <?php echo $annonce["voiture_modele"]; ?> </h2>
        <p>Bonjourno</p>
       echo <ul>
            <?php foreach ($enchere as $key => $value) { ?> 
            echo  <li>
                    <?php $value["prix"] . $value["date"] ?>
              echo  </li>
            <?php } ?>
       echo </ul>
        <p>Byebye</p>

    </section>



</body>

</html>