function get_membre() { 

    var nom = "";
    var prenom = "";
    var tri = "";

    if(document.getElementById('nom').value != null) {var nom = document.getElementById('nom').value;}
    if(document.getElementById('prenom').value != null) {var prenom = document.getElementById('prenom').value;}
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/Gestionnaire-Materiel/Gestion-Membre/recherche_membre.php?nom=" + nom +"&prenom="+ prenom + "&tri=" + tri, true);
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
            
                html += '<a href="http://localhost/Gestionnaire-Materiel/Gestion-Membre/Membre?membre='+ current_user.ID +'" class="list-group-item list-group-item-action row">'+
                '<h5 class="card-title col-12 text-left">' + current_user.Nom + " " + current_user.Prenom + '</h5>'+
                '<p class="card-text col-10">Nombre d'+"'"+'emprunt : '+ current_user.Nombre_emprunt +'</p>'+
            '</a>';
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