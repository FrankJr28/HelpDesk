const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
var anterior;
var anteriorTecnicos;
var usuarioChat;
var anteriorUbicaciones;

var auxForm;

const expresiones = {                           //Expresiones regulares para validacion
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    otro: /^[a-zA-Z0-9\_\-]{4,16}$/,
    codigo: /^[0-9]{8,10}$/,
    correo: /^[a-zAZ\.]+@(alumnos|cusur|academico|academicos|redudg)\.udg\.mx$/
}

const campos = {
	codigo: false,
	nombre: false,
	apellidoP: false,
	apellidoM: false,
	correo: false,
    descripcion: true
}

const validarFormulario = (e) => {
    switch(e.target.name){
        case "codigoI":
            if(expresiones.codigo.test(e.target.value)){
                document.getElementById('pcod').classList.remove('input-error');
                document.getElementById('pcod').classList.add('input-correcto');
                campos.codigo=true;
            }
            else{
                document.getElementById('pcod').classList.remove('input-correcto');
                document.getElementById('pcod').classList.add('input-error');
                campos.codigo=false;
            }
        break;
        case "nI":
            if(expresiones.nombre.test(e.target.value)){
                document.getElementById('pnombre').classList.remove('input-error');
                document.getElementById('pnombre').classList.add('input-correcto');
                campos.nombre=true;
            }
            else{
                console.log('incorrecto');
                document.getElementById('pnombre').classList.remove('input-correcto');
                document.getElementById('pnombre').classList.add('input-error');
                campos.nombre=false;
            }
        break;
        case "aPI":
            if(expresiones.nombre.test(e.target.value)){
                document.getElementById('papp').classList.remove('input-error');
                document.getElementById('papp').classList.add('input-correcto');
                campos.apellidoP=true;
            }
            else{
                document.getElementById('papp').classList.remove('input-correcto');
                document.getElementById('papp').classList.add('input-error');
                campos.apellidoP=false;
            }
            
        break;
        case "aMI":
            if(expresiones.nombre.test(e.target.value)){
                document.getElementById('papm').classList.remove('input-error');
                document.getElementById('papm').classList.add('input-correcto');
                campos.apellidoM=true;
            }
            else{
                document.getElementById('papm').classList.remove('input-correcto');
                document.getElementById('papm').classList.add('input-error');
                campos.apellidoM=false;
            }
        break;
        case "corI":
            if(expresiones.correo.test(e.target.value)){
                document.getElementById('pcor').classList.remove('input-error');
                document.getElementById('pcor').classList.add('input-correcto');
                campos.correo=true;
            }
            else{
                document.getElementById('pcor').classList.remove('input-correcto');
                document.getElementById('pcor').classList.add('input-error');
                campos.correo=false;
            }
        
        break;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
});

var contenedorCarga = document.getElementById('contenedor_carga');

formulario.addEventListener('submit', (e) =>{
    e.preventDefault();
    auxForm = formulario;
    if(campos.codigo && campos.nombre && campos.apellidoP && campos.apellidoM && campos.correo){    
        
        contenedorCarga.style.visibility = 'visible';

        let data = new FormData(formulario)//obtenemos el contenido del formulario

        var req = new XMLHttpRequest();

        req.onreadystatechange = function(){                                    //Actualizaa los usuarios en linea 
            if(req.readyState == 4 && req.status == 200 ){
                console.log(parseInt(req.responseText));
                if(parseInt(req.responseText)>1){
                    contenedorCarga.style.visibility = 'hidden';                
                    alert("Reporte enviado correctamente \n Su numero de reporte es: "+req.responseText);
                    formulario.reset();
                }
                else{
                    contenedorCarga.style.visibility = 'hidden';  
                    alert("Ocurrió un error, verifique el correo");
                }
            }
        }
        req.open('POST', 'componentes/principal/insertarTicket.php', true);
        req.send(new FormData(formulario));    
    }
    else {
        alert("No se ha podido enviar el formulario, verifique los datos");
        formulario = auxForm;
    }

});

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
        var req9 = new XMLHttpRequest();
        req9.onreadystatechange = function(){
            if(req9.readyState == 4 && req9.status == 200 ){
                console.log("mensaje enviado con exito");
                elInput.value="";
            }
        }
        req9.open('POST', 'insertarMensajeUsuario.php', true);
        req9.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req9.send("mensaje="+mensaje);
    }
}

