<?php

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: '. $_SERVER['DOCUMENT_ROOT'] .'/Connexion');
    exit();
}

$ID_annuaire=$_GET['ID'];
$ID_obj=$_GET['ID_obj'];
$nom_util=$_GET['nom_util'];
$pre_util=$_GET['pre_util'];
$date_util=$_GET['date_util'];
$pseudo_rapp=$_COOKIE['pseudo'];
$etat=$_GET['etat'];


$user = "root";
$pass = "";

$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT ID, Pseudo FROM membre WHERE Nom = ? AND Prenom = ?");
$rqsql->bindValue( 1, $nom_util, PDO::PARAM_STR);
$rqsql->bindValue( 2, $pre_util, PDO::PARAM_STR);
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_NUM);

$id_util = $rte[0][0];
$pseudo_util = $rte[0][1];

$rte = null;
$dbh = null;
$rqsql = null;

$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("UPDATE annuaire SET Date_rendu = '". date('Y-m-j') ."', ID_rapporteur = ?, Rapporteur = ?, Dernier_utilisation = ?, ID_utilisateur = ?, Dernier_utilisateur = ? WHERE ID = ?");
$rqsql->bindValue( 1, $_SESSION['ID'], PDO::PARAM_INT);
$rqsql->bindValue( 2, $pseudo_rapp, PDO::PARAM_STR);
$rqsql->bindValue( 3, $date_util, PDO::PARAM_STR);
$rqsql->bindValue( 4, $id_util, PDO::PARAM_INT);
$rqsql->bindValue( 5, $pseudo_util, PDO::PARAM_STR);
$rqsql->bindValue( 6, $ID_annuaire, PDO::PARAM_INT);
$rqsql->execute();

$dbh = null;
$rqsql = null;

$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("UPDATE inventaire SET Disponible=1, Rapporteur=:rapp, Dernier_Utilisateur=:der_util, Quantite_Dispo=((SELECT Quantite_Dispo FROM inventaire WHERE ID = :id_obj)+1), Etat=:etat WHERE ID = :id_obj");
$rqsql->bindValue( ':id_obj', $ID_obj, PDO::PARAM_INT);
$rqsql->bindValue( ':rapp', $pseudo_rapp, PDO::PARAM_STR);
$rqsql->bindValue( ':der_util', $pseudo_util, PDO::PARAM_STR);
$rqsql->bindValue( ':etat', $etat, PDO::PARAM_STR);
$rqsql->execute();

$dbh = null;
$rqsql = null;

header('Location: http://localhost/Gestionnaire-Materiel');
exit();