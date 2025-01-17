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
                require_once 'connexion-bdrive.php';
            
                if ($_SERVER["REQUEST_METHOD"] == "POST" and $_SESSION["cleLivre"]==0) // si c'est la premiere fois qu'on fais tourner ce prg $_SESSION["test"]=1 nous empechant de recevoir des messages d'erreur
                { // Récupère les données du formulaire qui lui n'est pas en php -> on utilise des données serveurs 
                    $noauteur = $_POST['noauteur'];
                    $titre = $_POST['titre'];
                    $isbn13 = $_POST['isbn13'];
                    $anneeparution = $_POST['anneeparution'];
                    $detail = $_POST['detail'];
                    $photo = $_POST['photo'];
                    $dateajout = date('Y-m-d');
            
            
                    $stmt = $connexion->prepare("INSERT INTO livre (noauteur, titre, isbn13, anneeparution, detail, photo, dateajout) 
                    VALUES (:noauteur, :titre, :isbn13, :anneeparution, :detail, :photo, :dateajout)");
            
                    // Préparation de la requête d'insertion
                    $stmt->bindParam(':noauteur', $noauteur);
                    $stmt->bindParam(':titre', $titre);
                    $stmt->bindParam(':isbn13', $isbn13);
                    $stmt->bindParam(':anneeparution', $anneeparution);
                    $stmt->bindParam(':detail', $detail);
                    $stmt->bindParam(':photo', $photo);
                    $stmt->bindParam(':dateajout', $dateajout);
            
                    // Exécution de la requête
                    if ($stmt->execute()) 
                    {
                        echo "<h5>Le livre " .$titre ." a été ajouté avec succès !</h5>";
                    }

                    //pas besoins de else car le formulaire doit etre completer à 100% pour pouvoir le valider

                }
                    
                $stmt_auteurs = $connexion->prepare("SELECT noauteur, nom FROM auteur");
                $stmt_auteurs->execute();
                $auteurs = $stmt_auteurs->fetchAll(PDO::FETCH_ASSOC);

            }
            else
            {
                echo '<h1> Retourner au menu principal </h1>';
            }
            ?>
            <form action="" method="post">
                <form>
                    <div>
                        <select class="form-control" id="noauteur" name="noauteur" required>
                            <?php 
                                foreach ($auteurs as $auteur): 
                            ?>

                            <option value="<?= $auteur['noauteur']; ?>"><?= $auteur['nom']; ?></option>     <!--Dans l'ordre des num attitré on fait aparaitre les noms d'auteurs-->

                            <?php 
                                endforeach; //On est obliger de fermer la boucle sinon l'ordi ne vas pas la fermé
                            ?>
                            
                        </select>
                    </div>
                    <br>

                    <!-- class="form-control" nous permet de faire en sorte que la barre prenne toute la ligne -->

                    <div>
                        <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" required>
                    </div>

                    <br>

                    <div>
                        <input type="text" class="form-control" id="isbn13" name="isbn13" placeholder="ISBN13" required>
                    </div>

                    <br>

                    <div>
                        <input type="text" class="form-control" id="anneeparution" name="anneeparution" placeholder="Année de Parution" required>
                    </div>

                    <br>

                    <div>
                        <input type="text" class="form-control" id="detail" name="detail" placeholder="Détails" required style="height: 100px;">
                    </div>

                    <br>

                    <div>
                        <input type="text" class="form-control" id="photo" name="photo" placeholder="Nom de Fichier Photo" required>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">Ajouter le livre</button>
                    
                    <?php
                        $_SESSION["cleLivre"]=0
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