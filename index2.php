<?php
    session_start();
    if(!isset($_SESSION["adminCta"])){
        header("location:index.php");
    }
    include 'conexion.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charsert="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0,
    minimun-scale=1.0">
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
<!--<body onload="ajax();">-->
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
    <div class="main-body">
        <h2>Incidentes</h2>
        <div class="main">
            <!--
            <div class="main-content">
            <div class="precontent-table">
                    <table class="content-table" id="tabletickets">
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
                            <tr>
                                <td>218887444</td>
                                <td>Francisco Javier</td>
                                <td>Vasquez</td>
                                <td>Jr</td>
                                <td>fra123</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>-->
                        <div class="container">
                            <div class="row">
                                    <div class="col-lg-12">
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
                                                    <tr>
                                                        <td>Tiger Nixon</td>
                                                        <td>Arquitecto</td>
                                                        <td>Edinburgh</td>
                                                        <td>61</td>
                                                        <td>2011/04/25</td>
                                                        <td>$320,800</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Garrett Winters</td>
                                                        <td>Contador</td>
                                                        <td>Tokyo</td>
                                                        <td>63</td>
                                                        <td>2011/07/25</td>
                                                        <td>$170,750</td>
                                                    </tr>                
                                                    <tr>
                                                        <td>Cedric Kelly</td>
                                                        <td>Senior Javascript Developer</td>
                                                        <td>Edinburgh</td>
                                                        <td>22</td>
                                                        <td>2012/03/29</td>
                                                        <td>$433,060</td>
                                                    </tr>
                                                    
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

    <!-- Inicio modal -->
        <div id="miModal" class="modal">
            <div class="flex" id="flex">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>Modificar Datos</h2>
                        <span class="close" id="close">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="modificarf">
                        
                            <div class="mod-form-block">
                                <p>Folio: </p> <p>18</p>
                            </div>
                        
                            <div class="mod-form-block">
                                <label>Problema</label>
                                <input type="text" id="problema" name="problema">
                            </div>
                            <div class="mod-form-block">
                                <label>Técnico</label>
                                <select name="tecnico" id="tecnico">
                                    <option>Gil</option>
                                    <option>Norman</option>
                                    <option>Michi</option>
                                </select>	
                            </div>
                            <div class="mod-form-block">
                                <label>Estado</label>
                                <select name="estado" id="estado">
                                    <option>Pendiente</option>
                                    <option>Atendiendo</option>
                                    <option>Finalizado</option>
                                </select>
                            </div>
                            <div class="mod-form-block">
                                <label>Fecha:</label>
                                <input type="date" id="fecha">
                                <label for="hora">Hora</label>
                                <input type="time" id="hora">	
                            </div>
                            <div class="mod-form-block">
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

    <div class="footer">
        <p>CTA CUSUR © 2020. CRÉDITOS DE SITIO | PÓLÍTICA DE PRIVACIDAD Y MANEJO DE DATOS</p>
    </div>

    <!---<script src="js/admin.js" language="javascript" type="text/javascript"></script>-->
    <link href="css/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"> <!--load all styles -->
    
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>  
</body>
</html>