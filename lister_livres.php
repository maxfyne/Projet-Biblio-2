<?php
// Démarrage de la session, instruction a placer en tête de script
session_start();
?>
<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Accueil</title>

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
        <div class="col-sm-9" style="background-color:lavender;"><br>


        </div>


        <?php
            include 'identification.php';
        ?>

        </div>
    </div>
</body>

</html>  