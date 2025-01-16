<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="col-sm-3" style="background-color:lavenderblush;">
<?php


require_once 'connexion-bdrive.php';
if (isset($_SESSION['prenom'])) 
{   // On vérifie si l'utilisateur est connecté
    echo '<h4>Connexion réussie ! Bienvenue ' . $_SESSION['prenom'] . '</h4>';
    echo '<form action="" method="post">';
    echo '<input type="submit" name="btnSeDeconnecter" value="Se déconnecter 👋​">';
    echo '</form>';

    if (isset($_POST['btnSeDeconnecter'])) 
    {
        session_unset(); //nous redirige vers le meme page mais cette fois ci sans les variables de seesions qu'on aura effacer juste au dessus
        header('Location: accueil.php'); 
    }

    if ($_SESSION["profil"] == "admin") // On vérifie si l'utilisateur est un administrateur
    {
        echo '
        <br><br>
        <form class="d-flex" action="Ajoutlivre.php" method="post"> 
        <input type="submit" name="test" value="⚠️ PASSEZ EN MODE ADMIN ⚠️">
        </form>';
    }
} 
else 
{
    /*DEBUT FORMULAIRE*/
    if (!isset($_POST['btnSeConnecter']) or (isset($_SESSION['prenom'])))
        { /* L'entrée btnSeConnecter est vide = le formulaire n'a pas été submit=posté, on affiche le formulaire */
        echo '
            <form action="" method = "post" ">
            <br><br>
            Mel: <input name="mel" type="text" size ="30"">
            <br><br>
            Mot de passe: <input name="motdepasse" type="text" size ="30"">
            <br><br>
            <input type="submit" name="btnSeConnecter"  value="Se connecter">
            </form>';
    }
    else 
    {/* L'utilisateur a cliqué sur Se connecter, l'entrée btnSeConnecter <> vide, on traite le formulaire */
            
        // Bouton de connection
        require_once 'connexion-bdrive.php';
        $mel = $_POST['mel'];
        $motdepasse = $_POST['motdepasse'];

        // variable de session
        $_SESSION["mel"] = $mel;

        $stmt = $connexion->prepare("SELECT * FROM utilisateur where mel=:mel AND motdepasse=:motdepasse");
        $stmt->bindValue(":mel", $mel); // pas de troisième paramètre STR par défaut
        $stmt->bindValue(":motdepasse", $motdepasse); // de meme
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        // Les résultats retournés par la requête seront traités en 'mode' objet

        $stmt->execute();
        $enregistrement = $stmt->fetch(); // boucle while inutile

        if ($enregistrement) 
        {
            echo '<h4>Connexion réussie ! Bienvenue '.$enregistrement->prenom.'</h4>';

            // variable de session 
            $prenom = $enregistrement->prenom;
            $nom = $enregistrement->nom;
            $profil = $enregistrement->profil;
            $_SESSION["prenom"] = $enregistrement->prenom;
            $_SESSION["nom"] = $enregistrement->nom;
            $_SESSION["profil"] = $enregistrement->profil;


        }
        else 
        {
            echo "Echec à la connexion.";
        }               
        // Bouton de déconnexion
        if (!isset($_POST['btnSeDeconnecter'])) 
        {
            echo '
                <form action="" method = "post" ">
                <input type="submit" name="btnSeDeconnecter" value="Se déconnecter 👋​">
                </form>';
                    
        // Traitement de la déconnexion
            if (isset($_POST['btnSeDeconnecter'])) 
            {
                session_unset(); // Supprime toutes les variables de session
                echo '<h4>Vous êtes déconnecté.</h4>';
            }
        }
        
        if ($_SESSION["profil"] == "admin") // On vérifie si l'utilisateur est un administrateur
        {
            echo '
            <br><br>
            <form class="d-flex" action="Ajoutlivre.php" method="post"> 
            <input type="submit" name="test" value="⚠️ PASSEZ EN MODE ADMIN ⚠️">
            </form>';
        }
    }
    

    /*FIN FORMULAIRE*/
}
?>
</form>
</body>
</html>