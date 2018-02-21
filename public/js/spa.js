// === Valorizzo in maniera gobale il token
window.token = '';

$(document).ready(function (){
    $('#btnLogin').on('click', function(ev){

        // === Recupero i dati dal form
        var fldUserName = $('#fldUserName').val();
        var fldPassWd = $('#fldPassWd').val();

        $('#msgLogin').html('Invio dati in corso...');

        var jsonAuthData = {
            'email' : fldUserName,
            'password' : fldPassWd
        };

        // === Effettuo una chiamata verso /api/auth/login per autenticare l'utente
        $.post('/api/auth/login', jsonAuthData, function (response) {
            console.log(response);

           $('#msgLogin').html('');
          window.token = response.token;
        });
    });

    $('#btnCaricaTabella').on('click', function(ev){

        // === Recupero token
        var token = window.token;

        if (token.length == 0)
        {
          alert('token non impostato');
          return false;
        }

        $.ajax({
                url:'/api/anagrafica',
                type:'GET',
                data:{},
                beforeSend: function (xhr) {

                    // === Imposto intestazione HTTP aggiuntiva
                    // === per aggiungere il Bearer token

                    xhr.setRequestHeader('Authorization', 'Bearer '.concat(window.token));
                },
                success: function (response) {
                    console.log(response);

                    // === Richiamare il template
                    // === Compilare il template
                    // === Inserire i dati nel template
                    // === Inserire il template nel DOM

                    var source   = $("#riepilogoTabella").html();

                    // === Compilare il template
                    var template = Handlebars.compile(source);

                    // === Inserisco il dati template
                    var output = template(response);

                    // === Inserire il template nel DOM
                    $('#tableData').html(output);
                }
            });
    });

});