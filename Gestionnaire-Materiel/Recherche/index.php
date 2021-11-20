<?php

$nom = $_GET['nom'];
$cat = $_GET['cat'];
$salle = $_GET['salle'];

$tabcat = array(
  0  => "",
  1  => "",
  2  => "",
  3 => "",
  4 => "",
);

$tabsalle = array(
  0  => "",
  1  => "",
  2  => "",
  3 => "",
  4 => "",
  5  => "",
  6  => "",
  7  => "",
  8 => "",
  9 => "",
  10  => "",
  11 => "",
  12 => "",
  13 => "",
  14 => "",
);

$tabcat[$cat]="selected";
$tabsalle[$salle]="selected";

//Pour le choix des catégorie et salle faire un tableau avec des valeurs nuls et changer la valeur correspondant en " selected" afin de changer la valeur selectionner

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: '. $_SERVER['DOCUMENT_ROOT'] .'/Connexion');
    exit();
}

include($_SERVER['DOCUMENT_ROOT'] . '/Gestionnaire-Materiel/assets/element/headglobale.html');

$headerpage = './header'.$_COOKIE['qualification'].'.html';

include $headerpage;

include './recherche.html';

echo '      <section class="col-12">
<form class="card">
<div class="card-body">
  <div>
  <h1 class="col-12 card-title">Rechercher un Matériel</h1>
  <hr class="hr1">
  </div>
  <div class="card-text row">  
    <div class="form-group row col-md-4 col-12">
      <label for="id" class="col-md-4 col-9 col-form-label text-md-right">ID</label>
      <div class="col-md-8 col-9">
        <input type="number" class="form-control" id="id" name="id" aria-describedby="emailHelp" placeholder="Entrer ID" onkeyup="get_obj();" onclick="get_obj();">
      </div>
    </div>
    <div class="form-group row col-md-4 col-12">
      <label for="nom" class="col-md-4 col-9 col-form-label text-md-right">Nom</label>
      <div class="col-md-8 col-9">
        <input type="text" value="'. $nom .'" class="form-control" id="nom" name="nom" aria-describedby="emailHelp" placeholder="Entrer Nom" onkeyup="get_obj();" onclick="get_obj();">
      </div>
    </div>
    <div class="form-group row col-md-4 col-12">
      <label class="form-select-label col-md-4 col-9 col-form-label text-md-right" for="salle">Salle</label>
      <div class="col-md-8 col-9">
        <select class="custom-select" id="salle" name="salle" onclick="get_obj();">
          <option value="" ' . $tabsalle[0] .'>... Salle ...</option>
          <option value="1" ' . $tabsalle[1] .'>Salle 1</option>
          <option value="2" ' . $tabsalle[2] .'>Salle 2</option>
          <option value="3" ' . $tabsalle[3] .'>Salle 3</option>
          <option value="4" ' . $tabsalle[4] .'>Salle 4</option>
          <option value="5" ' . $tabsalle[5] .'>Salle 5</option>
          <option value="6" ' . $tabsalle[6] .'>Salle 6</option>
          <option value="7" ' . $tabsalle[7] .'>Salle 7</option>
          <option value="8" ' . $tabsalle[8] .'>Salle 8</option>
          <option value="9" ' . $tabsalle[9] .'>Salle 9</option>
          <option value="10" ' . $tabsalle[10] .'>Bureaux</option>
          <option value="11" ' . $tabsalle[11] .'>Réunion</option>
          <option value="12" ' . $tabsalle[12] .'>Amphi</option>
          <option value="12" ' . $tabsalle[13] .'>Amphi</option>
          <option value="12" ' . $tabsalle[14] .'>Amphi</option>
        </select>
      </div>
    </div>
    <div class="form-group row col-md-4 col-12">
      <label class="form-select-label col-md-4 col-9 col-form-label text-md-right" for="categorie">Catégorie</label>
      <div class="col-md-8 col-9">
        <select class="custom-select" id="categorie" name="categorie" onclick="get_obj();">
          <option value="" ' . $tabcat[0] .'>- Catégorie -</option>
          <option value="Informatique" ' . $tabcat[1] .'>Informatique</option>
          <option value="Electronique" ' . $tabcat[2] .'>Electronique</option>
          <option value="Mécanique" ' . $tabcat[3] .'>Mécanique</option>
          <option value="Autre" ' . $tabcat[4] .'>Autre</option>
        </select>
      </div>
    </div>
    <div class="form-group row col-md-4 col-12">
      <label class="form-select-label col-md-4 col-9 col-form-label text-md-right" for="dispo">Disponible</label>
      <div class="col-md-8 col-9">
        <select class="custom-select" id="dispo" name="dispo" onclick="get_obj();">
          <option value="" selected>   </option>
          <option value="0">Oui</option>
          <option value="1">Non</option>
        </select>
      </div>
    </div>
  </div>
</div>
</form>
</section>
<section class="col-12 row">
<div class="col-12">
<h3 class="">Matériel correspondant</h3>
<hr class="hr2">
</div>
<div class="col-12 row d-flex justify-content-between">
<div class="col-3">
  <div class="btn-group btn-group-toggle" data-toggle="buttons">
    <label class="btn btn-secondary active">
      <input type="radio" value="1" name="visionnage" id="option1" autocomplete="off" checked onclick="get_obj()">
      <i class="fas fa-th"></i>
    </label>
    <label class="btn btn-secondary">
      <input type="radio" value="2" name="visionnage" id="option2" autocomplete="off" onclick="get_obj()">
      <i class="fas fa-list"></i>
    </label>
  </div>
</div>
<div class="row col-md-3 col-6">
  <label class="form-select-label col-4 col-form-label text-md-right" for="tri">Trier Par</label>
  <div class="col-8">
    <select class="custom-select" id="tri" name="tri" onclick="get_obj();">
      <option value="Nom" selected>Nom A - Z</option>
      <option value="Nom DESC">Nom Z - A</option>
      <option value="ID">ID</option>
      <option value="Salle">Salle</option>
      <option value="Categorie">Catégorie</option>
      <option value="Nombre_Emprunt DESC">Popularité</option>
    </select>
  </div>
</div>
</div>
<div id="js_result" class="row d-flex justify-content-center">

</div>
</section>
</main>

<!--Pied de Page-->
<footer>

</footer>
</body>

<script src="./API.js"></script>';

include($_SERVER['DOCUMENT_ROOT'] . '/Gestionnaire-Materiel/assets/element/footglobale.html');