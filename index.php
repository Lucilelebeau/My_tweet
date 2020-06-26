<?php
include ('controller_index.php');

$foo= NEW Twitter();
if(isset($_POST['email'])){
    $foo->inscription($nom, $prenom, $pseudo, $email, $pass);
    $foo->connection($email, $pass);
}

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
        
    </head>
	<body>
        <div class="container" >
            <div class="titre">
                <img src="image/jaune.jpg" class="logo" alt="logo tweeter académie" height="150px"><br>
                <h1>Se connecter à Tweet Académie</h1>
            </div>
            <form id="form_connexion" method="post">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-xs-12 col-md-9 col-lg-6">
                        <div class="form-group">
                            <p class="alert_msg"><?php if(isset($message)){echo $message;};?></p>
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-xs-12 col-md-9 col-lg-6">
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-xs-12 col-md-9 col-lg-6">
                        <button type="submit" name="btn_connexion" class="btn btn-primary btn-lg btn-block" id="bouton">Se connecter</button><br>
                    </div>
                </div>
                <div class="lien_inscrire">
                    <a href="#" id="myBtn">S'inscrire sur Tweeter Académie</a>
                </div>

            </form>
        </div>


        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                    <div class="container" >
                        <div class="titre">
                            <h2>Créer votre compte</h2>
                        </div>
                        <form id="form_inscription" method="post">
                        <div class="form-group">
                                <label for="firstname">Nom</label>
                                <input type="text" class="form-control form-control" name="firstname">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Prénom</label>
                                <input type="text" class="form-control form-control" name="lastname">
                            </div>
                            <div class="form-group">
                                <label for="pseudo">Pseudo</label>
                                <input type="text" class="form-control form-control" name="pseudo" >
                            </div>

                            <div class="form-group">
                                <label for="email1">Email</label>
                                <input type="email" class="form-control form-control" name="email" >
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" class="form-control form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirm">Confirmer mot de passe</label>
                                <input type="password" class="form-control form-control" name="password_confirm">
                            </div>
                            <div>
                                <button type="submit" name="btn_inscription" class="btn btn-primary btn-lg btn-block" id="bouton_modal">S'inscrire</button><br>
                            </div>

                        </form>
                    </div>
            </div>
        </div>



<script type="text/javascript">
// Get the modal
var modal = document.getElementById("myModal");
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<?php


?>
    </body>
</html>