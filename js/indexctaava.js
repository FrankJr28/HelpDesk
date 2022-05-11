var anterior;
var checkbox = document.querySelector("input[name=enlinea]");
function mostrar_ocultar(){
    var caja = document.getElementById("login");

    if(caja.style.display == "none"){
        caja.style.display = "block";
        caja.style.animation = "mover 1s ease-out";
        document.getElementById("bl").value="-";
    }
    else{
        caja.style.display = "none";
        document.getElementById("bl").value="+";
        
    
    }
}
/*
window.onbeforeunload = function(e) {
    return "Sure you want to leave?";
};
*/
window.addEventListener("load", function(){
    //document.getElementById("chat-button").style.display='block';
    document.getElementById("logot").classList.toggle("logot1");
    document.getElementById("hd").classList.toggle("hd1");
});
/*
window.onbeforeunload = function(e) {
    
    if (changes)
    {
        var message = "Are you sure you want to navigate away from this page?\n\nYou have started writing or editing a post.\n\nPress OK to continue or Cancel to stay on the current page.";
        if (confirm(message)) return true;
        else return false;
    }
}
*/
/*
window.addEventListener('beforeunload', (e) =>{
    window.addEventListener('beforeunload', function (e) {
        alert("funciona");
        // the absence of a returnValue property on the event will guarantee the browser unload happens
        delete e['returnValue'];
    });
});
*/
/*
window.addEventListener('beforeunload', function (e) {
  alert("funciona");
    // the absence of a returnValue property on the event will guarantee the browser unload happens
  delete e['returnValue'];
});
*/
//window.onbeforeunload = "Are you sure you want to leave?";
/*
var areYouReallySure = false;
function areYouSure() {
    if(allowPrompt){
        if (!areYouReallySure && true) {
            areYouReallySure = true;
            var confMessage = "***************************************nn E S P E R A !!! nnAntes de abandonar nuestra web, síguenos en nuestras redes sociales como Facebook, Twitter o Instagram.nnnYA PUEDES HACER CLIC EN EL BOTÓN CANCELAR SI QUIERES...nn***************************************";
            return confMessage;
        }
    }else{
        allowPrompt = true;
    }
}

var allowPrompt = true;
window.onbeforeunload = areYouSure;
*/
function ajax(){
    
    var req10 = new XMLHttpRequest();
    req10.onreadystatechange = function(){
        if(req10.readyState == 4 && req10.status == 200 ){
            if(req10.responseText=="1"){
                checkbox.checked=true;
            }
            if(req10.responseText=="0"){
                checkbox.checked=false;
            }
        }
    }
    req10.open('GET', 'estadoTecnico.php', true);
    req10.send();


    var req8 = new XMLHttpRequest();
    req8.onreadystatechange = function(){
        if(req8.readyState == 4 && req8.status == 200 ){
            if(req8.responseText=="1"){     //Si hay registros de la conversacion
                
                var req4 = new XMLHttpRequest();
                req4.onreadystatechange = function(){
                    if(req4.readyState == 4 && req4.status == 200 ){
                        if(req4.responseText=="2"){
                            alert("la conversacion ha expirado en vigencia");
                        }
                    }
                }
                req4.open('POST', 'vigenciaChatTec.php', true);
                req4.send();

                document.getElementById("chat-button").style.display='block';

                var req2 = new XMLHttpRequest();
                
                req2.onreadystatechange = function(){
                    if(req2.readyState == 4 && req2.status == 200 ){
                        if (anterior !== req2.response){//en caso de que hubiese una modificacion actualiza de lo contrario se mantiene lo que estaba
                            document.getElementById('chatbox').innerHTML = req2.responseText;
                            anterior = req2.response;
                            console.log(req2.response);
                            console.log(anterior);  
                        }

                    }
                }
                req2.open('POST', 'obtenerMensajes.php', true);
                req2.send();
            }
            
            else if(document.getElementById("chat-button").style.display=='block'){ //sino los hay pero antes los habia
                alert("La conversación ha finalizado");                             //pára notificar al usuario que alguien más termino la conversacion
                minimizarChat();
                document.getElementById("chat-button").style.display='none';
                
            }
            else{           //cuando el la termina
                minimizarChat();                                                
                document.getElementById("chat-button").style.display='none';    //Sino lo oculta
                
            }      
        }
    }
    req8.open('POST', 'obtenerChat.php', true);
    req8.send();
}

setInterval(function(){ajax();}, 1000);    //Repetir funcion cada segunddo

/*              CHAT                */
var coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");

        var content = this.nextElementSibling;

        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }

    });
}

/*              Enviar mensaje              */
var elInput = document.getElementById('textInput');

elInput.addEventListener('keyup', function(e) {
  var keycode = e.keyCode || e.which;
  if (keycode == 13) {
    sendButton();
  }
});

function sendButton(){
    var mensaje = elInput.value;
    if(mensaje.trim()){
        //console.log("send button"+estadoInput);
        var req9 = new XMLHttpRequest();
        req9.onreadystatechange = function(){
            if(req9.readyState == 4 && req9.status == 200 ){
                console.log("mensaje enviado con exito");                //document.getElementById('online').innerHTML = req9.responseText;
                elInput.value="";
            }
        }
        req9.open('POST', 'insertarMensajeTec.php', true);
        req9.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req9.send("mensaje="+mensaje);
    }
}

function cerrarChat(){
    alert("Has finalizado la conversación");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function(){
        if(req.readyState == 4 && req.status == 200 ){
            minimizarChat();
            document.getElementById("chat-button").style.display='none'; 
            
        }
    }
    req.open('POST', 'eliminarCookieTec.php', true);
    req.send();
}

function minimizarChat(){
    var coll = document.getElementsByClassName("collapsible");
    for (let i = 0; i < coll.length; i++) {
        coll[i].classList.toggle("active");
        var content = coll[i].nextElementSibling;
        content.style.maxHeight = null;
    }
}


    checkbox.addEventListener( 'change', function() {
    if(this.checked) {
        
        var req4 = new XMLHttpRequest();
        req4.onreadystatechange = function(){
            if(req4.readyState == 4 && req4.status == 200 ){
                if(req4.responseText=="1"){
                    alert("la conversacion ha expirado en vigencia");
                }
            }
        }
        req4.open('GET', 'habilitarTecnico.php', true);
        req4.send();

    } else {

        var req4 = new XMLHttpRequest();
        req4.onreadystatechange = function(){
            if(req4.readyState == 4 && req4.status == 200 ){
                if(req4.responseText=="1"){
                    alert("Estas fuera de linea");
                }
            }
        }
        req4.open('GET', 'deshabilitarTecnico.php', true);
        req4.send();
        
    }
});