<!DOCTYPE html>
<html lang="fr">

<head>

  <title>1er php</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <?php


    $colors = array("red", "green", "blue", "yellow");
    foreach ($colors as $value) {
        echo "$value <br>";
    }




    $couleur = "rouge";
    switch($couleur) {
        case "rouge" || "pourpre":
            echo "Choix de la couleur rouge"; break;
        case "verte":
            echo "Choix de la couleur verte"; break;
        default:
            echo "Autres choix!";
        }
    echo "<br>";





    
    $x = 1;
    while($x <= 5) {
        echo "The number is: $x <br>";
        $x++;
    }




    $message = "Ca va ? ";
    $prenom = "Jean ";
    $message.=$prenom;
    $nom ="bon ";

        echo "<h1>" .$message.$nom. "</h1>";





    $nb = 8;
    if ($nb < 3)
        echo "Trop court ";
    else {
        echo "C'est bien ";
        echo "car c'est $nb ";
    }

    ?>
</body>

</html>