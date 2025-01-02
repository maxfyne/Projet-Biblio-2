<!DOCTYPE html>
<html lang="fr">

<head>

  <title>Formulaire</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <?php
 

        if(!isset($_POST['btnEnvoyer'])) 
         
            echo '
            <form action="" method="post">
            Nom : <input type="text" name="txtNom"><br>
            Prenom : <input type="text" name="txtPrenom"><br>
            Adresse : <input type="text" name="txtAdresse"><br>
            <input type="submit" name="btnEnvoyer" value="Envoyer" >
            </form>';
         
        else 
         
        {
            echo '<tr><td>', $_POST["txtNom"], ' |  </td><td>', $_POST["txtPrenom"],' | </td><td>', $_POST["txtAdresse"],'</td></tr>';
            
        }

    ?>

</body>

</html> 