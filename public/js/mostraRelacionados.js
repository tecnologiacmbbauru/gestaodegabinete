/*
Script precisa usar a class na imagem da seta para saber se ela esta para cima ou para baixo.
Caso apenas usasse uma variavel auxiliar para isto, teriamos bug, pois a pessoa pode abrir varias seta na tabela.
*/ 


function atendimentoR(contator){
    if(document.getElementById("seta"+contator).className=="seta"){
        document.getElementById("seta"+contator).style.transform = "rotate("+180+"deg)"; 
        document.getElementById("seta"+contator).className="seta-up"
    }else{
        document.getElementById("seta"+contator).style.transform = "rotate("+0+"deg)"; 
        document.getElementById("seta"+contator).className="seta"
    }
    document.getElementById("atendimentoRela"+contator).hidden=!document.getElementById("atendimentoRela"+contator).hidden;
}


function respRela(contator){

    if(document.getElementById("seta-res"+contator).className=="seta"){
        document.getElementById("seta-res"+contator).style.transform = "rotate("+180+"deg)"; 
        document.getElementById("seta-res"+contator).className="seta-up"
    }else{
        document.getElementById("seta-res"+contator).style.transform = "rotate("+0+"deg)"; 
        document.getElementById("seta-res"+contator).className="seta"
    }

    document.getElementById("respRela"+contator).hidden=!document.getElementById("respRela"+contator).hidden;
}