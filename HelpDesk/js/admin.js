window.addEventListener("load", function(){
    actualizar();

    var req3 = new XMLHttpRequest();

    req3.onreadystatechange = function(){
        if(req3.readyState == 4 && req3.status == 200 ){
            
                document.getElementById('tecnico').innerHTML = req3.responseText;
        }
    }
    req3.open('POST', 'componentes/ticket/obtenerPersonal.php', true);
    req3.send();

});

var table2=$('#example').DataTable();

function actualizar(){
    var req = new XMLHttpRequest();

    req.onreadystatechange = function(){
        if(req.readyState == 4 && req.status == 200 ){
            
                document.getElementById('ttabla').innerHTML = req.responseText;
                table2.page.len(10).draw();
                /*anterior = req2.response;*/
        }
    }
    req.open('POST', 'componentes/ticket/obtenerRegistrosIncidentes.php', true);
    req.send();
    
}

function eliminarIncidente(i){
    var req1 = new XMLHttpRequest();
    req1.onreadystatechange = function(){
        //alert("a continuacion la respuesta");
        if(req1.readyState == 4 && req1.status == 200 ){
            //document.getElementById('chat-button').innerHTML = req1.responseText;
            actualizar();
            alert("El incidente con el id: "+i+", se eliminó satisfactoriamente" );
            
        }
    }
    req1.open('POST', 'componentes/eliminarIncidente.php', true);
    req1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req1.send("folio="+i);

   
}

/* Definir Método On */
const on = (element, event, selector, handler) => {
    element.addEventListener(event, e => {
        if(e.target.closest(selector)){
            handler(e);
        }
    })
}

var idI = document.getElementById('idI');
var problema = document.getElementById('problema');
var tecnico = document.getElementById('tecnico');
var estado = document.getElementById('estado');
var fecha = document.getElementById('fecha');
var hora = document.getElementById('hora');

var id;

on(document, 'click', '.edit', e => {
    const fila = e.target.parentNode.parentNode.parentNode;
    id = fila.firstElementChild.innerHTML;
    console.log("El id de la fila es: "+id);
    if(id>0){    
        modal.style.display = 'block';
        idI.textContent=fila.children[0].innerHTML;
        problema.value = fila.children[1].innerHTML;
        tecnico.value = fila.children[5].innerHTML;
        estado.value = fila.children[4].innerHTML;
        fecha.value = fila.children[7].innerHTML;
        hora.value = fila.children[8].innerHTML;
    }
})

var contenedorCarga = document.getElementById('contenedor_carga');

const formularioM = document.getElementById('modificarf');

/*Formulario Modificar*/
formularioM.addEventListener('submit', (e) =>{
    e.preventDefault();
    //if(campos.codigo && campos.nombre && campos.apellidoP && campos.apellidoM && campos.correo){
        contenedorCarga.style.visibility = 'visible';
        let data = new FormData(formularioM);//obtenemos el contenido del formulario
        data.append("id", id);
        var req = new XMLHttpRequest();
        req.onreadystatechange = function(){                                    //Actualizaa los usuarios en linea 
            if(req.readyState == 4 && req.status == 200 ){
                actualizar();
                contenedorCarga.style.visibility = 'hidden';
                alert("Información actulizada correctamente");
            }
        }
        req.open('POST', 'componentes/ticket/modificarTicket.php', true);
        req.send(data);     
});
/*Fin Formulario Modificar*/

on(document, 'click', '.delete', e => {
    //alert("edit pressed");
    const fila = e.target.parentNode.parentNode.parentNode
    const id = fila.firstElementChild.innerHTML
    //console.log(id);
    //modal.style.display = 'block';
    var respuesta = confirm("¿Desea eliminar el incidente "+id+"?");
    if(respuesta){
        eliminarIncidente(id);
    }

});

on(document, 'click', '.codigo', e => {
    //alert("edit pressed");
    const cod = e.target.innerHTML
    if(cod>1){
        formu = document.createElement("form");// creamos el formulario
        formu.action = "verUsuario.php";
        formu.method = "POST";
        control = document.createElement("input");// creamos un control
        control.type = "number";
        control.name = "cod";
        control.value = cod;
        formu.appendChild(control); // lo añadimos al form
        document.body.appendChild(formu);
        formu.submit();
        
        //control.setAttribute("type","number");

        
        /*
        let formCod = new FormData();
        formCod.append("cod", cod);
        var request = new XMLHttpRequest();
        request.open("POST", "verUsuario.php");
        request.send(formCod);
        location.href('verUsuario.php');
        */
    }
    //const cod = document.anchors[0].innerHTML;
    //const id = fila.firstElementChild.innerHTML
    console.log(cod);
    //modal.style.display = 'block';
    
});

/*Para modal*/ 
let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let cerrar = document.getElementById('close');

cerrar.addEventListener('click', function(){
    modal.style.display = 'none';
});

window.addEventListener('click', function(e){
    //console.log(e.target);
    if(e.target == flex){
        modal.style.display = 'none';
    }
});

/*Para modal*/ 
let modalR = document.getElementById('miModalR');
let flexR = document.getElementById('flexR');
let cerrarR = document.getElementById('closeR');

cerrarR.addEventListener('click', function(){
    modalR.style.display = 'none';
});

let btnR  = document.getElementById('gReporte');

btnR.addEventListener('click', function(){
    modalR.style.display = 'block';
});

window.addEventListener('click', function(e){
    //console.log(e.target);
    if(e.target == flexR){
        modalR.style.display = 'none';
    }
});