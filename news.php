<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=common-database;charset=utf8', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

$sql2 = $bdd->prepare("SELECT * FROM tweet INNER JOIN member USING(id_member) WHERE id_member LIKE '$id_member' ORDER BY date DESC");
$sql2->execute();


?>