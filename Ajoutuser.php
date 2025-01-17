<?php
// Démarrage de la session, instruction a placer en tête de script
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container text-center">

    <?php
        include 'barreadmin.php';
    ?>


    <div class="row">
        <div class="col-sm-9" style="background-color:lavender;">
            <?php
            if (isset($_SESSION['prenom']))
            {
                echo "<h5> Ajout auteur <h5>";

        
                /* L'entrée chercher est vide = le formulaire n'a pas été submit=posté, on affiche le formulaire */
                echo '
                    <form action="" method = "post" ">
                    mel:<input name="mel" type="text"  class="form-control" size ="10"">
                    motdepasse:<input name="motdepasse" type="text" class="form-control"size ="10"">
                    nom:<input name="nom" type="text" class="form-control" size ="10"">
                    prenom:<input name="prenom" type="text" class="form-control" size ="10"">
                    adresse:<input name="adresse" type="text" class="form-control" size ="10"">
                    ville:<input name="ville" type="text" class="form-control" size ="10"">
                    codepostal:<input name="codepostal" type="text" class="form-control" size ="10"">
                    <input type="submit" name="Ajouter"  value="Ajouter">
                    </form>';
        
                if (isset($_POST['Ajouter']))
                {
                    $mel = $_POST["mel"];
                    $motdepasse = $_POST["motdepasse"];
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];
                    $adresse = $_POST["adresse"];
                    $ville = $_POST["ville"];
                    $codepostal = $_POST["codepostal"];
                    $motdepasse = $_POST["motdepasse"];
                    $profil = "client";

                    require_once('connexion-bdrive.php');
                    $stmt = $connexion->prepare("INSERT INTO utilisateur (mel, motdepasse, nom, prenom, adresse, ville, codepostal, profil) VALUES (:mel, :motdepasse, :nom, :prenom, :adresse, :ville, :codepostal, :profil)");

                    $stmt->bindValue(':mel', $mel, PDO::PARAM_STR);
                    $stmt->bindValue(':motdepasse', $motdepasse, PDO::PARAM_STR);
                    $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
                    $stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR);
                    $stmt->bindValue(':adresse', $adresse, PDO::PARAM_STR);
                    $stmt->bindValue(':ville', $ville, PDO::PARAM_STR);
                    $stmt->bindValue(':codepostal', $codepostal, PDO::PARAM_STR);
                    $stmt->bindValue(':profil', $profil, PDO::PARAM_STR);


                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $stmt->execute();


                    echo "<h5> Ajout de l'auteur ".$nom ." " .$prenom. " completé <h5>";

                //On aurait put mettre un seul echo mais bon ca fais plus propre//

                }
            
            }
            else
            {
                echo '<h1> Retourner au menu principal </h1>';
            }
            ?>

        </div>
        
        <?php
            include 'identification.php';
        ?>

    </div>
    
</body>

</html>  