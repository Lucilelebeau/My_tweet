<?php
session_start();

include ('controller_index.php');
$id_member = $_SESSION['id_member'];

try{
    $bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}
$reponse = $bdd->query("SELECT * FROM member WHERE id_member='$id_member'");
    while ($donnees = $reponse->fetch()){
        $_SESSION['lastname'] = $donnees['lastname'];
        $_SESSION['firstname'] = $donnees['firstname'];
        $_SESSION['pseudo'] = $donnees['pseudo'];
        $_SESSION['inscription'] = $donnees['inscription_date'];
    }


//include ('fetch.php');
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
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>


    </head>
	<body>
        <div class="container">
            <div class="row">


                <div class="col-3 border-right"><br>
                    <img src="image/jaune.jpg" class="logo" alt="logo tweeter blue" height="100px"><br>
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


                <div class="col-6">
        
                    <br><h2>Home - Bonjour <?php echo $_SESSION['pseudo'];?></h2><br>
                    
                    <div id="mockTextBox">Quoi de neuf ?
                    </div></br>
                    <form method="post">
                        <textarea id="originalTextBox" name="new_tweet" class="form-control" rows="7" maxlength="140" placeholder="votre tweet"></textarea>
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <div class="col-auto my-1">
                            <input type="submit" name="btn_tweet" class="btn btn-primary" value="Tweet">
                        </div>
                    </form>
               
                    <ul id="actus">
                <?php

                include('news.php');


                
                // afficher les tweets lors de la connexion
                
                
                $sql2 = $bdd->prepare("SELECT * FROM tweet INNER JOIN member USING(id_member) LEFT JOIN following ON tweet.id_member=following.id_following WHERE following.id_member='$id_member' OR tweet.id_member='$id_member' OR member.id_member='$id_member' GROUP BY id_tweet ORDER BY date DESC");
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

                //  ajouter un tweet
                $new_tweet= $_POST['new_tweet'];

                if(isset($_POST['btn_tweet'])){

                    $sql = "INSERT INTO tweet (id_member, content) VALUES('$id_member','$new_tweet')";		
				    $tweet =$bdd->prepare($sql);
                    $tweet->execute();

                    $sql3 = $bdd->prepare("SELECT * FROM tweet INNER JOIN member USING(id_member) INNER JOIN following ON tweet.id_member=following.id_following WHERE following.id_member='$id_member' OR tweet.id_member='$id_member' ORDER BY date DESC");
				    $sql3->execute();
                    while ($result = $sql3->fetch()){
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
                }
                
                ?>

                </ul>

                </div>

                

                <div class="col-3 border-left">
                    <br><h4>Chercher</h4>
                    <!--<div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-search" id="addon-wrapping"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="#  ou  @" name="search_text" id="search_text" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                    <br />
                    <div id="result"></div>
                    </div>-->

                    <form method="post">
                        <div class="form-group">
                            <label for="search">@ ou #</label>
                            <input type="text" name="search" class="form-control" id="search">
                        </div>
                        <button type="submit" name="btn-search" class="btn btn-sm btn-outline-primary">chercher</button>
                    </form>
                    <?php
                    
                    if(isset($_POST['search'])){
                        $search = $_POST['search'];
                    }
                    

                    if(isset($_POST['btn-search'])){
                    echo "<br>Résultat pour : ".$search;
                    $query = $bdd->prepare("SELECT * FROM member WHERE pseudo LIKE '%$search%'");
                    $query->execute();
                        while ($result = $query->fetch()){
                            $pseudo = $result['pseudo'];
                            $id_member_f = $result['id_member'];
                                    
                            echo '<div class="list-group-item list-group-item-action">
                                    <form method="post">'.$pseudo.'&nbsp&nbsp&nbsp
                                        <input name="membreASuivre" type="hidden" value="'.$id_member_f.'">
                                        <input name="membreASuivrePseudo" type="hidden" value="'.$pseudo.'">
                                        <button type="submit" name="ajout" class="btn btn-secondary rounded-circle">+</button></form></div>';
                        }  
                    }
                    
                    if(isset($_POST['ajout'])){
                        $id_member_f = $_POST['membreASuivre'];
                        $pseudo_f = $_POST['membreASuivrePseudo'];
                        $sql5 = "INSERT INTO following (id_member, id_following) VALUES('$id_member','$id_member_f')";		
                        $req =$bdd->prepare($sql5);
                        $req->execute();
                        echo '<div class="alert alert-success" role="alert">
                                Vous suivez '.$pseudo_f.' !</div>';
                    }
                    ?>

                </div>


            </div>
        </div>


<!-- ajax search bar relier à fetch.php-->
<script>
$(document).ready(function(){

    load_data();

    function load_data(query){
        $.ajax({
            url:"fetch.php",
            method:"POST",
            data:{query:query},
            success:function(data){
                        $('#result').html(data);
                    }
        });
    }

    $('#search_text').keyup(function(){
        var search = $(this).val();

        if(search != ''){
            load_data(search);
        }
        else{
            load_data();
        }
    });
});
</script>




    </body>
</html>