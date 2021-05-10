<style>
body{
  font-family: sans-serif;
  margin: 0;
}

.area{
  margin: 10px auto;
  /*box-shadow: 0 10px 100px #ccc;*/
  /*padding: 20px;*/
  box-sizing: border-box;
  max-width: 500px;
}

.area video {
  width: 100%;
  height: auto;
  /*background-color: whitesmoke;*/
  background-color:#f5f5f6;
}
canvas{
  width: 100%;
  height: auto;
  /*background-color: whitesmoke;*/
  background-color:#f5f5f6;
}

.div-exibir-foto{
  margin: 10px auto;
  /*box-shadow: 0 10px 100px #ccc;*/
  /*padding: 20px;*/
  box-sizing: border-box;
  max-width: 500px;
}

.div-exibir-foto button{
  margin: 10px auto;
  width: 33%;
}

</style>

<!--Modal com os detalhes do evento-->
  <div class="modal fade" id="modalWebcam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="h4 modal-title text-center">Webcam</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <div id="taskFoto" class="area">
                      <video autoplay="true" id="webCamera">
                      </video>
              
                      <input hidden  type="text" id="base_img" name="base_img"/>
                      <button id="tirarFoto" type="button" onclick="takeSnapShot()">Tirar foto</button>
                </div>
                <div id="exibeFoto" class="div-exibir-foto" hidden>
                    <canvas id='canvas'></canvas>
                    <div style="display:flex;justify-content:center;align-items:center;">
                      <button id="salvarFoto" class="btn btn-primary" type="button" onclick="enviaFoto()"><img src="{{asset('utils/correct.png')}}"></button>
                      <button id="sairFoto" class="btn btn-primary" type="button" onclick="tirarOutraFoto()"><img src="{{asset('utils/close-x.png')}}"></button>
                    </div>
                </div>

              </form>
            </div>
        </div>
    </div>
  </div>
<script>
    function iniciaWebcan(){
        //function loadCamera(){
            //Captura elemento de vídeo
            var video = document.querySelector("#webCamera");
                //As opções abaixo são necessárias para o funcionamento correto no iOS
                video.setAttribute('autoplay', '');
                video.setAttribute('muted', '');
                video.setAttribute('playsinline', '');
                //--
            
            //Verifica se o navegador pode capturar mídia
            if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({audio: false, video: {facingMode: 'user'}})
                .then( function(stream) {
                    //Definir o elemento vídeo a carregar o capturado pela webcam
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    alert("Oooopps... Falhou :'(");
                });
            }
        //}
    }

    function takeSnapShot(){
        //Captura elemento de vídeo
        var video = document.querySelector("#webCamera");
        
        //Criando um canvas que vai guardar a imagem temporariamente
        var canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        var ctx = canvas.getContext('2d');
        
        //Desenhando e convertendo as dimensões
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        var canvas = document.querySelector("#canvas");  
        canvas.height = video.videoHeight;
        canvas.width = video.videoWidth;
        var context = canvas.getContext('2d');
        context.drawImage(video, 0, 0);

        document.getElementById('taskFoto').hidden = true;
        document.getElementById('exibeFoto').hidden = false;
    }

    function enviaFoto(){
        //Criando o JPG
        var dataURI = canvas.toDataURL('image/jpeg'); //O resultado é um BASE64 de uma imagem.
        document.querySelector("#base_img").value = dataURI;
        
        sendSnapShot(dataURI); //Gerar Imagem e Salvar Caminho no Banco
    }

    function tirarOutraFoto(){
        document.getElementById('taskFoto').hidden = false;
        document.getElementById('exibeFoto').hidden = true;
    }

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    function sendSnapShot(base64){
      let img_base64 = base64.split(",");
      document.getElementById('foto_webcam').value=img_base64[1].trim();
      document.getElementById('alert-foto-success').hidden = false;
      $('#modalWebcam').modal('hide');
        /*$.ajax({ //enviar requisição ajax
            url:"{{url('/pessoa/tirarFoto')}}", 
            type: "post",
            dataType:'json',
            data: {
                _token: CSRF_TOKEN, //token de validação do laravel
                img64: base64,
                acao: 'inserir',
            },
            success:function(result){
                console.log(result);
                document.getElementById('foto_webcam').value=result.img_64;
                document.getElementById('img_perfil').files[0]=result.img;
                $('#modalWebcam').modal('hide');
            },
        });*/
    }
</script>