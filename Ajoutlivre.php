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
            <br><br>
            <form>
                <h5> Ajout de livre à la base de donnée Veullez compléter ce formulaire</h5>
                <br> <!-- affiche les formulaires-->
                <form action="" method="post">
                    <?php
                        require_once 'connexion-bdrive.php';
                        $stmt_auteurs = $connexion->prepare("SELECT noauteur, nom FROM auteur");
                        $stmt_auteurs->execute(); //A CHANGER
                        $auteurs = $stmt_auteurs->fetchAll(PDO::FETCH_ASSOC); // verifie si il en manque
                    ?>

                    <div>
                        <select class="form-control" id="noauteur" name="noauteur" required>
                            <?php 
                                foreach ($auteurs as $auteur): 
                            ?>

                            <option value="<?= $auteur['noauteur']; ?>"><?= $auteur['nom']; ?></option>     <!--Pour le serveur revoir la video-->

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
                    $dateajout = date('Y-m-d H:i:s');
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