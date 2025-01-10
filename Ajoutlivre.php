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
                <?php
                /*DEBUT DES FORMULAIRES*/
                if (!isset($_POST['Ajouter']))
                { /* L'entrée chercher est vide = le formulaire n'a pas été submit=posté, on affiche le formulaire */
                    echo '
                        <form action="" method = "post" ">
                        Auteur:<input name="nomauteur" type="text" size ="30"">
                        <br>
                        Titre:<input name="titre" type="text" size ="30"">
                        <br>
                        ISBN13:<input name="isbn13" type="text" size ="30"">
                        <br>
                        Année de parution:<input name="anneeP" type="text" size ="30"">
                        <br>
                        Résumé:<input name="resume" type="text" size ="30"">
                        <br>
                        Image:<input name="image" type="text" size ="30"">

                        <input type="submit" name="Ajouter"  value="Ajouter">
                        </form>';
                } 
                else
                /* L'utilisateur a cliqué sur Rechercher, l'entrée chercher <> vide, on traite le formulaire */
                {
                    echo '
                        <form action="" method = "post" ">
                        Auteur:<input name="nomauteur" type="text" size ="30"">
                        <br>
                        Titre:<input name="titre" type="text" size ="30"">
                        <br>
                        ISBN13:<input name="isbn13" type="text" size ="30"">
                        <br>
                        Année de parution:<input name="anneeP" type="text" size ="30"">
                        <br>
                        Résumé:<input name="resume" type="text" size ="30"">
                        <br>
                        Image:<input name="image" type="text" size ="30"">

                        <input type="submit" name="Ajouter"  value="Ajouter">
                        </form>';

                    require_once('connexion-bdrive.php');
                        $stmt = $connexion->prepare("SELECT nolivre, titre, anneeparution FROM livre INNER JOIN auteur ON (livre.noauteur = auteur.noauteur) where auteur.nom=:nomauteur ORDER BY anneeparution");
                        $nomauteur = $_POST["nomauteur"];
    
                        $stmt->bindValue(":nomauteur", $nomauteur);
                        $stmt->setFetchMode(PDO::FETCH_OBJ);
                        $stmt->execute();

                    while($enregistrement = $stmt->fetch())
                    {
                        echo '<br>';
                        echo '<h5>',"<a href='detail.php?nolivre=".$enregistrement->nolivre."'>".$enregistrement->titre, ' ', ' ', '(', $enregistrement->anneeparution, ')', "</a>",'</h5>';
                    }

                }
                ?>
            </form>

        </div>
    </div>

    <?php
        include 'identification.php';
    ?>
    
</body>

</html>  