
window.addEventListener("load", function(){
    actualizar();
});

function actualizar(){
    actualizarPersonal();
}

function actualizarPersonal(){
    var req2 = new XMLHttpRequest();

    req2.onreadystatechange = function(){
        if(req2.readyState == 4 && req2.status == 200 ){
            
                document.getElementById('ttabla').innerHTML = req2.responseText;
              
        }
    }
    req2.open('POST', 'componentes/obtenerRegistrosPersonal.php', true);
    req2.send();
}

function bajaPersonal(id){
    var req1 = new XMLHttpRequest();
    req1.onreadystatechange = function(){
        if(req1.readyState == 4 && req1.status == 200 ){
            actualizarPersonal();
            alert("El usuario con el id: "+id+", se dio de baja satisfactoriamente" );
            
        }
    }
    req1.open('POST', 'componentes/bajaPersonal.php', true);
    req1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req1.send("id="+id);
}

const on = (element, event, selector, handler) => { //metodo on de jquery
    element.addEventListener(event, e => {
        if(e.target.closest(selector)){
            handler(e);
        }
    })
}


on(document, 'click', '.delete', e => {
    const fila = e.target.parentNode.parentNode.parentNode;
    const id = fila.firstElementChild.innerHTML;
    if(id>0){
        var respuesta = confirm("¿Desea eliminar el usuario "+id+"?");
        if(respuesta){
            bajaPersonal(id);
        }
    }
})

var idP = document.getElementById('idP');
var nombre = document.getElementById('nombre');
var apPat = document.getElementById('ap_Pat');
var apMat = document.getElementById('ap_Mat');
var contra = document.getElementById('contrasena');
var correo = document.getElementById('correo');
var disponibilidad = document.getElementById('disponibilidad');

var fila2;
var fila;
var id;

var nombreI = document.getElementById('nombreI');
var apPatI = document.getElementById('ap_PatI');
var apMatI = document.getElementById('ap_MatI');
var contraI = document.getElementById('contrasenaI');

on(document, 'click', '.edit', e => {
    fila = e.target.parentNode.parentNode.parentNode;
    fila2 = e.target.parentNode.parentNode.parentNode;//.parentNode
    id = fila2.children[0].innerHTML;
    if(id>0){
        modal.style.display = 'block';

        idP.textContent=": "+fila2.children[0].innerHTML;
        nombre.value=fila2.children[1].innerHTML;
        apPat.value=fila2.children[2].innerHTML;
        apMat.value=fila2.children[3].innerHTML;
        correo.value=fila2.children[4].innerHTML;
        contra.value=fila2.children[5].innerHTML;
        disponibilidad.value=fila2.children[6].innerHTML;
    }

})

on(document, 'click', '.destroy', e => {
    fila = e.target.parentNode.parentNode.parentNode;
    id = fila.children[0].innerHTML;
    if(id>0){
        var respuesta = confirm("¿Está seguro que desea eliminar completamente toda la informacion relacionada al usuario: "+id+"?"+"\n(Esta operación es irreversible)");
        if(respuesta){
            eliminarPersonal(id);
        }
    }
})

on(document, 'click', '.up', e => {
    console.log("up");
    fila = e.target.parentNode.parentNode.parentNode;
    id = fila.children[0].children[0].innerHTML;
    console.log(id);
    if(id>0){
        var respuesta = confirm("¿Desea activar el usuario con el id: "+id+"?");
        if(respuesta){
            altaPersonal(id);
        }
    }
})

let botonAgregar = document.getElementById("nuevo-personal");

botonAgregar.addEventListener('click', function(){
    modalI.style.display = 'block';
})

const formularioM = document.getElementById('modificarf');

/*Formulario Modificar*/
formularioM.addEventListener('submit', (e) =>{
    e.preventDefault();
        let data = new FormData(formularioM)//obtenemos el contenido del formulario
        data.append("id", id);
        var req = new XMLHttpRequest();
        req.onreadystatechange = function(){                                   
            if(req.readyState == 4 && req.status == 200 ){
                if(req.responseText){
                    alert("Informacion Modificada Correctamente");
                    actualizar();
                }
                else{
                    alert("Ocurrió un error");
                }
            }
        }
        req.open('POST', 'componentes/modificarPersonal.php', true);
        req.send(data);     
       

});

/*Fin Formulario Modificar*/

const formularioI = document.getElementById('insertarf');

/*Formulario Insertar*/
formularioI.addEventListener('submit', (e) =>{
    e.preventDefault();
    //if(campos.codigo && campos.nombre && campos.apellidoP && campos.apellidoM && campos.correo){    
        
        let dataI = new FormData(formularioI)//obtenemos el contenido del formulario
        
        var req3 = new XMLHttpRequest();

        req3.onreadystatechange = function(){                                    //Actualizaa los usuarios en linea 
            if(req3.readyState == 4 && req3.status == 200 ){
                if(req3.responseText=="correcto"){
                    alert("Informacion Agregada Correctamente");
                    actualizar();
                    formularioI.reset();
                }
                else{
                    alert("Ocurrió un error");
                }
            }
        }
        req3.open('POST', 'componentes/insertarPersonal.php', true);
        req3.send(dataI);     
       

});
/*Fin Formulario Insertar*/


/*Para modal modificar*/ 
let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let cerrar = document.getElementById('close');

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