/*      AJAX de la parte de los usuarios en linea       */ 
function ajax(){
    var req = new XMLHttpRequest();

    req.onreadystatechange = function(){                                    //Actualizaa los usuarios en linea 
        if(req.readyState == 4 && req.status == 200 ){
            if (anteriorTecnicos !== req.response){
                if(req.responseText=="0"){
                    return;
                }
                else{
                    document.getElementById('online').innerHTML = req.responseText;
                    anteriorTecnicos = req.response;
                    //console.log(req2.responseText);
                    //console.log(anterior);
                }
            }
            
        }
    }
    req.open('POST', 'usuariosEnLinea.php', true);                          
    req.send();                                                             //Fin del bloque que Actualizaa los usuarios en linea
    
    var req8 = new XMLHttpRequest();                                        //Verifica que el haya un chat vigente
    req8.onreadystatechange = function(){
        if(req8.readyState == 4 && req8.status == 200 ){
            if(req8.responseText=="1"){
                document.getElementById("chat-button").style.display='block';   //Si esta vigente aparece
            }
            else if(document.getElementById("chat-button").style.display=='block'){
                alert("La conversación ha finalizado"); 
                document.getElementById("chat-button").style.display='none';
                minimizarChat();
            }
            else{
                document.getElementById("chat-button").style.display='none';    //Sino lo oculta
                minimizarChat();
            }
        }
    }
    req8.open('POST', 'vigenciaConversacion.php', true);
    req8.send();                                                            //Fin del bloque que verifica que el haya un chat vigente
    
    var req2 = new XMLHttpRequest();
    req2.onreadystatechange = function(){
        if(req2.readyState == 4 && req2.status == 200 ){
            //console.log("obtener"+req2.responseText);
            if (anterior !== req2.response){
                if(req2.responseText=="0"){
                    return;
                }
                else{
                    document.getElementById('chatbox').scroll(0,100);
                    document.getElementById('chatbox').innerHTML = req2.responseText;
                    anterior = req2.response;
                    //console.log(req2.responseText);
                    //console.log(anterior);
                }
            }
            
        }
    }
    req2.open('POST', 'obtenerMensajesInv.php', true);
    req2.send();

    
}
/*      Fin Usuarios en linea       */ 

setInterval(function(){ajax();}, 1000);    //Repetir funcion cada 1 seg

/*          Mostrar y Ocultar para el login          */

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


/*          Alerts para activar chat         */

