<?php
    session_start();
    if(!isset($_SESSION["adminCta"])){
        header("location:index.php");
    }
    include 'conexion.php';
    
    
    $pdo->prepare('');

    $sql='SELECT * from ticket LEFT JOIN ubicacion on ticket.id_Ubi = ubicacion.id_Ubi LEFT JOIN personal on ticket.id_Per = personal.id_Per';
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();

    require './vendor/autoload.php';
    use Spipu\Html2Pdf\Html2Pdf;
    if(isset($_POST['fF'])){
        ob_start();
        require_once 'print_view.php';
        $html = ob_get_clean();

        $html2pdf = new Html2Pdf('P','A4','es', true, 'UTF-8', array(5, 6, 5, 6));//if we want horizontal instead of P we put L
        //$html2pdf->page();
        $html2pdf->writeHTML($html);
        $html2pdf ->output();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Help Desk</title>
    <link rel="icon" href="img/logo1.ico" >
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="css/indi.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
  </head>
    
  <body> 
  <!-- Loader -->    
  <div id="contenedor_carga">
        <div id="carga">
        </div>
  </div>
  <!-- Fin loader -->
  <div class="header">
        <div class="header-element">
            <div class="header-element-content" id="logoCusur">
                <a href="http://www.cusur.udg.mx/es/"><img src="./img/ludgycus.png" ></a>
            </div>
        </div>
        <div class="header-element" class="header-background">
            <div class="header-element-content">
                <h1 style="font-weight:bold">HELPDESK</h1>
            </div>
        </div>
        <div class="header-element">
            <div class="header-element-content" id="logoCta" class="header-background">
                <a href="http://cta.cusur.udg.mx/"><img src="./img/logoCTA.png"></a>
            </div>
        </div>
    </div>  

    <div class="nav">
        <div class="nav-ele">
            <a href="#">Incidentes</a>
        </div>
        <div class="nav-ele">
            <a href="adminPer.php">Personal</a>            
        </div>
        <div class="nav-ele">
            <a href="adminUbi.php">Ubicaciones</a>            
        </div>
    </div>
     
    <!--Ejemplo tabla con DataTables-->
    <div class="main-body">
        <h2>Incidentes</h2>
        <div class="main">
            <div class="main-content">
                <div class="precontent-table">
                    <div class="content-table">        
                        <table id="example" class="content-table">
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
                                <tr>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="no. ticket" data-column="0"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="problema" data-column="1"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="ubicación" data-column="2"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="código" data-column="3"/>
                                    </td>
                                    <td>
                                    <select data-column="4" class="form-control filter-select">
                                            <option value="">-</option>
                                            <option value="atendiendo">atendiendo</option>
                                            <option value="pendiente">pendiente</option>
                                            <option value="finalizado">finalizado</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="no. técnico" data-column="5"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="técnico" data-column="6"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="fecha" data-column="7"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="hora" data-column="8"/>
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            </thead>

                            <tbody id="ttabla">
                            
                            <?php foreach($resultado as $dato): ?>
                            <tr>
                                <td><?php echo $dato['id_tic']; ?></td>
                                <td><?php echo ($dato['problema_tic']); ?></td>
                                <td><?php echo ($dato["ubicacion_des"]); ?></td>
                                <td><a href="#" class="codigo"><?php echo ($dato["id_Usu"]); ?></a></td>
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
                            <tfoot>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="no. ticket" data-column="0"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="problema" data-column="1"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="ubicación" data-column="2"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="código" data-column="3"/>
                                    </td>
                                    <td>
                                    <select data-column="4" class="form-control filter-select">
                                            <option value="">-</option>
                                            <option value="atendiendo">atendiendo</option>
                                            <option value="pendiente">pendiente</option>
                                            <option value="finalizado">finalizado</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="no. técnico" data-column="5"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="técnico" data-column="6"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="fecha" data-column="7"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="hora" data-column="8"/>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            </tfoot>
                        </table>                  
                    </div>
                </div>  
            </div>
            
            
            
        </div>  <!-- main -->
        <div class="btn">
                <button id="gReporte">Generar Reporte</button>
        </div>
    </div>  <!-- main-body -->

    <!-- Inicio modal -->
    <div id="miModal" class="modal">
            <div class="flex" id="flex">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <div class="headM">
                            <h2>Modificar Datos</h2>
                        </div>
                        <span class="close" id="close">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="modificarf">
                        
                            <div class="mod-form-block">
                                <p>Folio del incidente: </p> <p id="idI">18</p>
                            </div>
                        
                            <div class="mod-form-block">
                                <label>Problema:</label>
                                <input type="text" id="problema" name="problema">
                            </div>
                            <div class="mod-form-block">
                                <div class="block">
                                    <label>Técnico:</label>
                                    <select name="tecnico" id="tecnico">
                                        <option>tecnico</option>
                                    </select>	
                                </div>
                                <div class="block">
                                    <label>Estado:</label>
                                    <select name="estado" id="estado">
                                        <option>Pendiente</option>
                                        <option>Atendiendo</option>
                                        <option>Finalizado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mod-form-block">
                                <div class="block">
                                    <label>Fecha:</label>
                                    <input type="date" id="fecha">
                                </div>
                                <div class="block">
                                    <label for="hora">Hora:</label>
                                    <input type="time" id="hora">	
                                </div>
                            </div>
                            <div class="mod-btn-mod">
                                <button Type="submit" id="btn-modificar">
                                    Modificar
                                </button>	
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Fin modal -->

    <!-- Inicio modal generar reportes-->
    <div id="miModalR" class="modal">
        <div class="flex" id="flexR">
            <div class="contenido-modal">
                <div class="modal-header flex">
                    <div class="headM">
                        <h2>Generar Reporte</h2>
                    </div>
                    <span class="close" id="closeR">&times;</span>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="Reporte">
                    
                        <div class="mod-form-block">
                            <p>A continuación llene el formulario: </p>
                        </div>

                        <div class="mod-form-block">
                            <div class="block">
                                <label>Inicio:</label>
                                <input type="date" id="fechaI" name="fI">
                            </div>
                            <div class="block">
                                <label>Fin:</label>
                                <input type="date" id="fechaF" name="fF">
                            </div>
                        </div>

                        <div class="mod-btn-mod">
                            <button Type="submit" id="btn-modificar">
                                Generar
                            </button>	
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin modal -->

    <div class="footer">
        <div class="userBox">
            <div class="widget">
                <h4  style="font-size:20px; font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;margin:0;">Hola <?php echo $_SESSION["adminCta"]['nombre_Admin']; ?> </h4> 
            </div>
            
            <div class="widget">
                <h4 style="font-size:20px; font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;margin:0;"><a href="cerrarsesion.php">Cerrar sesión</a></h4>
            </div>
        </div>
        <div class="userBox" id="cred">
            <p style="margin:0;font-size:12px">CTA CUSUR © 2020. CRÉDITOS DE SITIO | PÓLÍTICA DE PRIVACIDAD Y MANEJO DE DATOS</p>
        </div>    
    </div>

    <!--<script src="js/admin.js" language="javascript" type="text/javascript"></script>-->
    <link href="css/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"> <!--load all styles -->
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>  
    
    <script src="js/admin.js" language="javascript" type="text/javascript" defer></script>

    <link rel="stylesheet" type="text/css" href="css/adminInc.css">

    
  </body>
</html>
