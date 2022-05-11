<!---
Autor: Francisco Javier Vasquez Jr
-->
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
            <a href="#">Personal</a>            
        </div>
        <div class="nav-element">
            <a href="adminUbi.php">Ubicaciones</a>            
        </div>
    </div>
    <div class="main-body">
        <h2>Personal de Soporte</h2>
        <div class="main">
            <div class="main-content">
            <div class="precontent-table">
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Paterno</th>
                                <th>Materno</th>
                                <th>Correo</th>
                                <th>Contraseña</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="ttabla">
                            <tr>
                                <td>218887444</td>
                                <td>Francisco Javier</td>
                                <td>Vasquez</td>
                                <td>Jr</td>
                                <td>fran@cusur.udg.mx</td>
                                <td>fra123</td>
                                <td>0</td>
                                <td>0</td>
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
                                <p>Id del personal </p> <p id="idP">18</p>
                            </div>
                        
                            <div class="mod-form-block">
                                <div class="block">
                                    <label>Nombre: </label>
                                    <input type="text" id="nombre" name="nombreP">
                                </div>
                                <div class="block">
                                    <label>Apellido Paterno: </label>
                                    <input type="text" id="ap_Pat" name="apPat">
                                </div>
                            </div>
                            
                            <div class="mod-form-block">
                                <div class="block">
                                    <label>Apellido Materno: </label>
                                    <input type="text" id="ap_Mat" name="apMat">
                                </div>
                                <div class="block">        
                                    <label>Disponibilidad:</label>
                                    <select id="disponibilidad" name="dispo">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mod-form-block">
                                <div class="block">
                                    <label>Correo: </label>
                                    <input type="text" id="correo" name="correo">
                                </div>
                                <div class="block">
                                    <label>Contraseña: </label>
                                    <input type="text" id="contrasena" name="contra">
                                </div>
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
                                <div class="block">
                                    <label>Nombre: </label>
                                    <input type="text" id="nombreI" name="nombrePI">
                                </div>
                                <div class="block">
                                    <label>Apellido Paterno: </label>
                                    <input type="text" id="ap_PatI" name="apPatI">
                                </div>
                            </div>
                            <div class="mod-form-block">
                                <div class="block">
                                    <label>Apellido Materno: </label>
                                    <input type="text" id="ap_MatI" name="apMatI">
                                </div>
                                <div class="block">
                                    <label>Contraseña: </label>
                                    <input type="password" id="contrasenaI" name="contraI">
                                </div>
                            </div>
                            <div class="mod-form-block">
                                <div class="block">
                                    <label>Correo: </label>
                                    <input type="text" id="CorreoI" name="correoI">
                                </div>
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

    <script src="js/adminPer.js" language="javascript" type="text/javascript"></script>
    <link href="css/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"> <!--load all styles -->
</body>
</html>