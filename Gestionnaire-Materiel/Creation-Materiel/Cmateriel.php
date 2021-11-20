<?php

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: '. $_SERVER['DOCUMENT_ROOT'] .'/Connexion');
    exit();
}

$nom = $_POST['Nom'];
$cat = $_POST['categorie'];
$infosfichier = pathinfo($_FILES['image']['name']);
$tmpimg = $_FILES['image']['tmp_name'];

//Ajouté update du nombre d'article

$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("INSERT INTO type_obj (Nom, Categorie) VALUES (?, ?)");
$rqsql->bindValue( 1, $nom, PDO::PARAM_STR);
$rqsql->bindValue( 2, $cat, PDO::PARAM_STR);
$rqsql->execute();

$rqsql = null;
$dbh = null;

$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT * FROM `type_obj` WHERE 1 ORDER BY ID DESC LIMIT 1");
$rqsql->execute();

$rte=$rqsql->fetchAll(PDO::FETCH_NUM);
$id = $rte[0][0];

$fileimg = ('Location: http://localhost/Gestionnaire-Materiel/img/');

move_uploaded_file($tmpimg, $fileimg . $id . '.jpg');

header('Location: http://localhost/Gestionnaire-Materiel');
exit();

