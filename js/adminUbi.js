window.addEventListener("load", function(){
    actualizarLugar();
});

function actualizarLugar(){
    var req2 = new XMLHttpRequest();

    req2.onreadystatechange = function(){
        if(req2.readyState == 4 && req2.status == 200 ){
            
                document.getElementById('ttabla').innerHTML = req2.responseText;
              
        }
    }
    req2.open('POST', 'componentes/ubicacion/obtenerRegistrosUbicacion.php', true);
    req2.send();
}

const on = (element, event, selector, handler) => { //metodo on de jquery
    element.addEventListener(event, e => {
        if(e.target.closest(selector)){
            handler(e);
        }
    })
}

var fila;
var id;

/*Para modal modificar*/ 
let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let cerrar = document.getElementById('close');

on(document, 'click', '.edit', e => {
    cargarEdificios();
    fila = e.target.parentNode.parentNode.parentNode;//.parentNode
    id = fila.children[0].innerHTML;
    if(id>0){
        modal.style.display = 'block';

        idP.textContent=": "+fila.children[0].innerHTML;
        lugar.value=fila.children[1].innerHTML;
        //var respuesta2 = confirm("")
    }

})

on(document, 'click', '.destroy', e => {
    fila = e.target.parentNode.parentNode.parentNode;
    id = fila.children[0].innerHTML;
    if(id>0){
        var respuesta = confirm("¿Está seguro que desea eliminar completamente toda la informacion relacionada a la ubicación: "+id+"?"+"\n(Esta operación es irreversible)");
        if(respuesta){
            eliminarUbicacion(id);
        }
    }
})

function eliminarUbicacion(id){
    var req1 = new XMLHttpRequest();
    req1.onreadystatechange = function(){
        if(req1.readyState == 4 && req1.status == 200 ){
            actualizarLugar();
            alert("El lugar con el: "+id+", ha sido eliminado" );
            
        }
    }
    req1.open('POST', 'componentes/ubicacion/eliminarUbicacion.php', true);
    req1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req1.send("id="+id);
}


cerrar.addEventListener('click', function(){
    modal.style.display = 'none';
});

window.addEventListener('click', function(e){
    if(e.target == flex){
        modal.style.display = 'none';
    }
});

/*Para modal insertar*/
let modalI = document.getElementById('miModalI');
let flexI = document.getElementById('flexI');
let cerrarI = document.getElementById('closeI');

cerrarI.addEventListener('click', function(){
    modalI.style.display = 'none';
});

window.addEventListener('click', function(e){
    if(e.target == flexI){
        modalI.style.display = 'none';
    }
});

let botonAgregar = document.getElementById("nuevo-personal");

botonAgregar.addEventListener('click', function(){
    modalI.style.display = 'block';
    cargarEdificios();
})

const selectEdificiosAgregar = document.getElementById('edificiosI');
const selectEdificiosModificar = document.getElementById('edificios');

function cargarEdificios(){
    var req4 = new XMLHttpRequest();
    req4.onreadystatechange = function(){                                    //Actualizaa los usuarios en linea 
        if(req4.readyState == 4 && req4.status == 200 ){
            selectEdificiosAgregar.innerHTML = req4.responseText;
            selectEdificiosModificar.innerHTML = req4.responseText;                    
        }
    }
    req4.open('POST', 'componentes/ubicacion/obtenerEdificiosUbi.php', true);
    req4.send();
}

selectEdificiosAgregar.addEventListener('change', (event) => {
    idEdi=event.target.value;
    if(idEdi=='999'){
        window.location.href = 'adminEdificios.php';
    }
    
});

selectEdificiosModificar.addEventListener('change', (event) => {
    idEdi=event.target.value;
    if(idEdi=='999'){
        window.location.href = 'adminEdificios.php';
    }
    
});

const formularioI = document.getElementById('insertarf');

/*Formulario Insertar*/
formularioI.addEventListener('submit', (e) =>{
    e.preventDefault();
    //if(campos.codigo && campos.nombre && campos.apellidoP && campos.apellidoM && campos.correo){    
        
        let dataI = new FormData(formularioI)//obtenemos el contenido del formulario
        
        var req3 = new XMLHttpRequest();

        req3.onreadystatechange = function(){                                    //Actualizaa los usuarios en linea 
            if(req3.readyState == 4 && req3.status == 200 ){
                if(req3.responseText){
                    alert("Informacion insertada Correctamente");
                    actualizarLugar();
                    formularioI.reset();
                }
                else{
                    alert("Ocurrió un error");
                }
            }
        }
        req3.open('POST', 'componentes/ubicacion/insertarUbicacion.php', true);
        req3.send(dataI);     
       

});

const formularioM = document.getElementById('modificarf');

/*Formulario Modificar*/
formularioM.addEventListener('submit', (e) =>{
    e.preventDefault();
    //if(campos.codigo && campos.nombre && campos.apellidoP && campos.apellidoM && campos.correo){    
        let data = new FormData(formularioM)//obtenemos el contenido del formulario
        data.append("id", id);
        var req = new XMLHttpRequest();
        req.onreadystatechange = function(){                                    //Actualizaa los usuarios en linea 
            if(req.readyState == 4 && req.status == 200 ){
                if(req.responseText){
                    //alert("Reporte enviado correctamente \n Su numero de reporte es: "+req.responseText);
                    //formularioM.reset();
                    alert("Informacion Modificada Correctamente");
                    actualizarLugar();
                }
                else{
                    alert("Ocurrió un error");
                }
            }
        }
        req.open('POST', 'componentes/ubicacion/modificarUbicacion.php', true);
        //req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req.send(data);     
});

/*Fin Formulario Modificar*/