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
    <link rel="stylesheet" type="text/css" href="css/adminUbi.css">
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
            <a href="admin.php">Incidentes</a>
        </div>
        <div class="nav-element">
            <a href="adminPer.php">Personal</a>            
        </div>
        <div class="nav-element">
            <a href="#">Ubicaciones</a>            
        </div>
    </div>
    <div class="main-body">
        <h2>Ubicaciones</h2>
        <div class="main">
            <div class="main-content">
            <div class="precontent-table">
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Lugar</th>
                                <th>Edificio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="ttabla">
                            <tr>
                                <td>218887444</td>
                                <td>Francisco Javier</td>
                                <td>Vasquez</td>
                                <td>borrar</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="btn">
            <button id="nuevo-personal">Agregar</button>
        </div>    
    </div>

    <!-- Inicio ventana modal Modificar -->
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
                                <p>Id de la ubicación</p> <p id="idP">18</p>
                            </div>
                        
                            <div class="mod-form-block">
                                <label>Edificio: </label>
                                <select name="Edificio" id="edificios">
                                    <option>Edificio 1</option>
                                    <option>Edificio 2</option>
                                    <option>Edificio 3</option>
                                </select>    
                            </div>

                            <div class="mod-form-block">
                                <label>Lugar: </label>
                                <input type="text" id="lugar" name="lugar">
                            </div>
                            
                            <div class="mod-btn-mod">
                                
                                <button class="btn-formulario" type="submit">
                                    Modificar
                                </button>

                            </div>
                        
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    <!-- Fin modal -->

     <!-- Inicio ventana modal Insertar -->
     <div id="miModalI" class="modal">
            <div class="flex" id="flexI">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <div class="headM">
                            <h2>Insertar Datos</h2>
                        </div>
                        <span class="close" id="closeI">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="insertarf">
                            
                            <div class="mod-form-block">
                                <label>Edificio: </label>
                                <select name="EdificioI" id="edificiosI">
                                    <option>Edificio 1</option>
                                    <option>Edificio 2</option>
                                    <option>Edificio 3</option>
                                </select>    
                            </div>

                            <div class="mod-form-block">
                                <label>Lugar: </label>
                                <input type="text" id="lugarI" name="LugarI">
                               
                            </div>
                            <div class="mod-btn-mod">
                                
                                <button class="btn-formulario" type="submit">
                                    Insertar
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
                <h4>Hola <?php echo $_SESSION["adminCta"]['nombre_Admin']; ?> </h4> 
            </div>
            
            <div class="widget">
                <h4><a href="cerrarsesion.php">Cerrar sesión</a></h4>
            </div>
        </div>

        <div class="userBox" id="cred">
            <p>CTA CUSUR © 2020. CRÉDITOS DE SITIO | PÓLÍTICA DE PRIVACIDAD Y MANEJO DE DATOS</p>
        </div>
        
    </div>

    <script src="js/adminUbi.js" language="javascript" type="text/javascript"></script>
    <link href="css/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"> <!--load all styles -->
</body>
</html>