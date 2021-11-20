<?php

$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT ID, Nom, Categorie FROM type_obj WHERE 1");
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_OBJ);

echo json_encode($rte);



?>

