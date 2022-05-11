<?php
//session_start();

if(!isset($_SESSION["adminCta"])){
    header("location:index.php");
}
if(!isset($_POST["fF"])){
    header("location:admin.php");
}
$meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
//include 'meses.php';
//include 'conexion.php'; 
$sql='SELECT * from ticket LEFT JOIN ubicacion on ticket.id_Ubi = ubicacion.id_Ubi LEFT JOIN personal on ticket.id_Per = personal.id_Per';    
$gsent=$pdo->prepare($sql);
$gsent->execute();
$resultado = $gsent->fetchAll();

$fechaInicio = $_POST["fI"];
$fechaFin = $_POST["fF"];

$aI= substr($fechaInicio,0,4);
$mI= substr($fechaInicio,5,2);
$dI= substr($fechaInicio,8,2); 

$aF= substr($fechaFin,0,4);
$mF= substr($fechaFin,5,2);
$dF= substr($fechaFin,8,2); 

//setlocale(LC_TIME, 'es_ES');
//$numero = 3;
//$fecha = DateTime::createFromFormat('!m', $mI);
//$mes = strftime("%B", $fecha->getTimestamp()); // marzo


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Reporte Incidentes</title>
    <style type="text/css">
        /*h4{
            text-align:center;
        }
        table{
            width: 700px;
        }
        table thead tr {
            background-color: #216e8a;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }
        table td {
            padding: 6px 7px
        }
        */

    </style>    
    </style>
    
    <page backtop="10mm" backbottom="10mm" backleft="10mm" backright="20mm">
        <page_header>
            <h1>este es el header</h1>
        </page_header>
    
        <page_footer>
            <table id="footer">
                <tr class="fila">
                    <td>
                        <span>Este el footer y pueder ir con letra más pequeña por ejemplo poner una
                        dirección o algo así :P</span>
                    </td>
                </tr>
            </table>
        </page_footer>
    
    </page>
</head>

<body>
    <page> 
        <page_header> 
            header              
        </page_header> 
        <page_footer> 
        hola footer
        </page_footer> 
    </page> 
    <a href="http://www.cusur.udg.mx/es/"><img src="./img/helpdesk.png" id="logoCusur"></a>
    <br>
    <h4>Coordinacion de tecnologías para el aprendizaje del Centro Universitario del Sur</h4>
    <p>A continuación se presentan los registros de los incidentes atendidos del <?= $dI ?> de <?=$meses[intval($mI)-1] ?> del <?=$aI ?> 
    al <?= $dF ?> de <?=$meses[intval($mF)-1] ?> del <?=$aF ?> </p>
    <table id="example" class="content-table">
        <thead>
            <tr>
                <th>Id</th>
                
                <th>Ubicación</th>
                <th>Código Usuario</th>
                <th>Estado</th>
                <th>Técnico que atendió</th>
                <th>Fecha</th>
                <th>Hora</th>
                
            </tr>
            
        </thead>

        <tbody id="ttabla">
        
        <?php foreach($resultado as $dato): ?>
        <tr>
            <td><?php echo $dato['id_tic']; ?></td>
           
            <td><?php echo ($dato["ubicacion_des"]); ?></td>
            <td><?php echo ($dato["id_Usu"]); ?></td>
            <td><?php echo ($dato["estado_tic"]); ?></td>

            
            <td><?php if($dato["id_Per"]){ echo ($dato["nombre_Per"].' '.$dato["ap_Pat_Per"]); } else{ echo "Sin asignar"; }?></td>
            <td><?php echo date('Y-m-d', strtotime($dato["fh_tic"])); ?></td>
            <td><?php echo date('H:i', strtotime($dato["fh_tic"])); ?></td>
            
        </tr>
        <?php endforeach ?>

        </tbody>
    </table> 
    
    
</body>
    
</html>