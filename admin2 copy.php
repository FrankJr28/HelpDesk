<?php
    session_start();
    if(!isset($_SESSION["adminCta"])){
        header("location:index.php");
    }
    include 'conexion.php';
    
    
    $pdo->prepare('');

    //SELECT ticket.*, personal.nombre_Per, personal.ap_Pat_Per FROM ticket LEFT JOIN personal ON personal.id_Per = ticket.id_Per WHERE id_tic=:fol And ticket.id_Usu=:cod
    
    /*$sqlC = "SELECT ticket.*, personal.nombre_Per, personal.ap_Pat_Per FROM ticket LEFT JOIN personal ON personal.id_Per = ticket.id_Per WHERE id_tic=:fol And ticket.id_Usu=:cod";
    $gsentC = $pdo->prepare($sqlC);
    $gsentC->bindParam(':fol', $folio);
    $gsentC->bindParam(':cod', $codigo);
    $gsentC->execute();
    $resultadoC = $gsentC->fetchAll();
    //var_dump($resultadoC);
    //$_POST=NULL;
    $hay_ticket = $gsentC->rowCount();*/


    $sql='SELECT * from ticket LEFT JOIN ubicacion on ticket.id_Ubi = ubicacion.id_Ubi LEFT JOIN personal on ticket.id_Per = personal.id_Per';
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Help Desk</title>
    <link rel="icon" href="img/logo1.ico" >
    <link rel="stylesheet" type="text/css" href="css/admin.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
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
            <a href="#">Incidentes</a>
        </div>
        <div class="nav-element">
            <a href="adminPer.php">Personal</a>            
        </div>
        <div class="nav-element">
            <a href="adminUbi.php">Ubicaciones</a>            
        </div>
    </div>
     
    <!--Ejemplo tabla con DataTables-->
    <div class="main-body">
        <h2>Incidentes</h2>
        <div class="main">

    <div class="main-content">
        <div class="row">
                <div >
                    <div class="table-responsive">        
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Problema</th>
                                <th>Ubicación</th>
                                <th>Código Usuario</th>
                                <th>Estado</th>
                                <th>Técnico</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="ttabla">
                        
                        <?php foreach($resultado as $dato): ?>
                        <tr>
                            <td><?php echo $dato['id_tic']; ?></td>
                            <td><?php echo ($dato['problema_tic']); ?></td>
                            <td><?php echo ($dato["ubicacion_des"]); ?></td>
                            <td><?php echo ($dato["id_Usu"]); ?></td>
                            <td><?php echo ($dato["estado_tic"]); ?></td>

                            <td><?php if($dato["id_Per"]){ echo ($dato["id_Per"]); } else{ echo "0"; }?></td>
                            <td><?php if($dato["id_Per"]){ echo ($dato["nombre_Per"]); } else{ echo "Sin asignar"; }?></td>
                            <td><?php echo date('Y-m-d', strtotime($dato["fh_tic"])); ?></td>
                            <td><?php echo date('H:i', strtotime($dato["fh_tic"])); ?></td>
                            <td class="c-acciones">
                                <a href="#" class="edit"><i class="fas fa-edit"></i></a>
                                <?php if($_SESSION["adminCta"][0]==1000): ?>   <!-- Que solo a superadmin le permita eliminar-->
                                    <a href="#" class="delete"><i class="fas fa-trash"></i></a>
                                <?php endif ?>
                            </td>
                        </tr>
                        <?php endforeach ?>

                        </tbody>        
                       </table>                  
                    </div>
                </div>
        </div>  
    </div>    
      
    </div>
    </div>

    <div class="userBox">
        <div class="widget">
            <h4>Hola <?php echo $_SESSION["adminCta"]['nombre_Admin']; ?> </h4> 
        </div>
        
        <div class="widget">
            <h4><a href="cerrarsesion.php">Cerrar sesión</a></h4>
        </div>
    </div> 

    <div class="footer">
        <p>CTA CUSUR © 2020. CRÉDITOS DE SITIO | PÓLÍTICA DE PRIVACIDAD Y MANEJO DE DATOS</p>
    </div>

    <script src="js/admin.js" language="javascript" type="text/javascript"></script>
    <link href="css/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"> <!--load all styles -->
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>  
    
    
  </body>
</html>
