<!DOCTYPE html>
<html lang="en">
<head>
    <meta charsert="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0,
    minimun-scale=1.0">
    <title>Help Desk</title>
    <link rel="icon" href="img/logo1.ico" >
</head>
<body>
    <div class="header">
        <div class="header-element">
            <div class="header-element-content" id="logoCusur">
                <a href="http://www.cusur.udg.mx/es/"><img src="./img/ludgycus.png" ></a>
            </div>
        </div>
        <div class="header-element" class="header-background">
            <div class="header-element-content">
                <h1>HELPDESK</h1>
            </div>
        </div>
        <div class="header-element">
            <div class="header-element-content" id="logoCta" class="header-background">
                <a href="http://cta.cusur.udg.mx/"><img src="./img/logoCTA.png"></a>
            </div>
        </div>
    </div>
    <div class="nav">
        <div class="nav-element">
            <a href="index.php">Inicio</a>
        </div>
        <div class="nav-element">
            <a href="#">Consultar</a>            
        </div>
    </div>
    <div class="main-body">
        <div class="main-content">
            <form class="form-area" id="formularioConsulta" method="POST" action="consultaTicket.php">
                <div class="form-content">
                    <div class="form-element">
                        <div class="form-label">
                            <p>Número de reporte:</p>
                        </div>
                    </div>
                    
                </div>

                <input type="number" id="folio"  name="folio" <?php if(isset($_POST["nSer"])){ echo "value=".$_POST["nSer"];}?>>

                <div class="form-content">
                    <div class="form-element">
                        <div class="form-label">
                            <p>Código de quien solicitó el servicio:</p>
                        </div>
                    </div>
                    
                </div>

                <input type="number" id="codigo"  name="codigo" <?php if(isset($_POST["idU"])){ echo "value=".$_POST["idU"];}?>>

                <div class="form-content">
                    <button type="submit" id="btn-Enviar" style="float: right">Consultar</button>
                </div>
            </form>
        </div>
        
    </div>
    <div class="footer">
        <p>CTA CUSUR © 2020. CRÉDITOS DE SITIO | PÓLÍTICA DE PRIVACIDAD Y MANEJO DE DATOS</p>
    </div>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/consultar.css">
</body>
</html>