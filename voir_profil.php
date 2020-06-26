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

                <div class="col-3 border-right"><br>
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
            
                <?php

                // requete pour le nombre de following et followers 

                try{
                    $bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', '');
                }
                catch(Exception $e){
                    die('Erreur : '.$e->getMessage());
                }
                $reponse = $bdd->query("SELECT COUNT(id_following) AS 'following' FROM following WHERE id_member='$id_member'");
                    while ($donnees = $reponse->fetch()){
                        $nbr_following = $donnees['following'];
                    }
                
                $reponse2 = $bdd->query("SELECT COUNT(id_member) AS 'follower' FROM following WHERE id_following='$id_member'");
                    while ($donnees = $reponse2->fetch()){
                        $nbr_follower = $donnees['follower'];
                    }


                ?>

                <div class="col-6">
                    <br><div class="border-bottom">
                        <h2>Profil de <?php echo $_SESSION['pseudo'];?></h2>
                        <p class="text-secondary font-italic">inscrit depuis le <?php echo $_SESSION['inscription'];?></p>
                        <a href="#">Following <span class="badge"><?php echo $nbr_following ?></span></a><br>
                        <a href="#">Followers <span class="badge"><?php echo $nbr_follower ?></span></a><br>

                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-primary">
                                <input type="radio" name="tweets" id="btn_tweets" autocomplete="off" checked>Vos tweets</a>
                            </label>
                        </div>
                    </div>

                    <div class="affiche">
                        <?php


                        //   affiche les tweets de la personne

                        $sql2 = $bdd->prepare("SELECT * FROM tweet INNER JOIN member USING(id_member) WHERE id_member LIKE '$id_member' ORDER BY date DESC");
				        $sql2->execute();
                        while ($result = $sql2->fetch()){
                            $pseudo = $result['pseudo'];
                            $content = $result['content'];
                            $date = $result['date'];

                            echo '<li class="list-group-item">
                                <div class="d-flex">
                                    <div class="p-2">
                                        <img src="image/avatar.png" alt="avatar membre" height="50px">
                                    </div>
                                    <div class="p-2">
                                        <h3 class="font-weight-bold">'.$pseudo.'</h3>
                                    </div>
                                </div>
                                <p class="text-secondary font-italic">posté le '.$date.'</p>
                                <p >'. $content. '</p>
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <a href="#"><button type="button" class="btn btn-outline-secondary btn-default btn-circle rounded-circle btn-lg"><i class="fa fa-commenting-o"></i></button></a>
                                    </div>
                                    <div class="p-2">
                                        <a href="#"><button type="button" class="btn btn-outline-secondary btn-default btn-circle rounded-circle btn-lg"><i class="fa fa-share"></i></button></a>
                                    </div>
                                
                                </div>
                            </li><br>';
                        }   
                        ?>
                    </div>
                
            

                </div>


                <div class="col-3 border-left">
                    <div>
                        <br><h4>Vos Followers</h4>
                            <div class="list-group">

                                <?php
                                
                                $query = $bdd->prepare("SELECT * FROM following INNER JOIN member USING(id_member) WHERE id_following LIKE '$id_member'");
                                $query->execute();
                                while ($result = $query->fetch()){
                                    $pseudo = $result['pseudo'];
                                    $id_member_f = $result['id_member'];
                                    
                                    echo '<div class="list-group-item list-group-item-action">
                                            <form method="post">'.$pseudo.'&nbsp&nbsp&nbsp
                                                <input name="membreASuivre" type="hidden" value="'.$id_member_f.'">
                                                </form></div>';
                                }
                                ?>
                    </div>

                    <div>
                        <br><h4>Vos Following</h4>
                            <div class="list-group">

                                <?php
                               
                                $query = $bdd->prepare("SELECT * FROM following INNER JOIN member ON member.id_member=following.id_following WHERE following.id_member LIKE '$id_member'");
                                $query->execute();
                                while ($result = $query->fetch()){
                                    $pseudo = $result['pseudo'];
                                    $id_member_f = $result['id_member'];
                                    
                                    echo '<div class="list-group-item list-group-item-action">
                                            <form method="post">'.$pseudo.'&nbsp&nbsp&nbsp
                                                <input name="membreDelete" type="hidden" value="'.$id_member_f.'">
                                                <input name="membreDeletePseudo" type="hidden" value="'.$pseudo.'">
                                                <button type="submit" name="delete" class="btn btn-secondary rounded-circle"><i class="fa fa-trash-o" aria-hidden="true"></i></button></form></div>';
                                }

                                if(isset($_POST['delete'])){
                                    $id_member_un = $_POST['membreDelete'];
                                    $pseudoDelete = $_POST['membreDeletePseudo'];
                                    $sql5 = "DELETE FROM following WHERE id_following='$id_member_un' AND id_member='$id_member'";		
                                    $req = $bdd->prepare($sql5);
                                    $req->execute();
                                    echo '<div class="alert alert-warning" role="alert">
                                            Vous ne suivez plus '. $pseudoDelete. '</div>';
            
                                }
                                ?>
                    </div>
                    
                </div>
            </div>


        </div>
    </body>
</html>