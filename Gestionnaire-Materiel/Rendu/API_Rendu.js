function get_obj_emprunter(id_rapp) { 
    var rad=document.getElementsByName('visionnage');
    for (var i = 0, length = rad.length; i < length; i++) {
        if (rad[i].checked) {
            // do whatever you want with the checked radio
            affichage = rad[i].value;
        }
    }

    var rad=document.getElementsByName('rapporteur');
    for (var i = 0, length = rad.length; i < length; i++) {
        if (rad[i].checked) {
            // do whatever you want with the checked radio
            rapporteur = rad[i].value;
        }
    }

    console.log(affichage);

    var id_obj = "";
    var nom_obj = "";
    var salle = "";
    var cat = "";
    var tri = "";

    if(document.getElementById('id_obj').value != null) {var id_obj = document.getElementById('id_obj').value;}
    if(document.getElementById('nom_obj').value != null) {var nom_obj = document.getElementById('nom_obj').value;}
    if(document.getElementById('salle').value != null) {var salle = document.getElementById('salle').value;}
    if(document.getElementById('categorie').value != null) {var cat = document.getElementById('categorie').value;}
    if(document.getElementById('tri').value != null) {var tri = document.getElementById('tri').value;}

    var xhr = new XMLHttpRequest();
    if(rapporteur=="emprunteur") {
        xhr.open("GET", "http://localhost/Gestionnaire-Materiel/Rendu/recherche_rapp.php?id_obj=" + id_obj +"&nom_obj=" + nom_obj +"&salle="+ salle +"&cat=" + cat +"&tri=" + tri + "&id_empr=" + id_rapp + "&rech=0", true);
    }
    if(rapporteur=="autre") {
        xhr.open("GET", "http://localhost/Gestionnaire-Materiel/Rendu/recherche_rapp.php?id_obj=" + id_obj +"&nom_obj=" + nom_obj +"&salle="+ salle +"&cat=" + cat +"&tri=" + tri + "&id_empr=" + id_rapp + "&rech=1", true);
    }

    xhr.onload = function()
    {
        var html = '';
        if( xhr.status == 200 ) {
            var response = JSON.parse(xhr.response);
            //var data = response.data;
            console.log(response.length, response);
            if (response.length>0){
                if (affichage ==1){
                    for(let i=0;i<response.length;i++) {
                        current_user = response[i];
                    
                        html += '<article class="col-lg-3 col-md-6">'+
                        '<a href="../Materiel?page='+ current_user.ID_obj +'">'+
                         ' <div class="card cartelement">'+
                          '  <img class="card-img-top" src="../img/'+ current_user.ID_obj +'.jpg" alt="">'+
                           ' <div class="card-body">'+
                            '  <h5 class="card-title">' + current_user.Nom_obj + '</h5>'+
                             ' <p class="card-text">Salle '+ current_user.Salle +'</p>'+
                              '<a class="btn btn-primary" onclick="visible(' + current_user.ID + ',' + current_user.ID_obj + ')">Rendre</a>'+
                            '</div>'+
                          '</div>'+
                        '</a>'+
                    '</article>';
                    }
                }
                if (affichage ==2) {
                    html += '<div class="list-group col-10">';
                    for(let i=0;i<response.length;i++) {
                        current_user = response[i];
                        html += '<div class="list-group-item list-group-item-action row" onclick="visible(' + current_user.ID + ',' + current_user.ID_obj + ');"><h5 class="card-title col-12">' + current_user.Nom_obj + '</h5><p class="card-text col-10">Salle : '+ current_user.Salle +'</p></div>';
                    }
                    html += '</div>';
                }
            }
            else {
                html += '</div>';
            }

        }
                            
        else {
            html = '<p>Wrong request. Error: ' + xhr.status + '</p>';
        }

        document.getElementById("js_result").innerHTML = html;
    };
    xhr.send();
    
}

function visible(number_id, number_idobj) {
    html = ' <form action="./remise.php?" method="get" class="row d-flex justify-content-center">'+
'            <div class="row form-group col-12 d-flex justify-content-center">'+
'                <h5 class="col-12 text-center">Information de remise</h5>'+
'                <h6 class="col-12 text-center">Dernier Utilisateur</h6>'+
'                <div class="row form-group"><label for="Nom_util" class="col-md-4 col-11 col-form-label text-md-right">Nom</label>'+
'                <div class="col-md-8 col-11"><input type="text" class="form-control" id="frm_nom" aria-describedby="emailHelp" placeholder="Nom" name="nom_util" required>'+
'                </div></div><div class="row form-group"><label for="Prenom_util" class="col-md-4 col-11 col-form-label text-md-right">Prénom</label>'+
'                <div class="col-md-8 col-11"><input type="text" class="form-control" id="frm_pre" aria-describedby="emailHelp" placeholder="Prénom" name="pre_util" required>'+
'                </div></div><div class="row form-group"><label for="Date_Util" class="col-md-4 col-11 col-form-label text-md-right">Dernière utilisation</label>'+
'                <div class="col-md-8 col-11"><input type="date" class="form-control" id="frm_date" aria-describedby="emailHelp" placeholder="Entrer ID" name="date_util" required>'+
'                </div></div><div class="row form-group"><label class="form-select-label col-md-4 col-11 col-form-label text-md-right" for="etat">État</label>'+
'                <div class="col-md-8 col-11"><select class="custom-select" id="etat" name="etat" required>'+
'                    <option value="Bon" selected>Bon état</option>'+
'                    <option value="Neuf">Neuf</option>'+
'                    <option value="Usage">Etat d usage</option>'+
'                    <option value="Mauvais">Mauvais état</option>'+
'                    <option value="Rebut">Cassé</option>'+
'                </select>'+
'                </div></div><input type="number" value="'+ number_id +'" class="form-control d-none"  id="frm_ID" aria-describedby="IDAnnuaire" placeholder="" name="ID">'+
'                <input type="number" value="'+ number_idobj +'" class="form-control d-none"  id="frm_ID_obj" aria-describedby="IDObject" placeholder="" name="ID_obj">'+
'                <input type="submit" class="btn btn-primary">   '+
'            </div>'+
'        </form>'+
'    </a>'
    document.getElementById("modal_btn").innerHTML = html;
    var modal = document.getElementById("modal");
    modal.style.display = "block";
  };
  
  function invisible() {
    html = "";
    document.getElementById("modal_btn").innerHTML = html;
    var modal = document.getElementById("modal");
    modal.style.display = "none";
  };
  
  window.onclick = function(event) {
    var modal = document.getElementById("modal");
    if (modal.style.display == "block") {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
  };