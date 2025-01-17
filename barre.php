<!DOCTYPE html>

<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <div class="row">
        <div class="col-sm-9" style="background-color:lavender;">
        <meta name="viewport" content="width=device-width, initial-scale=1"><h5>Bonjour nous somme actuellement fermé jusqu'à nouvel ordre. Mais il vous ai possible de reserver et retirer vos livre via notre service Bibliodrive !</h5><br>

        <!-- DEBUT NAVBAR -->

            <form class="d-flex" action="panier.php" method="post">
                <?php
                /*DEBUT FORMULAIRE*/
                if (!isset($_POST['panier'])) {
                    echo '
                        <form action="" method = "post" ">
                        <input type="submit" name="panier"  value="🛒 Votre panier">
                        </form>';
                    }
                ?>
            </form>
            <br>
            <form class="d-flex" action="lister_livres.php" method="post">
                <?php
                /*DEBUT FORMULAIRE*/
                if (!isset($_POST['chercher'])) { /* L'entrée chercher est vide = le formulaire n'a pas été submit=posté, on affiche le formulaire */
                    echo '
                        <form action="" method = "post" ">
                        Veullez saisir un nom dauteur ---------------><input name="nomauteur" type="text" size ="30"">
                        <br><br>
                        <input type="submit" name="chercher"  value=" 🔎 Rechercher ">
                        </form>';
                    } 
                else
                /* L'utilisateur a cliqué sur Rechercher, l'entrée chercher <> vide, on traite le formulaire */
                {
                    echo '
                        <form action="" method = "post" ">
                        Veullez saisir un nom dauteur ---------------><input name="nomauteur" type="text"">
                        <br><br>
                        <input type="submit" name="chercher"  value=" 🔎 Rechercher ">
                        </form>';

                    require_once('connexion-bdrive.php');
                        $stmt = $connexion->prepare("SELECT nolivre, titre, anneeparution FROM livre INNER JOIN auteur ON (livre.noauteur = auteur.noauteur) where auteur.nom=:nomauteur ORDER BY anneeparution");
                        $nomauteur = $_POST["nomauteur"];
    
                        $stmt->bindValue(":nomauteur", $nomauteur);
                        $stmt->setFetchMode(PDO::FETCH_OBJ);
                        $stmt->execute();

                    while($enregistrement = $stmt->fetch())
                    {
                        echo '<br>';
                        echo '<h5>',"<a href='detail.php?nolivre=".$enregistrement->nolivre."'>".$enregistrement->titre, ' ', ' ', '(', $enregistrement->anneeparution, ')', "</a>",'</h5>';
                    }

                }
                ?>
            </form>

            <form class="d-flex" action="accueil.php" method="post">
                <?php
                if (!isset($_POST['retouraccueil'])) 
                {
                    echo '
                        <form action="" method = "post" ">
                        <input type="submit" name="retouraccueil"  value="Retour au menu principal 🏡">
                        </form>';
                }
                ?>
                <br>
            </form>

        <!-- FIN NAVBAR -->


        </div> 
        <div class="col-sm-3" style="background-color:lavenderblush;">
            <td><img id = photo src="TTchateau.jpg" alt="Photo chateau de moulinsart de Tintin"></td>
        </div>

        
        

    </div>

</body>

</html>