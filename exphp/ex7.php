<!DOCTYPE html>
<html lang="fr">

<head>

  <title>Code d'Agent</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

<?php

    require_once('connexion.php');

    $stmt = $connexion->prepare("SELECT * FROM agent");
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute();

?>

    <?php
 

        if(!isset($_POST['btnEnvoyer'])) 
         
            echo '
            <form action="" method="post">
            Code agent : <input type="text" name="txtCode"><br>
            <input type="submit" name="btnEnvoyer" value="Envoyer" >
            </form>';
         
        else 
         
        {
            echo '<tr><td>', $_POST["txtCode"],'</td></tr>';
            
        }

    ?>

    <form action="ex7.php" method="post">
        <select name = "">
        </select>
    <input type="submit" name="ok" value="ok">
    </form>


    <?php
        if(isset($_POST['ok']))
            {
                require_once('connexion.php');
                    $activite=$_POST['activite'];
                    echo("<table>");
                    #FAUT FAIRE AU MOINS 3 LIAISONS ENTRE LES TABLES
            }

    ?>

</body>

</html> 