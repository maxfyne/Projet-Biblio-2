<!DOCTYPE html>
<html lang="fr">

<head>

  <title>Formulaire</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>   

    <?php

        require_once('connexion.php');

        $stmt = $connexion->prepare("SELECT * FROM activite");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();

    ?>


    <form action="ex6.php" method="post">
        <select name = "activite">


    <?php
        while($enregistrement = $stmt->fetch())
        {
            echo '<option value = "'.$enregistrement->numero.'">'.$enregistrement->libelle.'</option>';
        }
    ?>


    </select>
    <input type="submit" name="ok" value="ok">
    </form>


    <?php
        if(isset($_POST['ok']))
            {
                require_once('connexion.php');
                    $activite=$_POST['activite'];
                    $stmt2 = $connexion->prepare("SELECT * FROM activite");

                    $stmt2->bindValue(":noAct", $activite);
                    $stmt2->setFetchMode(PDO::FETCH_OBJ);
                    $stmt2->execute();

                    echo("<table>");
                while($enregistrement2 = $stmt2->fetch())
                {
                    echo '<tr><td>'.$enregistrement2->code.'</td><td>'.$enregistrement2->intitule.'</td></tr><br>';;
                }
                echo("</table>");
            }
         
    ?>
</body>

</html> 