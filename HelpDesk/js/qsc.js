const formulario = document.getElementById('formularioQSC');

formulario.addEventListener('submit', (e) =>{
    e.preventDefault();
    var toc=this.document.getElementById('to').value;
    var idTic=this.document.getElementById('inc').value;

    
    let data = new FormData(formulario)//obtenemos el contenido del formulario
    data.append("tic", idTic);
    data.append('toc', toc);
    var req = new XMLHttpRequest();

    req.onreadystatechange = function(){                                   
        if(req.readyState == 4 && req.status == 200 ){
            if(req.responseText=="ok"){
                alert("Información enviada correctamente");
                location.reload();
            }
            else{
                alert("algo salió mal");
            }
        }
    }
    req.open('POST', 'componentes/QyS/insertarQueja.php', true);
    req.send(data);    

});