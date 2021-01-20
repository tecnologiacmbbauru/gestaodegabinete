/*Função para mostrar ou ocultar a div cores e rotacionar seta*/
function mostrarCors(){
    if(document.getElementById("cores").hidden===true){
        document.getElementById("cores").hidden=false;
        document.getElementById("img-seta").style.transform = 'rotate(' + 180 + 'deg)'; //rotaciona seta para esquerda
    }else{
        document.getElementById("cores").hidden=true;
        document.getElementById("img-seta").style.transform = 'rotate(' + 0 + 'deg)';
    }
}

function purpleChoice(){
	document.getElementById('seletor').style.backgroundColor = '#6a1b9a'; //troca a div seletor para purple
	document.getElementById('corSystem').value='purple';
}

function darkPurpleChoice(){
	document.getElementById('seletor').style.backgroundColor = '#4527a0'; //troca a div seletor para purple
	document.getElementById('corSystem').value='dark-purple';
}

function indigoChoice(){
	document.getElementById('seletor').style.backgroundColor = '#283593'; //troca a div seletor para purple
	document.getElementById('corSystem').value="indigo";
}

function blueChoice(){
	document.getElementById('seletor').style.backgroundColor = '#1563c0'; //troca a div seletor para purple
	document.getElementById('corSystem').value="blue";
}

function tealChoice(){
	document.getElementById('seletor').style.backgroundColor = '#00695c'; //troca a div seletor para purple
	document.getElementById('corSystem').value="teal";
}

function greenChoice(){
	document.getElementById('seletor').style.backgroundColor = '#2e7d32'; //troca a div seletor para purple
	document.getElementById('corSystem').value="green";
}


function brownChoice(){
	document.getElementById('seletor').style.backgroundColor = '#4e342e'; //troca a div seletor para purple
	document.getElementById('corSystem').value="brown";
}

function greyChoice(){
	document.getElementById('seletor').style.backgroundColor = '#424242'; //troca a div seletor para purple
	document.getElementById('corSystem').value="grey";
}

function blueGrayChoice(){
	document.getElementById('seletor').style.backgroundColor = '#37474f'; //troca a div seletor para purple
	document.getElementById('corSystem').value="blue-grey";
}


