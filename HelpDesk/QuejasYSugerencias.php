<?php
    if(isset($_POST["t"])){
        include 'conexion.php';
        $token = $_POST["t"];
        //echo $token;
        $pdo->prepare('');
        $sql="SELECT * FROM toqys WHERE id_tok=:tok";
        $resultado=$pdo->prepare($sql);
        $resultado->bindValue(":tok",$token);
        $resultado->execute();
        $resultado->fetchAll();
        $numeroRegistros=$resultado->rowCount();
        if($numeroRegistros==0){
            header("location:contestada.php");
        }
    }
    else{
        header("location:contestada.php");
    }
?>
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

        <div class="main">

            <div class="main-content">
                <form class="form-area" id="formularioQSC" method="POST" action="consultaTicket.php">
                    <div class="form-content" style="flex-wrap: wrap">
                        <div class="form-element" >
                            <label for="mail">Del 1 al 10 ¿Qué calificación otorga a la atención recibida?:</label>
                        </div>
                        <select name="calif" id="edificios">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>    
                    </div>

                    <div class="form-content" style="flex-wrap: wrap">
                        <div class="form-element">
                            <label for="mail">Queja sugerencia o comentario:</label>
                        </div>
                        <textarea name="sugerencia"></textarea>
                    </div>
                    <div class="form-content" style="margin-top: 1.30rem">
                        <button type="submit" id="btn-Enviar" style="float: right">Enviar</button>
                    </div>
                </form>
            </div>
        
        </div>

    </div>
    <div class="footer">
        <p>CTA CUSUR © 2020. CRÉDITOS DE SITIO | PÓLÍTICA DE PRIVACIDAD Y MANEJO DE DATOS</p>
        <input type="hidden" id="to" value='<?php echo $_POST["t"]; ?>'>
        <input type="hidden" id="inc" value='<?php echo $_POST["nS"]; ?>'>
    </div>
    <script src="js/qsc.js" language="javascript" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/consultar.css">
</body>
</html>