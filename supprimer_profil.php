<?php
session_start();
$id_member = $_SESSION['id_member'];

?>

<!DOCTYPE html>
<html lang="ZXX">
	<head>
		<meta charset="uft-8">
		<link rel="stylesheet" type="text/css" href="script_connexion.css" />
		<title>Tweet_académie</title>
		<meta name="description" content="Notre tweeter by Cathia, Axel et Lucile" />
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    </head>
	<body>
        <div class="container">
            <div class="row">


                <div class="col-3"><br>
                    <img src="image/bird.webp" class="logo" alt="logo tweeter blue" height="50px"><br>
                    <a class="btn btn-outline-primary btn-lg" href="compte_tweeter.php" role="button"><span class="fa fa-home"></span>&nbspHome</a><br><br>
                    <a class="btn btn-light btn-lg" href="#" role="button"><span class="fa fa-hashtag"></span>&nbspExplorer</a><br><br>
                    
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-light btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-user"></span>&nbspProfil</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="voir_profil.php"><i class="fa fa-pencil fa-eye"></i>&nbspVoir</a>
                            <a class="dropdown-item" href="editer_profil.php"><i class="fa fa-pencil fa-fw"></i>&nbspEditer</a>
                            <a class="dropdown-item" href="supprimer_profil.php" ><i class="fa fa-trash-o fa-fw"></i>&nbspSupprimer</a>


                        </div>
                    </div><br><br>

                    <a class="btn btn-light btn-lg" href="#" role="button"><span class="fa fa-envelope"></span>&nbspMessagerie</a><br><br>
                    <a class="btn btn-light btn-lg" href="#" role="button"><span class="fa fa-cog"></span>&nbspModifier thème</a><br><br>
                    <a class="btn btn-light btn-lg" href="deconnexion.php" role="button"><span class="fa fa-power-off"></span>&nbspDéconnection</a><br><br>
                    <a class="btn btn-primary btn-lg" href="#" role="button">TWEET</a><br>
                </div>


                <div class="col-9">
                    <h2><?php echo $_SESSION['pseudo'];?></h2><br><br>
                    <h4>Vous souhaitez vraiment supprimer votre compte ?</h4><br><br>
                    <form class="suppr_compte" method="post">
                        <a href="compte_tweeter.php"><button type="button" class="btn btn-primary btn-lg">Annuler</button></a>
                        <input type="submit" class="btn btn-secondary btn-lg" name="suppr_compte" value="Confirmer" />

                    </form>


                    <?php
                    $conf = $_POST['suppr_compte'];
                    if(isset($conf)){
                        try{
                            $bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', '');
                        }
                        catch(Exception $e){
                            die('Erreur : '.$e->getMessage());
                        }
                        $reponse = $bdd->query("DELETE FROM member WHERE id_member=$id_member");
                        $donnees = $reponse->fetch();
                        
                        echo '
                        <div class="alert alert-warning" role="alert">
                            Compte supprimer 
                        </div>';
                        header ('location : index.php');
                        session_destroy();
                        
                    }
                    ?>
                </div>

                

            </div>
        </div>
    </body>
</html> 