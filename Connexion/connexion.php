<?php

$pseudo = $_POST['Pseudo'];
$pwd = $_POST['mdp'];

$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT ID, Pseudo, Qualification FROM membre WHERE Pseudo = ? AND Mdp = ?");
$rqsql->bindValue(1, $pseudo, PDO::PARAM_STR);
$rqsql->bindValue(2, $pwd, PDO::PARAM_STR);
$rqsql->execute();
$rte = $rqsql->fetchAll(PDO::FETCH_ASSOC);

if ($rte == NULL) {
    header('Location: //cesi.local/Connexion/');
    exit();
}

else {
    session_start();

    $_SESSION['ID']=$rte[0]['ID'];
    setcookie('pseudo', $rte[0]['Pseudo'],0, "/");
    setcookie('qualification', $rte[0]['Qualification'],0, "/");

    header('Location: /Gestionnaire-Materiel');
    exit();
}
