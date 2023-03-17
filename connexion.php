<?php
require_once __DIR__ . "/pdo.php";
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
    <header>
        <h1>AFFAIRE . CONCLUE . AUTO</h1>

        <?php
        afficher_menu("Menu principal", $menuPrincipal, false);
        ?>
    </header>
    <section class="form_style">
        <h1>Connexion: </h1>
        <form  method="post">
            <p>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email">
            </p>
            <p>
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password">
            </p>

            <p class="input">
                <input type="submit" value="Connexion" name="submit_connexion">
            </p>
        </form>
    </section>
    <?php


    if (isset($_POST["submit_connexion"])) {
        $query = $pdo->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $query->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetchAll();
        $nombre = $query->rowCount();
        if ($nombre === 0) {
    ?>
            <p> Email inexistant! </p>
            <?php
 }
if ($nombre >0) {
    if ($user) {
        foreach ($user as $key => $value) {
            $email = $value["email"];
            $nom = $value["nom"];
            $password = $value["mot_de_passe"];

            if (password_verify($_POST["password"], $password)) {
                include __DIR__ . "/session.php";
                $_SESSION["user"] = $user;
                $_SESSION["email"] = $email;
                $_SESSION["nom"] = $nom;

                header("Location: index.php");
                //echo "Bonjour" ." ". $_SESSION["nom"]." ! ";
               
            
            } 
            else {  ?>

                <p> Email ou mot de passe incorrect! </p>
    <?php
            }
        } }
       
  
    }

}
        
    










    require_once __DIR__ . "/footer.php"; ?>


</body>

</html>