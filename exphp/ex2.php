<!DOCTYPE html>
<html lang="fr">
<head>
    <title>exophp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php
    $nb = $_GET["nb"];
        echo "<table border = '1'>";
        for ($x = 0; $x <= 10; $x++) {
            $resultat= $nb*$x;
            echo
            "<tr><td> $nb * $x = </td> <td> $resultat </td></tr><br>";
            }
        "</table>";
    ?>
</body>

</html>  