<?php

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: '. $_SERVER['DOCUMENT_ROOT'] . '/Connexion');
    exit();
}

include('http://localhost/Gestionnaire-Materiel/assets/element/headglobale.html');

$ID_typeobj = $_GET["categorie"];
$caract = $_GET['caract'];
$prix = $_GET['Prix'];
$salle = $_GET['salle'];
$n = $_GET['n'];

$user = "root";
$pass = "";

$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT Nom, Categorie FROM type_obj WHERE ID = ?");
$rqsql->bindValue( 1, $ID_typeobj, PDO::PARAM_STR);
$rqsql->execute();

$rte=$rqsql->fetchAll(PDO::FETCH_NUM);
$nom = $rte[0][0];
$cat = $rte[0][1];

$nom_obj = $nom ." ". $caract;
echo $nom_obj;

$rqsql = null;
$dbh = null;

//Ajouté update du nombre d'article

for ( $i=0; $i<$n; $i++ ) {
  $dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $rqsql=$dbh->prepare("INSERT INTO inventaire (Nom, Prix, Salle, Categorie, Date_ajout, ID_photo) VALUES (?, ?, ?, ?, '".date('Y-m-j')."', ?)");
  $rqsql->bindValue( 1, $nom_obj, PDO::PARAM_STR);
  $rqsql->bindValue( 2, $prix, PDO::PARAM_STR);
  $rqsql->bindValue( 3, $salle, PDO::PARAM_INT);
  $rqsql->bindValue( 4, $cat, PDO::PARAM_STR);
  $rqsql->bindValue( 5, $ID_typeobj, PDO::PARAM_STR);
  $rqsql->execute();

  $rqsql = null;
  $dbh = null;

}

$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT Quantite, Quantite_Dispo FROM inventaire WHERE Nom = ? LIMIT 1");
$rqsql->bindValue( 1, $nom_obj, PDO::PARAM_STR);
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_NUM);

$quantite = $rte[0][0];

$quantite_dispo = $rte[0][1];

if($rte[0][0]=!0) {
  $quantite = $quantite + $n ;
  $quantite_dispo = $quantite_dispo + $n;
}
else {
  $quantite = $n;
  $quantite_dispo = $n;
}


$rqsql = null;
$dbh = null;

$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("UPDATE inventaire SET Quantite=?, Quantite_Dispo=? WHERE Nom = ?");
$rqsql->bindValue( 1, $quantite, PDO::PARAM_INT);
$rqsql->bindValue( 2, $quantite_dispo, PDO::PARAM_INT);
$rqsql->bindValue( 3, $nom_obj, PDO::PARAM_STR);
$rqsql->execute();

include('http://localhost/Gestionnaire-Materiel/assets/element/footglobale.html');

header('Location: http://localhost/Gestionnaire-Materiel');
exit();