function comenzarConversacion(usuario){
    var req0 = new XMLHttpRequest();
    req0.onreadystatechange = function(){
        if(req0.readyState == 4 && req0.status == 200 ){
            if(req0.responseText=="0"){

                var req = new XMLHttpRequest();
                req.onreadystatechange = function(){
                    if(req.readyState == 4 && req.status == 200 ){
                        if(req.responseText=="1"){
                            
                            var respuesta2 = confirm("Actualmente ya se cuenta con un chat, ¿Desea iniciar otro? \n (Solo se puede poner en contacto con un técnico a la vez)")
                            
                            if(respuesta2){//en caso de querer cambiar de chat
                                var req2 = new XMLHttpRequest();
                                req2.onreadystatechange = function(){
                                    //alert("a continuacion la respuesta");
                                    if(req2.readyState == 4 && req2.status == 200 ){
                                        document.getElementById('chat-button').innerHTML = req2.responseText;
                                    }
                                }
                                req2.open('POST', 'cookiesChatCambiar.php', true);
                                req2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                req2.send("tecnico="+usuario);
                            }

                            else{   //sino quiere cambiar de chat solo regresa
                                return;
                            }
                        }
                        else{
                            var respuesta2 = confirm("Desea iniciar un chat")
                            if(respuesta2){
                                var req3 = new XMLHttpRequest();
                                req3.onreadystatechange = function(){
                                    //alert("a continuacion la respuesta");
                                    if(req3.readyState == 4 && req3.status == 200 ){
                                        document.getElementById('chat-button').innerHTML = req3.responseText;
                                    }
                                }
                                req3.open('POST', 'cookiesChat.php', true);
                                req3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                req3.send("tecnico="+usuario);
                            }
                            else{
                                return;
                            }
                        }
                    }
                }
                req.open('POST', 'vigenciaChat.php', true);
                req.send();
    
            }
            else{
                if(req0.responseText=="1"){
                    alert ("El usuario se encuentra atendiendo otra conversación");
                }
            }
        }
    }
    req0.open('POST', 'disponibilidadTecnico.php', true);
    req0.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req0.send("tecnico="+usuario);

}

/*                  chat                    */
var coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        //this.classList.toggle("active");
        coll[i].classList.toggle("active");
        //var content = this.nextElementSibling;
        var content = coll[i].nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {

            content.style.maxHeight = content.scrollHeight + "px";
        }

    });
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
    req.open('POST', 'eliminarCookie.php', true);
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

window.addEventListener("load", function(){
    var req = new XMLHttpRequest();
    req.onreadystatechange = function(){
        if(req.readyState == 4 && req.status == 200 ){
            if(req.responseText=="0"){  //el servidor nos devuelve 1 sí ya existe
                    return;
            }
            else{
                document.getElementById('chat-button').innerHTML = req.responseText;
                document.getElementById("chat-button").style.display='block'; 
            } 
        }
    }
    req.open('POST', 'chatOnLoad.php', true);
    req.send();

    var req2 = new XMLHttpRequest();
    req2.onreadystatechange = function(){                                   
        if(req2.readyState == 4 && req2.status == 200 ){
            if(req2.responseText=="0"){
                return;
            }
            else{
                document.getElementById('edificios').innerHTML = req2.responseText;
                obtenerUbicaciones();

            }
        }
    }
    req2.open('POST', 'componentes/principal/obtenerEdificios.php', true);                          
    req2.send();


    /*
    var req4 = new XMLHttpRequest();
    req4.onreadystatechange = function(){                                    //Actualizaa los usuarios en linea 
        if(req4.readyState == 4 && req4.status == 200 ){
            if (anteriorUbicaciones !== req4.response){
                if(req4.responseText=="0"){
                    return;
                }
                else{
                    document.getElementById('ubicaciones').innerHTML = req4.responseText;
                    anteriorUbicaciones = req4.response;
                    //console.log(req2.responseText);
                    //console.log(anterior);
                }
            }
            
        }
    }
    req4.open('POST', 'componentes/principal/obtenerUbicaciones.php', true);                          
    req4.send();
    */


});

const selectEdificio = document.getElementById('edificios');

selectEdificio.addEventListener('change', (event) => {
    obtenerUbicaciones();
});

function obtenerUbicaciones(){
    idEdi=selectEdificio.value;
    //alert("cambio id:"+idEdi);
    var req4 = new XMLHttpRequest();
    req4.onreadystatechange = function(){                                    //Actualizaa los usuarios en linea 
        if(req4.readyState == 4 && req4.status == 200 ){
            document.getElementById('ubicaciones').innerHTML = req4.responseText;
        }
    }
    req4.open('POST', 'componentes/principal/obtenerUbicacionesDeEdificio.php', true);
    req4.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                          
    req4.send("idEdi="+idEdi);
    
}