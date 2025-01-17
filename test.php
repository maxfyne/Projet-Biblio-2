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
            <form action="" method="post">
                <form>
                <?php
                echo '
                    <h5> Ajout auteur <h5> 
                    <form method ="POST" name = "auteur"> 
                    <select>';

                require_once 'connexion-bdrive.php';

                $stmt_auteurs = $connexion->prepare("SELECT noauteur, nom FROM auteur");
                $stmt_auteurs ->setFetchMode(PDO::FETCH_OBJ);
                $stmt_auteurs->execute();

                while ($enregistrement = $stmt_auteurs->fetch());
                {
                    ?>
                    <h5><option value=<?=$enregistrement->noauteur?>><?=$enregistrement->nom?></option>
                    <?php
                }

                echo '
                    </select><br>
                    Titre:<input type="text" class="form-control" id="titre" name="titre" required>
                    ISBN13:<input type="text" class="form-control" id="isbn13" name="isbn13"  required>
                    Année de Parution:<input type="text" class="form-control" id="anneeparution" name="anneeparution" required>
                    Détail:<input type="text" class="form-control" id="detail" name="detail" required style="height: 100px;">
                    Nom de fichier photo:<input type="text" class="form-control" id="photo" name="photo" required>
                    <input type="submit" name="Ajouter"  value="Ajouter">
                    </form>';
        
                if (isset($_POST['Ajouter']))
                {
                    $auteur = $_POST["auteur"];
                    $titre = $_POST["titre"];
                    $isbn13 = $_POST["isbn13"];
                    $anneeparution = $_POST["anneeparution"];
                    $detail = $_POST["detail"];
                    $photo = $_POST["photo"];
                    $dateajout = date('Y-m-d');

                    require_once('connexion-bdrive.php');
                    $stmt = $connexion->prepare("INSERT INTO livre (noauteur, titre, isbn13, anneeparution, detail, photo, dateajout) VALUES (:noauteur, :titre, :isbn13, :anneeparution, :detail, :photo, :dateajout)");
                    $stmt->bindValue(':auteur', $auteur, PDO::PARAM_STR);
                    $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
                    $stmt->bindValue(':isbn13', $isbn13, PDO::PARAM_STR);
                    $stmt->bindValue(':anneeparution', $anneeparution, PDO::PARAM_STR);
                    $stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
                    $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
                    $stmt->bindValue(':dateajout', $dateajout, PDO::PARAM_STR);


                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $stmt->execute();


                    echo "<h5>Le livre " .$titre ." a été ajouté avec succès !</h5>";

                }
                
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