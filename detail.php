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
        include 'barre.php';
    ?>


    <div class="row">
        <div class="col-sm-9" style="background-color:lavender;">
        <br><br>
        <?php
        require_once('connexion-bdrive.php');

        $stmt = $connexion->prepare("SELECT nom, prenom, dateretour, detail, isbn13, anneeparution, photo, titre FROM livre INNER JOIN auteur ON (livre.noauteur = auteur.noauteur) LEFT OUTER JOIN emprunter ON (livre.nolivre = emprunter.nolivre) where livre.nolivre=:nolivre");
        $nolivre = $_GET["nolivre"];
        $stmt->bindValue(":nolivre", $nolivre); // pas de troisième paramètre STR par défaut
        $stmt->setFetchMode(PDO::FETCH_OBJ); // Les résultats retournés par la requête seront traités en 'mode' objet

        $stmt->execute();
        $enregistrement = $stmt->fetch();

        ?>
        <div class="row">
            <div class="col-sm-9">
                <?php
                    echo "Auteur : ".$enregistrement->prenom." ", $enregistrement->nom;
                    echo "<br>";
                    echo "ISBN13 : ".$enregistrement->isbn13; 
                    echo "<br>";
                    echo "Titre : ".$enregistrement->titre." ", $enregistrement->anneeparution;
                    echo "<br>";
                    echo "<br>";
                    echo "Résumé du livre :";
                    echo "<br>";
                    echo $enregistrement->detail;

                    $titre = $enregistrement->titre;
                    $_SESSION["titre"] = $enregistrement->titre;

                ?>
            </div>

            <div class="col-sm-3">
                <img src=".\covers\<?php echo $enregistrement->photo?>" class="d-block w-100">
            </div>

            <!-- panier -->
            <?php
                if (isset($_SESSION["prenom"]))
                {
                    echo '<h5> Disponible </h5>';
                    echo '<form method="POST">';
                    echo '<input type="submit" name="btn-ajoutpanier" " value="Ajouter au panier"></input>';
                    echo '</form>';
                }
                else
                {
                    echo 'Pour pouvoir réserver ce livre connectez-vous !</p>';
                }

                if(!isset($_SESSION['panier']))
                {
                    // Initialisation du panier
                    $_SESSION['panier'] = array();
                }


                if(isset($_POST['btn-ajoutpanier']))
                {
                    array_push($_SESSION['panier'], $nolivre); //Liste des livres dans la variable de session panier
                    echo "Livre ajouté à votre panier";
                }
            ?>
        </div>
    </div>

    <?php
        include 'identification.php';
    ?>
    
</body>

</html>  