<!DOCTYPE html>
<html lang="fr">
<head>
    <title>exophp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <h2>Formulaire HTML</h2>

<form method="get" action="ex1.php">

    <fieldset>
        <legend>Table de multiplication</legend>

        <label for="<br>">Table : </label>
        <input type="text" name="nb"><br><br>

        <input type="submit" name="valid" value="Go!"/>

    </fieldset>
    <input type="submit" value="Envoyer">

</form>
</head>

<body>
    <?php
    $nb=$_GET["nb"]
    ?>
</body>

</html>  