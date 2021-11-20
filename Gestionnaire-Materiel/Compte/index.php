<?php

//$page = $_GET['page'];

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: '. $_SERVER['DOCUMENT_ROOT'] .'/Connexion');
    exit();
}

include($_SERVER['DOCUMENT_ROOT'] . '/Gestionnaire-Materiel/assets/element/headglobale.html');

$headerpage = './header'.$_COOKIE['qualification'].'.html';

include $headerpage;

$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=rattrapage', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rqsql=$dbh->prepare("SELECT Nom, Prenom, Pseudo, Mdp, Mail, Nombre_emprunt FROM membre WHERE ID = ?");
$rqsql->bindValue( 1, $_SESSION['ID'], PDO::PARAM_STR);
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_ASSOC);

if($_COOKIE['qualification']==0) {
    $qualimembre = "Administrateur";
} elseif($_COOKIE['qualification']==1) {
    $qualimembre = "Tuteur";
} else {
    $qualimembre = "Elève";
}

echo '
<section class="row">
<div class="col-12 row d-flex justify-content-between">
<div class="col-8 col-lg-3 col-md-5">
  <h3>Compte '. $qualimembre .'</h3>
</div>
<div class="col-1 text-center align-self-center">
    <i class="fas fa-user-edit"></i>
</div>
</div>
<section class="row">
<h5 class="col-12 text-center">'. $rte[0]['Nom'] ." ". $rte[0]['Prenom'] .'</h5>
<div class="col-lg-6 col-md-7 col-12">
    <p>
        Pseudo : '. $rte[0]['Pseudo'] .'
    </p>
    <p>
        Mot de passe : ********
    </p>
    <p>
        Mail : '. $rte[0]['Mail']  .'
    </p>
    <p>
        Nombre d'."'".'emprunt : '. $rte[0]['Nombre_emprunt']  .'
    </p>
    
    </div>
        
</section>';

include($_SERVER['DOCUMENT_ROOT'] . '/Gestionnaire-Materiel/assets/element/footglobale.html');