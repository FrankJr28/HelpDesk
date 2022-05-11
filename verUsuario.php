<?php
    //echo 'hola desde ver usuario' . $_POST['cod'];
    include 'conexion.php';

    $codigo = $_POST['cod'];
    
    $pdo->prepare('');

    //SELECT ticket.*, personal.nombre_Per, personal.ap_Pat_Per FROM ticket LEFT JOIN personal ON personal.id_Per = ticket.id_Per WHERE id_tic=:fol And ticket.id_Usu=:cod
    $sql = "SELECT * FROM ticket LEFT join usuario on ticket.id_Usu = usuario.id_Usu LEFT JOIN personal on ticket.id_Per = personal.id_Per LEFT JOIN ubicacion on ticket.id_Ubi = ubicacion.id_Ubi where usuario.id_Usu = :cod";
    $gsent = $pdo->prepare($sql);
    $gsent->bindParam(':cod', $codigo);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
    //var_dump($resultadoC);
    //$_POST=NULL;
    //$hay_ticket = $gsent->rowCount();
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
    <!--
    <div class="nav">
        <div class="nav-element">
            <a href="index.php">Inicio</a>
        </div>
        <div class="nav-element">
            <a href="#">Consultar</a>            
        </div>
    </div>--->
    <div class="main-body">
        <div class="main-content">
               
                <div class="bloque">
                        <h3>Datos del usuario:</h3>     
                        <div class="personal">
                            <br>
                            <p><strong>Código: </strong><?php echo $resultado[0]['id_Usu']; ?></p>
                            
                            <p><strong>Nombre: </strong><?php echo $resultado[0]['nombre_Usu']; ?></p>
                            
                            <p><strong>Apellido paterno: </strong><?php echo $resultado[0]['ap_Pat_Usu']; ?></p>
                            
                            <p><strong>Apellido materno: </strong><?php echo $resultado[0]['ap_Mat_Usu']; ?></p>
                            
                            <p><strong>Correo: </strong><?php echo $resultado[0]['correo_Usu']; ?></p>

                            <br>
                        </div>

                        <h3>Incidentes del usuario:</h3>     
                        <br>
                </div>
                <!-- SELECT ticket.* FROM ticket LEFT join usuario on ticket.id_Usu = usuario.id_Usu-->
                <div class="precontent-table">
                    <div class="content-table">        
                        <table id="example" class="content-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Problema</th>
                                    <th>Ubicación</th>
                                    <th>Estado</th>
                                    <th>Técnico</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($resultado as $dato): ?>
                                <tr>
                                    <td><?php echo $dato['id_tic']; ?></td>
                                    <td><?php echo ($dato['problema_tic']); ?></td>
                                    <td><?php echo ($dato["ubicacion_des"]); ?></td>
                                    <td><?php echo ($dato["estado_tic"]); ?></td>

                                    <td><?php if($dato["id_Per"]){ echo ($dato["id_Per"]); } else{ echo "0"; }?></td>
                                    <td><?php if($dato["id_Per"]){ echo ($dato["nombre_Per"]); } else{ echo "Sin asignar"; }?></td>
                                    <td><?php echo date('Y-m-d', strtotime($dato["fh_tic"])); ?></td>
                                    <td><?php echo date('H:i', strtotime($dato["fh_tic"])); ?></td>
                                    
                                </tr>
                                <?php endforeach ?>
                            <tbody>
                        </table>
                    </div>        
                </div>

            
        </div>
        
    </div>
    <div class="footer">
        <p>CTA CUSUR © 2020. CRÉDITOS DE SITIO | PÓLÍTICA DE PRIVACIDAD Y MANEJO DE DATOS</p>
    </div>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/consultar.css">
    <link rel="stylesheet" type="text/css" href="css/verUsuario.css">
    
</body>
</html>