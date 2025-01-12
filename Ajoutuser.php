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
                require_once 'connexion-bdrive.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST" and $_SESSION["cleUser"]==0) // si c'est la premiere fois qu'on fais tourner ce prg $_SESSION["test"]=1 nous empechant de recevoir des messages d'erreur
                { // Récupère les données du formulaire qui lui n'est pas en php -> on utilise des données serveurs 
                    $mel = $_POST['mel'];
                    $motdepasse = $_POST['motdepasse'];
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $adresse = $_POST['adresse'];
                    $ville = $_POST['ville'];
                    $codepostal = $_POST['codepostal'];
                    $profil = "client";
            
            
                    $stmt = $connexion->prepare("INSERT INTO utilisateur (mel, motdepasse, nom, prenom, adresse, ville, codepostal, profil) 
                    VALUES (:mel, :motdepasse, :nom, :prenom, :adresse, :ville, :codepostal, :profil)");
            
                    // Préparation de la requête d'insertion
                    $stmt->bindParam(':mel', $mel);
                    $stmt->bindParam(':motdepasse', $motdepasse);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':prenom', $prenom);
                    $stmt->bindParam(':adresse', $adresse);
                    $stmt->bindParam(':ville', $ville);
                    $stmt->bindParam(':codepostal', $codepostal);
                    $stmt->bindParam(':profil', $profil);
            
                    // Exécution de la requête
                    if ($stmt->execute()) 
                    {
                        echo "<h5>Le nouvel utilisateur " .$nom ." ".$prenom ." a été ajouté avec succès !</h5>";
                    }

                    //pas besoins de else car le formulaire doit etre completer à 100% pour pouvoir le valider

                }

            ?>
            <form action="" method="post">
                <form>

                    <!-- class="form-control" nous permet de faire en sorte que la barre prenne toute la ligne -->

                    <div>
                        <input type="text" class="form-control" id="mel" name="mel" placeholder="Adresse mail" required>
                    </div>

                    <br>

                    <div>
                        <input type="text" class="form-control" id="motdepasse" name="motdepasse" placeholder="Mot de passe" required>
                    </div>

                    <br>

                    <div>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                    </div>

                    <br>

                    <div>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
                    </div>

                    <br>

                    <div>
                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" required>
                    </div>

                    <br>

                    <div>
                        <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" required>
                    </div>

                    <br>

                    <div>
                        <input type="text" class="form-control" id="codepostal" name="codepostal" placeholder="Code postal" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Ajouter le livre</button>
                    
                    <?php
                        $_SESSION["cleUser"]=0
                    ?>

                </form>
                
            </form>

        </div>
        
        <?php
            include 'identification.php';
        ?>

    </div>
    
</body>

</html>  