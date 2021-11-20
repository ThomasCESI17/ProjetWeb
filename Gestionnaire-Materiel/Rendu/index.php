<?php

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: '. $_SERVER['DOCUMENT_ROOT'] .'/Connexion');
    exit();
}

if($_GET['ID_obj']!=NULL){
  $id_obj=$_GET['ID_obj'];
} else {
  $id_obj = "";
}

include($_SERVER['DOCUMENT_ROOT'] . '/Gestionnaire-Materiel/assets/element/headglobale.html');

$headerpage = './header'.$_COOKIE['qualification'].'.html';

include $headerpage;

echo '<section class="col-12">
<form action="" class="row card"  onload="get_obj_emprunter('.$_SESSION['ID'].');">
    <div class="card-body">
    <h1 class="" card-title">Rechercher un Matériel</h1>
<hr class="hr1">
    <div class="card-text row">  
      <div class="col-12 d-flex justify-content-center">
        <div class="btn-group btn-group-toggle form-group " data-toggle="buttons">
            <label class="btn btn-secondary active">
              <input type="radio" value="emprunteur" name="rapporteur" id="option1" autocomplete="off" checked onclick="get_obj_emprunter('.$_SESSION['ID'].')">
              Mes Emprunts
            </label>
            <label class="btn btn-secondary">
              <input type="radio" value="autre" name="rapporteur" id="option2" autocomplete="off" onclick="get_obj_emprunter('.$_SESSION['ID'].')"> 	
              Autre
            </label>
        </div>
      </div>
      <div class="form-group row col-md-4 col-12">
        <label for="id" class="col-md-4 col-9 col-form-label text-md-right">ID</label>
        <div class="col-md-8 col-9">
          <input type="number" class="form-control" id="id_obj" name="id_obj" aria-describedby="emailHelp" placeholder="Entrer ID" onkeyup="get_obj_emprunter('.$_SESSION['ID'].');" onclick="get_obj_emprunter('.$_SESSION['ID'].');">
        </div>
      </div>
      <div class="form-group row col-md-4 col-12">
        <label for="nom" class="col-md-4 col-9 col-form-label text-md-right">Nom</label>
        <div class="col-md-8 col-9">
          <input type="text" class="form-control" id="nom_obj" name="nom_obj" aria-describedby="emailHelp" placeholder="Entrer Nom" onkeyup="get_obj_emprunter('.$_SESSION['ID'].');" onclick="get_obj_emprunter('.$_SESSION['ID'].');">
        </div>
      </div>
      <div class="form-group row col-md-4 col-12">
        <label class="form-select-label col-md-4 col-9 col-form-label text-md-right" for="salle">Salle</label>
        <div class="col-md-8 col-9">
          <select class="custom-select" id="salle" name="salle" onclick="get_obj_emprunter('.$_SESSION['ID'].');">
              <option value="" selected>... Salle ...</option>
              <option value="1">Salle 1</option>
              <option value="2">Salle 2</option>
              <option value="3">Salle 3</option>
              <option value="4">Salle 4</option>
              <option value="5">Salle 5</option>
              <option value="6">Salle 6</option>
              <option value="7">Salle 7</option>
              <option value="8">Salle 8</option>
              <option value="9">Salle 9</option>
              <option value="10">Bureaux</option>
              <option value="11">Réunion</option>
              <option value="12">Amphi</option>
          </select>
        </div>
      </div>
      <div class="form-group row col-md-4 col-12">
        <label class="form-select-label col-md-4 col-9 col-form-label text-md-right" for="categorie">Catégorie</label>
        <div class="col-md-8 col-9">
          <select class="custom-select" id="categorie" name="categorie" onclick="get_obj_emprunter('.$_SESSION['ID'].');">
              <option value="" selected>- Catégorie -</option>
              <option value="Informatique">Informatique</option>
              <option value="Electronique">Electronique</option>
              <option value="Mécanique">Mécanique</option>
              <option value="Autre">Autre</option>
          </select>
        </div>
      </div>
      <div class="form-group row col-md-4 col-12">
        <label class="form-select-label col-md-4 col-9 col-form-label text-md-right" for="dispo">Disponible</label>
        <div class="col-md-8 col-9">
          <select class="custom-select" id="dispo" name="dispo" onclick="get_obj_emprunter('.$_SESSION['ID'].');">
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
        <input type="radio" value="1" name="visionnage" id="option1" autocomplete="off" checked onclick="get_obj_emprunter('.$_SESSION['ID'].');">
        <i class="fas fa-th"></i>
      </label>
      <label class="btn btn-secondary">
        <input type="radio" value="2" name="visionnage" id="option2" autocomplete="off" onclick="get_obj_emprunter('.$_SESSION['ID'].');">
        <i class="fas fa-list"></i>
      </label>
    </div>
    </div>
    <div class="row col-md-3 col-6">
    <label class="form-select-label col-4 col-form-label text-md-right" for="tri">Trier Par</label>
    <div class="col-8">
      <select class="custom-select" id="tri" name="tri" onclick="get_obj_emprunter('.$_SESSION['ID'].');">
        <option value="Nom" selected>Nom A - Z</option>
        <option value="Nom DESC">Nom Z - A</option>
        <option value="ID">ID</option>
        <option value="Salle">Salle</option>
        <option value="Categorie">Catégorie</option>
      </select>
    </div>
    </div>
    </div>

    <div id="js_result" class="row d-flex justify-content-center">

    </div>

    <div id="modal" class="modal row">
        <div class="modal-content col-md-6 col-11 row">
        <span class="closemodal" onclick="invisible();">✕</span>
        <div id="modal_btn">
            
        </div>

        </div>
    </div>

    <script src="./API_Rendu.js"></script>
    
  </html>';

  include($_SERVER['DOCUMENT_ROOT'] . '/Gestionnaire-Materiel/assets/element/footglobale.html');