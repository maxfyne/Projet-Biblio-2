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

            <form class="d-flex" action="Ajoutuser.php" method="post">
                <?php
                if (isset($_SESSION['prenom']))
                {
                    if (!isset($_POST['ajoutuser'])) 
                    {
                        echo '
                            <form action="" method = "post" ">
                            <input type="submit" name="ajoutuser"  value="Ajouter un nouvel utilisateur 🧐">
                            </form>';
                    }
                    if (isset($_POST['ajoutuser'])) 
                    {
                        $_SESSION["cleUser"]=1;
                    }
                }
                ?>
            </form>


            <form class="d-flex" action="Ajoutlivre.php" method="post">
                <?php
                if (isset($_SESSION['prenom']))
                {
                    if (!isset($_POST['ajoutlivre'])) 
                    {
                        echo '
                            <form action="" method = "post" ">
                            <input type="submit" name="ajoutlivre"  value="Ajouter un nouveau livre 📚">
                            </form>';
                    }
                    if (isset($_POST['ajoutlivre'])) 
                    {
                        $_SESSION["cleLivre"]=1;
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