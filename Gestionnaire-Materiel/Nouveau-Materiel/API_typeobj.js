function get_typeobj() {

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/Gestionnaire-Materiel/Nouveau-Materiel/vue_typeobj.php", true);
    xhr.onload = function()
    {
        var html =  '<label class="form-select-label" for="categorie">Type d'+"'"+'objet*</label>'+
                    '<select class="custom-select" id="categorie" name="categorie" required>'+
                    '<option value="" selected>... Catégorie ...</option>';
        if( xhr.status == 200 ) {
            var response = JSON.parse(xhr.response);
            //var data = response.data;
            console.log(response.length, response);
            for(let i=0;i<response.length;i++) {
                current_user = response[i];
                html += '<option value="'+ current_user.ID +'">'+ current_user.Nom +'</option>';
            }

        }
                            
        else {
            html = '<p>Erreur avec la base de donnée : ' + xhr.status + '</p>';
        }

        html += '</select>';

        document.getElementById("js_typeobj").innerHTML = html;
    };
    xhr.send();
    
}
                