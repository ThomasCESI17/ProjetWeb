<?php

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: '. $_SERVER['DOCUMENT_ROOT'] .'/Connexion');
    exit();
}

$ID_membre = $_SESSION['ID'];
$pseudo = $_COOKIE['pseudo'];

$ID_obj=$_GET['ID'];

$user = "root";
$pass = "";

$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT Disponible FROM inventaire WHERE ID = ?");
$rqsql->bindValue( 1, $ID_obj, PDO::PARAM_INT);
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_NUM);

if($rte[0][0]==1){

    $rte = null;
    $dbh = null;
    $rqsql = null;

    $dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqsql=$dbh->prepare("UPDATE inventaire SET Disponible=0, Nombre_Emprunt= ((SELECT Nombre_Emprunt FROM inventaire WHERE ID = :id_obj) + 1), Quantite_Dispo=((SELECT Quantite_Dispo FROM inventaire WHERE ID = :id_obj) - 1), Emprunteur = :pseudo WHERE ID = :id_obj");
    $rqsql->bindValue( ':pseudo', $pseudo, PDO::PARAM_STR);
    $rqsql->bindValue( ':id_obj', $ID_obj, PDO::PARAM_INT);
    $rqsql->execute();

    $dbh = null;
    $rqsql = null;

    $dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqsql=$dbh->prepare("INSERT INTO `annuaire` (`ID_obj`, `Nom_Obj`, `Categorie`, `Salle`, `Date_empreint`, `ID_emprunteur`, `Emprunteur`, `Date_rendu`, `ID_rapporteur`, `Rapporteur`, `Dernier_utilisation`, `ID_utilisateur`, `Dernier_utilisateur`) VALUES ( :id_obj, (SELECT Nom FROM inventaire WHERE inventaire.ID = :id_obj), (SELECT Categorie FROM inventaire WHERE inventaire.ID = :id_obj), (SELECT Salle FROM inventaire WHERE inventaire.ID = :id_obj), '".date('Y-m-j')."' , :id_membre, (SELECT Pseudo FROM membre WHERE membre.ID = :id_membre), '0000-00-00', NULL, NULL, NULL, NULL, NULL)");
    $rqsql->bindValue( ':id_obj', $ID_obj, PDO::PARAM_INT);
    $rqsql->bindValue( ':id_membre', $_SESSION['ID'], PDO::PARAM_INT);
    $rqsql->execute();

    $dbh = null;
    $rqsql = null;

    $dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqsql=$dbh->prepare("UPDATE membre SET Nombre_emprunt = (SELECT Nombre_emprunt FROM membre WHERE ID = :id_membre) + 1 WHERE ID = :id_membre");
    $rqsql->bindValue( ':id_membre', $ID_membre, PDO::PARAM_INT);
    $rqsql->execute();

    $dbh = null;
    $rqsql = null;

};

include('http://localhost/Gestionnaire-Materiel/assets/element/headglobale.html');
include('http://localhost/Gestionnaire-Materiel/assets/element/footglobale.html');

header('Location: http://localhost/Gestionnaire-Materiel');
exit();