<?php

$nom="%".$_GET['nom']."%";
$salle="%".$_GET['salle']."%";
$cat="%".$_GET['cat']."%";
$tri=$_GET['tri'];

$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT Nom_obj, Categorie, Salle, Date_empreint, Emprunteur, Rapporteur, Dernier_utilisateur FROM annuaire WHERE Nom_obj LIKE ? AND Salle LIKE ? AND Categorie LIKE ? ORDER BY ?");
$rqsql->bindValue( 1, $nom, PDO::PARAM_STR);
$rqsql->bindValue( 2, $salle, PDO::PARAM_STR);
$rqsql->bindValue( 3, $cat, PDO::PARAM_STR);
$rqsql->bindValue( 4, $tri, PDO::PARAM_STR);
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_OBJ);

echo json_encode($rte);



?>

