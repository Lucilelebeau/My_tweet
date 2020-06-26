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
                        <a class="dropdown-item" href="supprimer_profil.php"><i class="fa fa-trash-o fa-fw"></i>&nbspSupprimer</a>
                    </div>
                </div><br><br>

                    <a class="btn btn-light btn-lg" href="#" role="button"><span class="fa fa-envelope"></span>&nbspMessagerie</a><br><br>
                    <a class="btn btn-light btn-lg" href="#" role="button"><span class="fa fa-cog"></span>&nbspModifier thème</a><br><br>
                    <a class="btn btn-light btn-lg" href="deconnexion.php" role="button"><span class="fa fa-power-off"></span>&nbspDéconnection</a><br><br>
                    <a class="btn btn-primary btn-lg" href="#" role="button">TWEET</a><br>
                </div>


                <div class="col-9">
                    <div class="container" >
                        <div class="titre">
                        <h2>Mon compte - <?php echo $_SESSION['pseudo'];?></h2>
                        </div>
                        <form id="form_inscription" method="post">
                        <div class="form-group">
                                <label for="firstname">Nom</label>
                                <input type="text" class="form-control form-control" name="lastname" value="<?php echo $_SESSION['lastname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Prénom</label>
                                <input type="text" class="form-control form-control" name="firstname" value="<?php echo $_SESSION['firstname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="pseudo">Pseudo</label>
                                <input type="text" class="form-control form-control" name="pseudo" value="<?php echo $_SESSION['pseudo'];?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email1">Email</label>
                                <input type="email" class="form-control form-control" name="email" value="<?php echo $_SESSION['email'];?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" class="form-control form-control" name="password" >
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary btn-lg" name="modifier_profil" value="Modifier" />
                            </div>

                        </form>
                    </div>


                    <?php
                    $lastname = $_POST['lastname'];
                    $firstname = $_POST['firstname'];
                    $pseudo = $_POST['pseudo'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                
                    $modif = $_POST['modifier_profil'];
                    if(isset($modif)){
                        try{
                            $bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', '');
                        }
                        catch(Exception $e){
                            die('Erreur : '.$e->getMessage());
                        }
                        $reponse = $bdd->query("UPDATE member SET lastname='$lastname', firstname='$firstname', pseudo='$pseudo', email='$email' WHERE id_member=$id_member");
                        $donnees = $reponse->fetch();

                        //$reponse = $bdd->query("SELECT * FROM member WHERE id_member=$id_member");
                        //while ($donnees = $reponse->fetch()){
                         //   $lastname = $donnees['id_perso'];

                        //}
                        
                        //$_SESSION['lastname']= $lastname;
                        //$_SESSION['pseudo']= $pseudo;


                        echo '
                            <br><div class="alert alert-success" role="alert">
                                Compte modifié !
                            </div>';
                    }
                ?>

                </div>
            </div>
        </div>
    </body>
</html>