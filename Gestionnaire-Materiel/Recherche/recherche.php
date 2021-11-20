<?php

$id="%".$_GET['id']."%";
$nom="%".$_GET['nom']."%";
$salle="%".$_GET['salle']."%";
$cat="%".$_GET['cat']."%";
$dispo="%".$_GET['dispo']."%";
$tri=$_GET['tri'];

$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT ID, Nom, Salle, Disponible, Quantite_Dispo, ID_photo FROM inventaire WHERE ID LIKE ? AND Nom LIKE ? AND Salle LIKE ? AND Categorie LIKE ? AND Disponible LIKE ? AND Etat != 'Rebut' ORDER BY ?");
$rqsql->bindValue( 1, $id, PDO::PARAM_STR);
$rqsql->bindValue( 2, $nom, PDO::PARAM_STR);
$rqsql->bindValue( 3, $salle, PDO::PARAM_STR);
$rqsql->bindValue( 4, $cat, PDO::PARAM_STR);
$rqsql->bindValue( 5, $dispo, PDO::PARAM_STR);
$rqsql->bindValue( 6, $tri, PDO::PARAM_STR);
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_OBJ);

echo json_encode($rte);



?>

