<?php
    include 'conexion.php';

    $codigo = $_POST['codigo'];
    $folio = $_POST['folio'];
    
    $pdo->prepare('');

    //SELECT ticket.*, personal.nombre_Per, personal.ap_Pat_Per FROM ticket LEFT JOIN personal ON personal.id_Per = ticket.id_Per WHERE id_tic=:fol And ticket.id_Usu=:cod
    $sqlC = "SELECT ticket.*, personal.nombre_Per, personal.ap_Pat_Per FROM ticket LEFT JOIN personal ON personal.id_Per = ticket.id_Per WHERE id_tic=:fol And ticket.id_Usu=:cod";
    $gsentC = $pdo->prepare($sqlC);
    $gsentC->bindParam(':fol', $folio);
    $gsentC->bindParam(':cod', $codigo);
    $gsentC->execute();
    $resultadoC = $gsentC->fetchAll();
    //var_dump($resultadoC);
    //$_POST=NULL;
    $hay_ticket = $gsentC->rowCount();
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
        <div class="main-content">
            <?php if($hay_ticket): ?>
                <h4>Los datos actuales del servicio son:</h4>
                <div class="bloque">
                    <?php foreach($resultadoC as $dato): ?>
                        <div class="personal">
                            <br>
                            <p><strong>Código del servicio: </strong><?php echo $dato['id_tic']; ?></p>
                            
                            <p><strong>Problema: </strong><?php echo $dato['problema_tic']; ?></p>
                            
                            <p><strong>Estado del servicio: </strong><?php echo $dato['estado_tic']; ?></p>
                            
                            <?php if($dato['nombre_Per']){ echo "<p><strong>Técnico que atiende: </strong>" . $dato['nombre_Per'] . ' ' . $dato['ap_Pat_Per'] . "</p>"; }?>
                            <?php if(!$dato['nombre_Per']){ echo "<p><strong>Técnico que atiende: </strong>" . 'Sin asignar' . "</p>"; }?>
                            
                            <p><strong>Fecha de registro: </strong><?php echo date('d-m-y', (strtotime($dato['fh_tic']))); ?></p>
                            
                            <p><strong>Hora del registro: </strong><?php echo date('g:i a', (strtotime($dato['fh_tic']))); ?></p>

                            <br>
                        </div>
                    <?php endforeach?>    
                </div>
            <?php endif ?>
            <?php if(!$hay_ticket):?>
                <div class="bloque">
                    <h4>Lo sentimos, el codigo de servicio ingresado no existe</h4>
                </div>
                
            <?php endif ?>
        </div>
        
    </div>
    <div class="footer">
        <p>CTA CUSUR © 2020. CRÉDITOS DE SITIO | PÓLÍTICA DE PRIVACIDAD Y MANEJO DE DATOS</p>
    </div>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/consultar.css">
</body>
</html>