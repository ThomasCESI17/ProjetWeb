<?php

$page = $_GET['page'];

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
$rqsql=$dbh->prepare("SELECT Nom, Salle, Categorie, Disponible, Emprunteur, Rapporteur, Dernier_Utilisateur, Quantite, Quantite_Dispo, Etat, Nombre_Emprunt, Date_ajout, ID_photo FROM inventaire WHERE ID = ?");
$rqsql->bindValue( 1, $page, PDO::PARAM_STR);
$rqsql->execute();

$rte = $rqsql->fetchAll(PDO::FETCH_ASSOC);

if($rte[0]['Disponible']==1) {
    $dispo = "Oui";
    $linkbtn = '<a href="../Emprunt/?ID='.$page.'" class="btn btn-primary">Emprunter</a>';
} else {
    $dispo = "Non";
    $linkbtn = '<a href="../Rendu/?ID_obj='.$page.'" class="btn btn-primary">Rendre</a>';

}

echo '
<section class="row" style="padding-top: 10px;">
    <div class="card col-lg-10 col-12" id="CardContact">
    <div class="card-body row">
        <h5 class="card-title col-12">Vous souhaitez nous contacter</h5>
        <div class="col-lg-6 col-md-5 col-12">
        <img id="imgloc" src="../img/'.$rte[0]['ID_photo'].'.jpg" alt="" class="w-100">
        </div>
        <div class="col-lg-6 col-md-7 col-12">
        <p>
            Salle '.$rte[0]['Salle'].'
        </p>
        <p>
            Catégorie : '.$rte[0]['Categorie'].'
        </p>
        <p>
            Disponible : '.$dispo.'
        </p>
        <p>
            Emprunteur : '.$rte[0]['Emprunteur'].'
        </p>
        <p>
            Rapporteur : '.$rte[0]['Rapporteur'].'
        </p>
        <p>
            Dernier utilisateur : '.$rte[0]['Dernier_Utilisateur'].'
        </p>
        <p>
            Quantité : '.$rte[0]['Quantite'].'
        </p>
        <p>
            Quantité disponible : '.$rte[0]['Quantite_Dispo'].'
        </p>
        <p>
            Etat : '.$rte[0]['Etat'].'
        </p>
        <p>
            Nombre d'."'".'emprunt : '.$rte[0]['Nombre_Emprunt'].'
        </p>
        <p>
            Date d'."'".'ajout : '.$rte[0]['Date_ajout'].'
        </p>
        '.$linkbtn.'
        </div>
        
    </div>
    </div>
</section>';

include($_SERVER['DOCUMENT_ROOT'] . '/Gestionnaire-Materiel/assets/element/footglobale.html');