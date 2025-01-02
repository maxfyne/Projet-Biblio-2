<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Requete</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

  <?php

  require_once('connexion.php');

  $stmt = $connexion->prepare("SELECT * FROM agent where codePostal=33000");
  $stmt->setFetchMode(PDO::FETCH_OBJ);
  $stmt->execute();

  echo("<table>");
  while($enregistrement = $stmt->fetch())
  {
    echo '<tr><td>', $enregistrement->nom, '</td><td>', $enregistrement->prenom,'</td><td>', $enregistrement->adresse1,'</td></tr>';
  }
  echo("</table>")

  ?>


</body>

</html>