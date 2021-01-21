// CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){

    $("#pessoa_busca" ).autocomplete({
        source: function( request, response ) {
             // Fetch data
            $.ajax({
                url:"{{route('atendimento.seleciona_pessoa')}}",
                type: 'post',
                dataType: "json",
                data: {
                _token: CSRF_TOKEN,
                search: request.term
                },
                success: function( data ) {
                response( data);
                }
            });
        },
        select: function (event, ui) {
            $('#pessoa_busca').val(ui.item.label); // display the selected text //mostra o texto selecionado no input
            $('#GAB_PESSOA_cod_pessoa').val(ui.item.value); // save selected id to input //salva o id do input
                            
        if (ui.item.path_imagem!=null){
            $('#img_pessoa').attr("src","../../../storage/"+ui.item.path_imagem);
            $('#img_pessoa').attr("hidden",false);
        }else{
            $('#img_pessoa').attr("src","../../../utils/sem-imagem.jpg");
            $('#img_pessoa').attr("hidden",false);
        }
        return false;
        }
    });
    $("#pessoa_busca").on('keyup', function(e) {    //quando uma tecla é apertada
        if ($('#pessoa_busca').is(':empty')){       //verifica se esta vazio
            $('#img_pessoa').attr("hidden",true);  //Caso esteja limpa os campos de código e a imagem                            
            $('#GAB_PESSOA_cod_pessoa').val("");
        }
    });
});