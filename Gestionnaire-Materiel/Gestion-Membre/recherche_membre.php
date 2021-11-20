<?php

$nom="%".$_GET['nom']."%";
$prenom="%".$_GET['prenom']."%";
$tri=$_GET['tri'];

$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT ID, Nom, Prenom, Nombre_emprunt FROM membre WHERE Nom LIKE ? AND Prenom LIKE ? ORDER BY ?");
$rqsql->bindValue( 1, $nom, PDO::PARAM_STR);
$rqsql->bindValue( 2, $prenom, PDO::PARAM_STR);
$rqsql->bindValue( 3, $tri, PDO::PARAM_STR);
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_OBJ);

echo json_encode($rte);



?>

