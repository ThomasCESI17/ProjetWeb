<?php

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: http://cesi.local/Connexion');
    exit();
}

$ID_obj=$_GET['ID'];

$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT Disponible FROM objet WHERE ID = ?");
$rqsql->bindValue( 1, $ID_obj, PDO::PARAM_INT);
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_OBJ);

