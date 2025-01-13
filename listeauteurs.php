<!DOCTYPE html>

<html lang="fr">

<head>

  <title>DS surprise</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <?php
        echo "<h1> Ajout Auteur <h1>";

        
        /* L'entrée chercher est vide = le formulaire n'a pas été submit=posté, on affiche le formulaire */
            echo '
                <form action="" method = "post" ">
                nom: <input name="nom" type="text" size ="30"">
                prenom: <input name="prenom" type="text" size ="30"">
                <input type="submit" name="Ajouter"  value="Ajouter">
                </form>';
        
        if (isset($_POST['Ajouter']))
        {
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];

            require_once('connexion-bdrive.php');
            $stmt = $connexion->prepare("INSERT INTO auteur(nom, prenom) VALUE (:nom, :prenom)");

            $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR);


            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();


            echo "<h5> Ajout de l'auteur ".$nom ." " .$prenom. " completé <h5>";

            //On aurait put mettre un seul echo mais bon ca fais plus propre//

        }


        echo "<h3> Liste Auteur <h3>";

        require_once('connexion-bdrive.php');
        $stmt = $connexion->prepare("SELECT noauteur, nom, prenom FROM auteur");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();

        while($enregistrement = $stmt->fetch())
        {
            echo '<br>';
            echo '<h5>',"<a href='detail.php?noauteur=".$enregistrement->noauteur."'>".$enregistrement->nom, ' ', ' ', '(', $enregistrement->prenom, ')', "</a>",'</h5>';
        }
                
    ?>

</body>

</html>  