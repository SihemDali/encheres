<?php
require __DIR__ . "/class/Annonce.php";
require __DIR__ . "/pdo.php";
require __DIR__ . "/session.php";
require_once __DIR__ . "/menu.php";

//var_dump($_SESSION);
//On a bien un id dans notre tableau $_SESSION 

//Au cas où pas d'id, renvoyer vers l'accueil 
if (!isset($_GET["id"])) {
    header("Location: index.php");
}


if (isset($_POST["submit_add_annonce"])) {
    $annonce1 = new Annonce($_POST["prix_depart"], $_POST["date_fin"], $_POST["voiture_modele"], $_POST["voiture_marque"], $_POST["voiture_puissance"], $_POST["voiture_annee"], $_POST["voiture_couleur"], $_POST["voiture_description"], $id);
}

$query = $pdo->prepare('SELECT annonce.prix_depart, annonce.date_fin, annonce.voiture_modele, annonce.voiture_marque, annonce.voiture_puissance, annonce.voiture_annee, annonce.voiture_couleur, annonce.voiture_description, annonce.utilisateur_id, utilisateur.nom, utilisateur.prenom 
FROM `annonce`
JOIN utilisateur ON utilisateur.id = annonce.utilisateur_id
WHERE annonce.id = :id');
$query->bindValue(':id', $_GET["id"], PDO::PARAM_INT);
$query->execute();
$annonce = $query->fetch(PDO::FETCH_ASSOC);


////////////////////////////////////////////////////////////////////////

if (isset($_POST["submit_enchere"])) {

    $query = $pdo->prepare("INSERT INTO enchere ( date, prix, annonce_id, utilisateur_id) VALUES (:date,:prix,:annonce_id,:utilisateur_id)");
    $query->bindValue(':date', date("ymd"), PDO::PARAM_STR);
    $query->bindValue(':prix', $_POST["enchere"], PDO::PARAM_STR);
    $query->bindValue(':annonce_id', $_GET["id"], PDO::PARAM_STR);
    $query->bindValue(':utilisateur_id', $_SESSION["id"], PDO::PARAM_STR);

    $resultat = $query->execute();
}

$date_du_jour = new DateTime();

$date_fin = new DateTime($annonce["date_fin"]);


$query = $pdo->prepare('SELECT MAX(prix), date ,utilisateur.nom , utilisateur.prenom 
FROM enchere
JOIN utilisateur ON utilisateur.id = enchere.utilisateur_id
WHERE annonce_id = :annonce_id');
$query->bindValue(':annonce_id', $_GET["id"], PDO::PARAM_STR);
$query->execute();

$max = $query->fetch(PDO::FETCH_ASSOC);
//var_dump($gagnant);
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


            <?php
            $query = $pdo->prepare('SELECT MAX(prix), date ,utilisateur.nom , utilisateur.prenom 
FROM enchere
JOIN utilisateur ON utilisateur.id = enchere.utilisateur_id
WHERE annonce_id = :annonce_id');
            $query->bindValue(':annonce_id', $_GET["id"], PDO::PARAM_STR);
            $query->execute();

            $max = $query->fetch(PDO::FETCH_ASSOC);
            //var_dump($gagnant);
            ?>

    </header>

    <section class="affichage_detail_annonce">

        <h2>DETAILS DE L'ANNONCE: </h2>
        <h3><?php echo $annonce["voiture_modele"] . " " . $annonce["voiture_marque"] . " " . $annonce["voiture_annee"] ?> </h3>
        <p>Date de réserve : <?php echo $annonce["prix_depart"]; ?></p>
        <p>Date de fin des enchères : <?php echo $annonce["date_fin"]; ?></p>
        <p>Modèle : <?php echo $annonce["voiture_modele"]; ?></p>
        <p>Marque : <?php echo $annonce["voiture_marque"]; ?></p>
        <p>Puissance : <?php echo $annonce["voiture_puissance"]; ?></p>
        <p>Année : <?php echo $annonce["voiture_annee"]; ?></p>
        <p>Couleur : <?php echo $annonce["voiture_couleur"]; ?></p>
        <p>Description : <?= nl2br($annonce["voiture_description"]); ?></p>
        <p>Postée par: <?php echo $annonce["nom"] . " " . $annonce["prenom"]; ?> </p>

    </section>
    <?php if ($date_fin > $date_du_jour) { ?>

        <section class="form_enchere">

            <p>Enchère maximale en cours: <?php echo "<br> - Montant : " . $max["MAX(prix)"] . " € " . "<br> - Effectuée par : " . $max["nom"] . " " . $max["prenom"] ?> </p>

            <h2>FAIRE UNE ENCHERE POUR L'ANNONCE:<?php echo " " . $annonce["voiture_modele"] . " " . $annonce["voiture_marque"] . " " . $annonce["voiture_annee"] ?> </h2>


            <p>
            <form action="" method="post">
                <label for="enchere">Votre montant : </label>
                <input type="number" name="enchere" id="enchere" min="1000">
                </p>
                <p>
                    <input type="submit" value="Enchérir" name="submit_enchere">
                </p>
            </form>


        </section>

        <section class="afficher_encheres">
            <?php
            //if (isset($_POST["submit_enchere"])){

            $query = $pdo->prepare('SELECT enchere.prix, enchere.date, utilisateur.prenom, utilisateur.nom FROM enchere 
  JOIN utilisateur ON utilisateur.id = enchere.utilisateur_id
  WHERE annonce_id = :annonce_id');
            $query->bindValue(':annonce_id', $_GET["id"], PDO::PARAM_STR);
            $query->execute();

            $encheres = $query->fetchAll(PDO::FETCH_ASSOC);
            // echo "OK";
            // var_dump($encheres);
            ?>
            <h2>LISTE DES ENCHERES POUR L'ANNONCE : <?php echo " " . $annonce["voiture_modele"] . " " . $annonce["voiture_marque"] . " " . $annonce["voiture_annee"] ?> </h2>
            <ol>
                <?php
                foreach ($encheres as $key => $enchere) { ?>
                    <li> Montant de l'enchère: <?php echo $enchere["prix"] . " € " . "<br>" . "Date de l'enchère:" . $enchere["date"] . "<br>" . "Effectuée par : " . $enchere["nom"] . " " . $enchere["prenom"] . "\n"; ?></li>
                <?php } ?>
            </ol>

        </section>

    <?php } ?>

    <?php if ($date_fin < $date_du_jour) {

        $query = $pdo->prepare('SELECT MAX(prix), date ,utilisateur.nom , utilisateur.prenom 
FROM enchere
JOIN utilisateur ON utilisateur.id = enchere.utilisateur_id
WHERE annonce_id = :annonce_id');
        $query->bindValue(':annonce_id', $_GET["id"], PDO::PARAM_STR);
        $query->execute();

        $max = $query->fetch(PDO::FETCH_ASSOC);
        //var_dump($gagnant);
    ?>
        <div class="gagnant">
            <p>Résultat de l'enchere pour le véhicule : <?php echo  "<br>" . $annonce["voiture_modele"] . " - " . $annonce["voiture_marque"] . " - " . $annonce["voiture_annee"] ?> </p>
            <p><?php echo "Le gagnant est: " . $max["nom"] . " " . $max["prenom"] . "<br>" . "Pour un montant de :" .  $max["MAX(prix)"] . " € " ?></p>
        <?php } ?>

        </div>

        <div>
            <?php require_once __DIR__ . "/footer.php"; ?>
        </div>

</body>

</html>