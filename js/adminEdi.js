window.addEventListener("load", function(){
    actualizarEdificio();
});

function actualizarEdificio(){
    var req2 = new XMLHttpRequest();

    req2.onreadystatechange = function(){
        if(req2.readyState == 4 && req2.status == 200 ){
            
                document.getElementById('ttabla').innerHTML = req2.responseText;
              
        }
    }
    req2.open('POST', 'componentes/edificio/obtenerRegistrosEdificio.php', true);
    req2.send();
}

const on = (element, event, selector, handler) => { //metodo on de jquery
    element.addEventListener(event, e => {
        if(e.target.closest(selector)){
            handler(e);
        }
    })
}

/*Para modal modificar*/ 
let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let cerrar = document.getElementById('close');
const edificio =document.getElementById('edificio');

on(document, 'click', '.edit', e => {
    fila = e.target.parentNode.parentNode.parentNode;//.parentNode
    id = fila.children[0].innerHTML;
    if(id>0){
        modal.style.display = 'block';
        idP.textContent=": "+fila.children[0].innerHTML;
        edificio.value=fila.children[1].innerHTML;
    }

})

on(document, 'click', '.destroy', e => {
    fila = e.target.parentNode.parentNode.parentNode;
    id = fila.children[0].innerHTML;
    if(id>0){
        var respuesta = confirm("¿Está seguro que desea eliminar completamente toda la informacion relacionada al edificio: "+id+"?"+"\n(Esta operación es irreversible)");
        if(respuesta){
            eliminarEdificio(id);
        }
    }
})

function eliminarEdificio(id){
    var req1 = new XMLHttpRequest();
    req1.onreadystatechange = function(){
        if(req1.readyState == 4 && req1.status == 200 ){
            actualizarEdificio();
            alert("El edificio con el: "+id+", ha sido eliminado" );
            
        }
    }
    req1.open('POST', 'componentes/edificio/eliminarEdificio.php', true);
    req1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req1.send("id="+id);
}

/*Cerrar Modal Modificar*/
cerrar.addEventListener('click', function(){
    modal.style.display = 'none';
});

window.addEventListener('click', function(e){
    if(e.target == flex){
        modal.style.display = 'none';
    }
});
/*FIN Cerrar Modal Modificar */

/*Para modal insertar*/
let modalI = document.getElementById('miModalI');
let flexI = document.getElementById('flexI');
let cerrarI = document.getElementById('closeI');

/*Cerrar Modal Insertar*/
cerrarI.addEventListener('click', function(){
    modalI.style.display = 'none';
});

window.addEventListener('click', function(e){
    if(e.target == flexI){
        modalI.style.display = 'none';
    }
});
/*FIN Cerrar Modal Insertar */

let botonAgregar = document.getElementById("nuevo-edificio");

botonAgregar.addEventListener('click', function(){
    modalI.style.display = 'block';
})

/*Insertar Datos */
const formularioI = document.getElementById('insertarf');

/*Formulario Insertar*/
formularioI.addEventListener('submit', (e) =>{
    e.preventDefault();
    //if(campos.codigo && campos.nombre && campos.apellidoP && campos.apellidoM && campos.correo){    
        
        let dataI = new FormData(formularioI)//obtenemos el contenido del formulario
        
        var req3 = new XMLHttpRequest();

        req3.onreadystatechange = function(){                                    //Actualizaa los usuarios en linea 
            if(req3.readyState == 4 && req3.status == 200 ){
                //if(req3.responseText){
                if(1){
                    alert("Informacion Modificada Correctamente");
                    actualizarEdificio();
                }
                
            }
        }
        req3.open('POST', 'componentes/edificio/insertarEdificio.php', true);
        //req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
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
                    actualizarEdificio();
                }
                else{
                    alert("Ocurrió un error");
                }
            }
        }
        req.open('POST', 'componentes/edificio/modificarEdificio.php', true);
        //req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req.send(data);     
});
