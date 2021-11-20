function get_obj() { 
    var rad=document.getElementsByName('visionnage');
    for (var i = 0, length = rad.length; i < length; i++) {
        if (rad[i].checked) {
            // do whatever you want with the checked radio
            affichage = rad[i].value;
        }}

        console.log(affichage);

    var id = "";
    var nom = "";
    var salle = "";
    var cat = "";
    var dispo = "";
    var tri = "";

    if(document.getElementById('id').value != null) {var id = document.getElementById('id').value;}
    if(document.getElementById('nom').value != null) {var nom = document.getElementById('nom').value;}
    if(document.getElementById('salle').value != null) {var salle = document.getElementById('salle').value;}
    if(document.getElementById('categorie').value != null) {var cat = document.getElementById('categorie').value;}
    if(document.getElementById('dispo').value != null) {var dispo = document.getElementById('dispo').value;}
    if(document.getElementById('tri').value != null) {var tri = document.getElementById('tri').value;}
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/Gestionnaire-Materiel/Recherche/recherche.php?id=" + id +"&nom=" + nom +"&salle="+ salle +"&cat=" + cat +"&dispo=" + dispo + "&tri=" + tri, true);
    xhr.onload = function()
    {
        var html = '';
        if( xhr.status == 200 ) {
            var response = JSON.parse(xhr.response);
            //var data = response.data;
            console.log(response.length, response);
            if (affichage ==1){
                for(let i=0;i<response.length;i++) {
                    current_user = response[i];
                    
                    if(current_user.Disponible==1){
                        var idispo = '<i class="fas fa-check-circle"></i>';
                    } else {
                        var idispo = '<i class="fas fa-times-circle"></i>';
                    }

                    html += '<article class="col-lg-2 col-md-6">'+
                    '<a href="http://localhost/Gestionnaire-Materiel/Materiel?page='+ current_user.ID +'">'+
                     ' <div class="card cartelement">'+
                      '  <img class="card-img-top" src="http://localhost/Gestionnaire-Materiel/img/'+ current_user.ID_photo +'.jpg" alt="">'+
                       ' <div class="card-body">'+
                        '  <h5 class="card-title">' + current_user.Nom + '</h5>'+
                         ' <p class="card-text">Salle '+ current_user.Salle +'  '+ idispo + ' <i class="fas fa-clipboard-check"></i>'+ current_user.Quantite_Dispo +'</p>'+
                          '<a href="http://localhost/Gestionnaire-Materiel/Emprunt/?ID='+ current_user.ID +'" class="btn btn-primary">Emprunter</a>'+
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

                    if(current_user.Disponible==1){
                        var idispo = '<i class="fas fa-check-circle"></i>';
                    } else {
                        var idispo = '<i class="fas fa-times-circle"></i>';
                    }
               
                    html += '<a href="localhost/Gestionnaire-Materiel/Materiel?page='+ current_user.ID +'" class="list-group-item list-group-item-action row">'+
                    '<h5 class="card-title col-12">' + current_user.Nom + '</h5>'+
                    '<p class="card-text col-10">Salle '+ current_user.Salle +'  '+ idispo + ' <i class="fas fa-clipboard-check"></i>'+ current_user.Quantite_Dispo +'</p>'+
                '</a>';
                }
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