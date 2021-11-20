<?php

$id_obj="%".$_GET['id_obj']."%";
$nom_obj="%".$_GET['nom_obj']."%";
$salle="%".$_GET['salle']."%";
$cat="%".$_GET['cat']."%";
$tri=$_GET['tri'];
$id_empr=$_GET['id_empr'];
$type_rech=$_GET['rech'];

$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if($type_rech==0){
    $rqsql=$dbh->prepare("SELECT ID, ID_obj, Nom_obj, Salle FROM annuaire WHERE ID_obj LIKE ? AND Nom_obj LIKE ? AND Salle LIKE ? AND Categorie LIKE ? AND ID_emprunteur = ? AND Date_rendu = '0000-00-00' ORDER BY ?;");
}
if($type_rech==1){
    $rqsql=$dbh->prepare("SELECT ID, ID_obj, Nom_obj, Salle FROM annuaire WHERE ID_obj LIKE ? AND Nom_obj LIKE ? AND Salle LIKE ? AND Categorie LIKE ? AND ID_emprunteur <> ? AND Date_rendu = '0000-00-00' ORDER BY ?");
}

$rqsql->bindValue( 1, $id_obj, PDO::PARAM_STR);
$rqsql->bindValue( 2, $nom_obj, PDO::PARAM_STR);
$rqsql->bindValue( 3, $salle, PDO::PARAM_STR);
$rqsql->bindValue( 4, $cat, PDO::PARAM_STR);
$rqsql->bindValue( 5, $id_empr, PDO::PARAM_STR);
$rqsql->bindValue( 6, $tri, PDO::PARAM_STR);
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_OBJ);

echo json_encode($rte);



?>

