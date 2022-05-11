<?php
    session_start();
    if(!isset($_SESSION["personal"])){
        header("location:index.php");
    }
    include 'conexion.php';
    $sql='SELECT * from personal';
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();

    $sqlT='SELECT ticket.id_tic, ticket.problema_tic, usuario.nombre_Usu, ticket.estado_tic, ticket.fh_tic FROM ticket LEFT JOIN usuario ON usuario.id_Usu = ticket.id_Usu;';
    $gsentT=$pdo->prepare('');
    $gsentT=$pdo->prepare($sqlT);
    $gsentT->execute();
    $resultadoT = $gsentT->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charsert="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0,
         minimun-scale=1.0">
         <title>Help Desk</title>
         <link rel="stylesheet" type="text/css" href="css/indexcta.css">
         <link rel="icon" href="img/logo1.ico" >
         <script type="text/javascript">
            function debug(event){
                navigator.sendBeacon('desactivarTecnico.php');
                return 'Evento: ' + event.type;
        }
         /*
            document.addEventListener('visibilitychange', function logData() {
                if (document.visibilityState === 'hidden') {
                    navigator.sendBeacon('desactivarTecnico.php');
                }
            });
        */
       /*
            document.addEventListener('onbeforeunload', function logData() {
                    navigator.sendBeacon('desactivarTecnico.php');
                    return 1;
            });*/
        </script>
    </head>
    <body onbeforeunload="return debug(event)" onload="ajax();">
        <div class="contenedor">
            <div class="header">
                <div class="logo"><img src="./img/logoCTA.png" width="150px"></div>
                <div class="nav-container">
                    <div class="nav">
                        <a href="index.php">Inicio</a>
                        <a href="#">Administrar</a>
                        <a href="·">Consultar</a>
                    </div>
                </div>
            </div>
            <div class="title" id="titulo">
                <div class="title-content" >
                    <img src="img/logo1.png" id="logot" class="logot">
                    <h1 id="hd" class="hd">HELP DESK</h1>
                </div>
            </div>
            <div class="main">
                <div class="d-servicios">
                    <div class="d-e-servicios">
                        <div class="d-e-l">
                            <h7>Ordenar por</h7>
                            <select name="busqueda">
                                <option>Nombre</option>
                                <option>Edificio</option>
                                <option>tipo</option>
                                <option>estado</option>
                                <option>tecnico</option>
                                <option>fecha</option>
                            </select>
                            <h7>Buscar por</h7>
                            <select name="busqueda">
                                <option>Nombre</option>
                                <option>Edificio</option>
                                <option>tipo</option>
                                <option>estado</option>
                                <option>tecnico</option>
                                <option>fecha</option>
                            </select>
                        </div>
                        <div class="back-input">
                            <input type="text">
                            <div class="icon">
                                <div class="search icon"></div>
                            </div>
                        </div>
                    </div>
                    <div class="precontent-table">
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Ticket</th>
                                    <th>Problema</th>
                                    <th>Usuario</th>
                                    <th>estado</th>
                                    <th>fecha</th>
                                    <th>hora</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($resultadoT as $dato): ?>
                                    <tr>
                                    <td><a href="index.php"><?php echo $dato['id_tic']; ?></a></td>
                                    <td><a href="index.php"><?php echo $dato['problema_tic']; ?></a></td>
                                    <td><a href="index.php"><?php echo $dato['nombre_Usu']; ?></a></td>
                                    <td><a href="index.php"><?php echo $dato['estado_tic']; ?></a></td>
                                    <td><a href="index.php"><?php echo date('d-m-y', strtotime($dato['fh_tic'])); ?></a></td>
                                    <td><a href="index.php"><?php echo date('g:i a', strtotime($dato['fh_tic'])); ?></a></td>
                                    </tr>
                                <?php endforeach?>  
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- CHAT BAR BLOCK -->
            <div class="chat-bar-collapsible">
                <button id="chat-button" type="button" class="collapsible">
                    Usuario
                    <i id="chat-icon" style="color: red;" class="fas fa-times-circle" style="float: right" onclick="cerrarChat()"></i><!--onclick="cerrarChat()" -->
                </button>

                <div class="content">
                    <div class="full-chat-block">
                        <!-- Message Container -->
                        <div class="outer-container">
                            <div class="chat-container">
                                <!-- Messages -->
                                <div id="chatbox">
                                    <!--<h5 id="chat-timestamp"></h5>-->
                                    <!--<p id="botStarterMessage" class="botText"><span>Loading...</span></p>-->
                                </div>

                                <!-- User input box -->
                                <div class="chat-bar-input-block">
                                    <div id="userInput">
                                        <input id="textInput" class="input-box" type="text" name="msg"
                                            placeholder="Presione 'Enter' para enviar">
                                        <p></p>
                                    </div>

                                    <div class="chat-bar-icons">
                                        <i id="chat-icon" style="color: #333;" class="fa fa-arrow-right"
                                            onclick="sendButton()"></i>
                                    </div>
                                </div>

                                <div id="chat-bar-bottom">
                                    <p></p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="aside">
                <div class="widget">
                    <h4>Hola <?php echo $_SESSION["personal"]['nombre_Per']; ?> </h4> 
                    
                </div>
                <div class="widget">
                    <h4>En línea: <input type="checkbox" id="enlinea" name="enlinea"></h4>
                </div>
                <div class="widget">
                    <h4><a href="cerrarsesion.php">Cerrar sesión</a></h4>
                </div>
            </div>
            
            <div class="footer">
                CTA CUSUR © 2020. CRÉDITOS DE SITIO | PÓLÍTICA DE PRIVACIDAD Y MANEJO DE DATOS
            </div>
        </div>
        <link rel="stylesheet" type="text/css" href="css/chat.css">
        
        <script src="js/indexcta.js" language="javascript" type="text/javascript"></script>
        
        <link href="css/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"> <!--load all styles -->              
    </body>
</html>