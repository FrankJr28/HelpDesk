<?php
    session_start();
    if(!isset($_SESSION["personal"])){
        header("location:index.php");
    }
    include 'conexion.php';
    $idPer = $_SESSION["personal"]['id_Per'];
    $sql='SELECT * from ticket LEFT JOIN ubicacion on ticket.id_Ubi = ubicacion.id_Ubi LEFT JOIN usuario on usuario.id_Usu = ticket.id_Usu LEFT JOIN personal on ticket.id_Per = personal.id_Per WHERE ticket.estado_tic = "Finalizado" and ticket.id_Per = :iP';
    //SELECT ticket.id_tic, ticket.problema_tic, usuario.nombre_Usu, ticket.estado_tic, ticket.fh_tic FROM ticket LEFT JOIN usuario ON usuario.id_Usu = ticket.id_Usu WHERE ticket.estado_tic = "Finalizado"
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(':iP',$idPer,PDO::PARAM_STR);
    //$gsent->bindParam(":fin",$fechaFin,PDO::PARAM_STR);
    $gsent->execute();
    $resultado = $gsent->fetchAll();

    $sqlT='SELECT * from ticket LEFT JOIN ubicacion on ticket.id_Ubi = ubicacion.id_Ubi LEFT JOIN usuario on usuario.id_Usu = ticket.id_Usu LEFT JOIN personal on ticket.id_Per = personal.id_Per WHERE ticket.estado_tic != "Finalizado" and ticket.id_Per = :iP';
    $gsentT=$pdo->prepare('');
    $gsentT=$pdo->prepare($sqlT);
    $gsentT->bindValue(':iP',$idPer,PDO::PARAM_STR);
    $gsentT->execute();
    $resultadoT = $gsentT->fetchAll();
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
    
  <body onload="ajax();"> 
  

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
        <h4>En línea: <input type="checkbox" id="enlinea" name="enlinea"></h4>
    </div>
    
   
    <!--Ejemplo tabla con DataTables-->
    <div class="main-body">
        <h2>Incidentes pendientes</h2>
        <div class="main">
            <div class="main-content">
                <div class="precontent-table">
                    <div class="content-table">        
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Problema</th>
                                    <th>Ubicación</th>
                                    <th>Código Usuario</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    
                                </tr>
                            </thead>

                            <tbody id="ttabla">
                            
                            <?php foreach($resultadoT as $dato): ?>
                            <tr>
                                <td><?php echo $dato['id_tic']; ?></td>
                                <td><?php echo ($dato['problema_tic']); ?></td>
                                <td><?php echo ($dato["ubicacion_des"]); ?></td>
                                <td><a href="#" class="codigo"><?php echo ($dato["id_Usu"]); ?></a></td>
                                
                                <td><?php if($dato["id_Per"]){ echo ($dato["nombre_Usu"]); } else{ echo "Sin asignar"; }?></td>
                                <td><?php echo date('Y-m-d', strtotime($dato["fh_tic"])); ?></td>
                                <td><?php echo date('H:i', strtotime($dato["fh_tic"])); ?></td>
                                
                            </tr>
                            <?php endforeach ?>

                            </tbody>
                        </table>                  
                    </div>
                </div>  
            </div>
        </div>  <!-- main -->
        <h2>Incidentes Finalizados</h2>
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
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    
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
                                        <input type="text" class="form-control filter-input" placeholder="técnico" data-column="4"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="fecha" data-column="5"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="hora" data-column="6"/>
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
                                
                                <td><?php if($dato["id_Per"]){ echo ($dato["nombre_Usu"]); } else{ echo "Sin asignar"; }?></td>
                                <td><?php echo date('Y-m-d', strtotime($dato["fh_tic"])); ?></td>
                                <td><?php echo date('H:i', strtotime($dato["fh_tic"])); ?></td>
                                
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
                                        <input type="text" class="form-control filter-input" placeholder="técnico" data-column="4"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="fecha" data-column="5"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control filter-input" placeholder="hora" data-column="6"/>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>                  
                    </div>
                </div>  
            </div>
            
            
            
        
    </div>  <!-- main-body -->

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
    
    <div class="footer">
        <div class="userBox">
            <div class="widget">
                <h4  style="font-size:20px; font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;margin:0;">Hola <?php echo $_SESSION["personal"]['nombre_Per']; ?> </h4> 
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
    
    <script src="js/indexcta2.js" language="javascript" type="text/javascript" defer></script>
    <link rel="stylesheet" type="text/css" href="css/adminInc.css">
    <link rel="stylesheet" type="text/css" href="css/online.css">
    <script src="js/indexcta.js" language="javascript" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/chat.css">
    
  </body>
</html>