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
        include "barre.php";
    ?>

    <div class= 'row'>
        <div class = "col-sm-9" style="background-color:lavender;">

            <h3> Votre panier </h3>

            <?php
                if(!isset($_SESSION['panier']))
                {
                    // Initialisation du panier
                    $_SESSION['panier'] = array();
                }
        
                // Affichage du panier 

                $nb_livresempruntés = count($_SESSION['panier']); 
                $nb_emprunts = (5 - $nb_livresempruntés);
                echo '<h5>(Il vous reste ', $nb_emprunts ,' réservations possibles.)</h5>';
                
                foreach($_SESSION['panier'] as $nolivre)
                {
                    echo '<form method="POST">';
                    require_once('connexion-bdrive.php');
                    $stmt = $connexion->prepare("SELECT titre FROM livre  where nolivre = $nolivre");
                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $stmt->execute();

                    while($enregistrement = $stmt->fetch())
                    {
                    echo $enregistrement->titre;
                    }

                    echo '<input type="submit" id="contenupanier" name="annuler" value="suprimer du panier">';
                    echo '</form>';
                } 
          
                if (empty($_SESSION['panier']))
                {
                    echo 'Votre panier est vide';
                } 
        
                else 
                {
                    echo 'Votre panier se remplie';
                    echo '<form method="POST">';
                    foreach($_SESSION['panier'] as $nolivre) 
                    {
                        echo '<input type="hidden" name="nolivre[]" value="'. $nolivre .'">';
                    }
                    echo '<input type="submit" name="valider" value="Valider le panier">';
                    echo '</form>';
                }

                if(isset($_POST['annuler']))
                {
                    unset($_SESSION['panier'][array_search($_SESSION['panier'][$id], $_SESSION['panier'])]);
                    sort($_SESSION['panier']);
                    header("refresh: 0");
                }

                if(isset($_POST['valider']))
                {
                    require_once('connexion-bdrive.php');
                    $mel = $_SESSION['mel'];
                    $dateemprunt = date("Y-m-d");
      
                    // Boucle sur tous les livres dans le panier
                    foreach($_SESSION['panier'] as $nolivre) 
                    {
                        // trim nous permet d'enlever les espaces blancs
                        $nolivre = trim($nolivre);
      
                        echo "Tentative d'ajout du livre : " .$_SESSION["titre"] ."<br>";
      
                        // Essayer de completer la base de donnée emprunter
                        try 
                        {
                            $stmt = $connexion->prepare("INSERT INTO emprunter(mel, nolivre, dateemprunt) VALUES (:mel, :nolivre, :dateemprunt)");
                            $stmt->bindValue(':mel', $mel, PDO::PARAM_STR);
                            $stmt->bindValue(':nolivre', $nolivre, PDO::PARAM_STR);
                            $stmt->bindValue(':dateemprunt', $dateemprunt, PDO::PARAM_STR);
                            $stmt->execute();
                            echo "Le livre " .$_SESSION["titre"] ." a été ajouté avec succès. <br>";
                        } 
                
                        catch (PDOException $e) // Que faire en cas d'erreur tout en nous donnant l'erreur
                        {
                            echo "Erreur lors de l'ajout du livre".$_SESSION["titre"] .": " . $e->getMessage() ."<br>";
                        }
                    }
                    // Vider le panier après la validation
                    $_SESSION['panier'] = array();
                    
                    exit;
                }
            ?>
        </div>

        <?php
            include 'identification.php';
        ?>
    
    </div>

</div>
</body>
</html> 