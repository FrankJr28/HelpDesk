<?php
//session_start();

if(!isset($_SESSION["adminCta"])){
    header("location:index.php");
}
if(!isset($_POST["fF"])){
    header("location:admin.php");
}
$fechaInicio = $_POST["fI"];
$fechaFin = $_POST["fF"];
$meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
//include 'meses.php';
//include 'conexion.php'; 
//SELECT * from ticket LEFT JOIN ubicacion on ticket.id_Ubi = ubicacion.id_Ubi LEFT JOIN personal on ticket.id_Per = personal.id_Per LEFT JOIN usuario on ticket.id_Usu = usuario.id_Usu 
//SELECT * from ticket LEFT JOIN ubicacion on ticket.id_Ubi = ubicacion.id_Ubi LEFT JOIN personal on ticket.id_Per = personal.id_Per LEFT JOIN usuario on ticket.id_Usu = usuario.id_Usu WHERE ticket.fh_tic >= '2021-11-07' AND ticket.fh_tic <= '2021-12-10'
$sql='SELECT * from ticket LEFT JOIN ubicacion on ticket.id_Ubi = ubicacion.id_Ubi LEFT JOIN personal on ticket.id_Per = personal.id_Per LEFT JOIN usuario on ticket.id_Usu = usuario.id_Usu WHERE ticket.fh_tic >= :ini AND ticket.fh_tic <= :fin';    
$gsent=$pdo->prepare($sql);
$gsent->bindParam(":ini",$fechaInicio,PDO::PARAM_STR);
$gsent->bindParam(":fin",$fechaFin,PDO::PARAM_STR);
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
    
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    
    <style type="text/css">
        h4{
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
    </style>    
    


    
    <!--<page_header> 
        header              
    </page_header> 
   --->
    <page backtop="20mm" backbottom="7mm" backleft="10mm" backright="2mm">  
    <page_header> 
        <a href="http://www.cusur.udg.mx/es/"><img src="./img/helpdesk.png" id="logoCusur"></a>              
    </page_header>
    <page_footer style="text-align:center"> 
        [[page_cu]]/[[page_nb]]
    </page_footer>
    <h4>Coordinacion de tecnologías para el aprendizaje del Centro Universitario del Sur</h4>
    <p>A continuación se presentan los registros de incidentes atendidos del <?= $dI ?> de <?=$meses[intval($mI)-1] ?> del <?=$aI ?> 
    al <?= $dF ?> de <?=$meses[intval($mF)-1] ?> del <?=$aF ?> </p>
    <table id="example" class="content-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Problema</th>
                <th>Ubicación</th>
                <th>Código</th>
                
                <th>Nombre</th>
                
                <th>Atendió</th>
                
            </tr>
            
        </thead>

        <tbody id="ttabla">
        
            <?php foreach($resultado as $dato): ?>
            <tr>
                <td><?php echo $dato['id_tic']; ?></td>
                <?php if(strlen($dato['problema_tic']) > 22):?>
                    <!--substr($cadena, 0, $limite) . $sufijo;-->
                    <td><?php echo substr($dato['problema_tic'],0,22) . '...'; ?></td>
                <?php else: ?>
                    <td><?php echo ($dato['problema_tic']); ?></td>
                <?php endif ?>
                <td><?php echo ($dato["ubicacion_des"]); ?></td>
                <td><?php echo ($dato["id_Usu"]); ?></td>
                <td><?php echo ($dato["nombre_Usu"].' '.$dato["ap_Pat_Usu"]); ?></td>
                <td><?php if($dato["id_Per"]){ echo ($dato["nombre_Per"].' '.$dato["ap_Pat_Per"]); } else{ echo "Sin asignar"; }?></td>
                
                
            </tr>
            <?php endforeach ?>
            
        </tbody>
    </table> 
    
    </page>
    