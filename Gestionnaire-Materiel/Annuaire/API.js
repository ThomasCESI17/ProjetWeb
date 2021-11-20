function get_obj() { 

    var nom = "";
    var salle = "";
    var cat = "";
    var tri = "";

    if(document.getElementById('nom').value != null) {var nom = document.getElementById('nom').value;}
    if(document.getElementById('salle').value != null) {var salle = document.getElementById('salle').value;}
    if(document.getElementById('categorie').value != null) {var cat = document.getElementById('categorie').value;}
    if(document.getElementById('tri').value != null) {var tri = document.getElementById('tri').value;}
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/Gestionnaire-Materiel/Annuaire/recherche.php?nom=" + nom +"&salle="+ salle +"&cat=" + cat + "&tri=" + tri, true);
    xhr.onload = function()
    {
        var html = '';
        if( xhr.status == 200 ) {
            var response = JSON.parse(xhr.response);
            //var data = response.data;
            console.log(response.length, response);
            html += '<div class="list-group col-10">';
            for(let i=0;i<response.length;i++) {
                current_user = response[i];
           
                html += '<div class="list-group-item list-group-item-action row">'+
                '<h5 class="card-title col-12">' + current_user.Nom_obj + '</h5><hr><table class="col-12">'+
                '<tr class="row"><td class="col-2 text-center">Categorie</td><td class="col-2 text-center">Salle</td><td class="col-2 text-center">Date d'+"'"+'emprunt</td><td class="col-2 text-center">Emprunteur</td><td class="col-2 text-center">Rapporteur</td><td class="col-2 text-center">Dernier Utilisateur</td></tr>' +
                '<tr class="row"><td class="col-2 text-center">'+ current_user.Categorie + '</td><td class="col-2 text-center">'+ current_user.Salle + '</td><td class="col-2 text-center">'+ current_user.Date_empreint + '</td><td class="col-2 text-center">'+ current_user.Emprunteur + '</td><td class="col-2 text-center">'+ current_user.Rapporteur + '</td><td class="col-2 text-center">'+ current_user.Dernier_utilisateur + '</td></tr></table>' +
                '</div>';
            }
            html += '</div>';
            

        }
                            
        else {
            html = '<p>Wrong request. Error: ' + xhr.status + '</p>';
        }

        document.getElementById("js_result").innerHTML = html;
    };
    xhr.send();
    
}