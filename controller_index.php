<?php

/* injection charactères speciaux et injection sql */

class Twitter{

	private $session;

	function __construct(){
		session_start();
		global $connect;
		$servername = '127.0.0.1';
        $username = 'root';
        $password = '';

        try{
            $connect = new PDO("mysql:host=$servername;dbname=common-database", $username, $password);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
	}

	function inscription($nom,$prenom,$pseudo,$email,$pass){

		global $connect;
		if(isset($_POST['firstname'])){
			$nom = $_POST['firstname'];
			$prenom = $_POST['lastname'];
			$pseudo = $_POST['pseudo'];
			$email = $_POST['email'];
 			$pass = $_POST['password'];	
 			$passconf=$_POST['password_confirm'];
		}
		

		if (isset($nom,$prenom,$pseudo,$email,$pass,$passconf)) {
			$reqemail= $connect->prepare("SELECT email FROM member WHERE email LIKE '$email'");
 			$reqemail->execute(array($email));
			$mailexist = $reqemail->rowCount();
				
			if($mailexist == 1){
				echo "Email déjà utilisé";
			}
			if($pseudoexist == 1 ){
				echo "Pseudo déjà utilisé";
			}
			if ($passconf != $pass) {
				echo "Veuillez entrer le même mot de passe dans les 2 champs";
			}

			$reqpseudo= $connect->prepare("SELECT pseudo FROM member WHERE pseudo LIKE '$pseudo'");
 			$reqpseudo->execute(array($peusdo));
			$pseudoexist = $reqpseudo->rowCount();
				
			
			if($passconf == $pass && $pseudoexist == 0) {
				$pass = $pass."vive le projet tweet_academy";
				$pass= hash('ripemd160',$pass);	
				//echo $pass;
				//$formulaire =$connect->prepare("INSERT INTO member(lastname,firstname,pseudo, email, password) VALUES(?, ?, ?, ?, ?)");
				//$formulaire->bind_param("sssss", $prenom, $nom, $pseudo, $email, $pass);
				$sql = "INSERT INTO member(lastname, firstname, pseudo, email, password, inscription_date) VALUES('$prenom','$nom','$pseudo','$email','$pass', NOW())";		
				$formulaire =$connect->prepare($sql);
				$formulaire->execute();
			}
		}
	}

	
	function connection($email,$pass){
        global $connect;
         $email = $_POST['email'];
        $pass = $_POST['password'];    
        $pass = $pass."vive le projet tweet_academy";
        $passe= hash('ripemd160',$pass);
        
         if (isset($email,$pass)) {
             
            global $message;
            $reqpass = $connect->prepare("SELECT id_member FROM member WHERE email = '$email' AND password = '$passe'");
            $reqpass->execute(array($email,$pass));
            $existpass = $reqpass->rowCount();
                if ($existpass == 0) {
                    $message = "Email ou Mot de passe inexistant";
                    return $message;
                }
                if ($existpass == 1) {
                    $reqid_member = $connect->prepare("SELECT id_member FROM member WHERE email LIKE '$email'");
                    $reqid_member->execute();
                    $result = $reqid_member->fetch();
                    $_SESSION['id_member'] = $result['id_member'];
                    $_SESSION['email'] = $email;
            
            
                //header('Location : compte_tweeter.php');
                ?><script type="text/javascript">window.location = "compte_tweeter.php";</script><?php
                //exit;        
            }
        }
    }
}
?>