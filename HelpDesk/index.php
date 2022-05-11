<!DOCTYPE html>
<html lang="en">
<head>
    <meta charsert="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0,
    minimun-scale=1.0">
    <title>Help Desk</title>
    <link rel="icon" href="img/logo1.ico" >
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="css/indi.css">
    <link rel="stylesheet" type="text/css" href="css/avisoCookies.css">
</head>
<body onload="ajax();">
    <div id="contenedor_carga">
        <div id="carga">
        </div>
    </div>
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
            <a href="#">Inicio</a>
        </div>
        <div class="nav-element">
            <a href="consultar.php">Consultar</a>            
        </div>
    </div>
    <div class="main-body">
        <div class="main">
            <div class="main-content">
                <form method="POST" class="form-area" id="formulario">
                    <div class="form-content">
                        <div class="form-element">
                            <div class="form-label">
                                <p>Código:</p>
                            </div>
                        </div>
                        <input type="number" id="name" name="codigoI">
                        
                    </div>
                    <p class="input-correcto" id="pcod">El Codigo tiene que ser de 8 a 10 dígitos y solo puede contener numeros.</p>
                    <div class="form-content">
                        <div class="form-element">
                            <label for="name">Nombre:</label>
                        </div>
                        <input type="text" id="nam" name="nI">
                    </div>
                    <p class="input-correcto" id="pnombre">El nombre solo puede contener letras.</p>
                    <div class="form-content">
                        <div class="form-element">        
                            <label for="name">Apellido Paterno:</label>  
                        </div>    
                        <input type="text" id="app" name="aPI">
                    </div>
                    <p class="input-correcto" id="papp">El apellido solo puede contener letras.</p>
                    
                    <div class="form-content">
                        <div class="form-element">
                            <label for="name">Apellido Materno:</label>
                        </div>
                        <input type="text" id="apm" name="aMI">
                    </div>
                    <p class="input-correcto" id="papm">El apellido solo puede contener letras.</p>        
                      
                    <div class="form-content">
                        <div class="form-element">
                            <label for="mail">Correo electrónico:</label>
                        </div>
                        <input type="email" id="mail" name="corI">
                    </div>
                    <p class="input-correcto" id="pcor">El correo solo puede pertenecer a algún dominio UDG</p>
                    <div class="form-content">
                        <div class="form-element">
                            <label for="mail">Edificio:</label>
                        </div>
                        <select name="edificio" id="edificios">
                            <option>Aula X1</option>
                            <option>Aula X2</option>
                            <option>Aula X3</option>
                        </select>    
                    </div>
                    <div class="form-content">
                        <div class="form-element">
                            <label for="mail">Espacio:</label>
                        </div>
                        <select name="ubicacion" id="ubicaciones">
                            <option>Seleccione un edificio</option>
                        </select>    
                    </div>
                    
                    <div class="form-content">
                        <div class="form-element">
                            <label for="mail">Describa el problema:</label>
                        </div>
                        <textarea name="pT"></textarea>
                    </div>
                    <button type="submit" id="btn-Enviar" style="margin-top: 10px">Enviar</button>
                </form>
            </div>


            <!-- CHAT BAR BLOCK -->
            <div class="chat-bar-collapsible" id="charbc">
                <button id="chat-button" type="button" class="collapsible">
                    <i id="chat-icon" style="color: red;" class="fas fa-times"></i>
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
                                        <!--<i id="chat-icon" style="color: crimson;" class="fa fa-fw fa-heart"
                                            onclick="heartButton()"></i>-->
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
        </div>
        <div class="aside">
            <div class="aside-element">
                <div class="aside-element-header">
                    <h4>Login</h4>
                    <input id="bl" value="+" type="submit" onclick="mostrar_ocultar()">
                </div>
                <div id="login" style="display: none;">
                    <form action="login.php" method="POST">
                        <div class="form-content">
                            <label>Código:</label>
                        </div>
                        <div class="form-content">
                            <input type="text" name="login">
                        </div>
                        <div class="form-content">
                            <label>Contraseña</label>
                        </div>    
                        <div class="form-content">
                            <input type="password" name="password">
                        </div>
                        <div style="display: flex; justify-content: flex-start;">
                            <button>Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="aside-element">
                <h4>Usuarios en línea</h4>
                <br>
                <div id="online">
                </div>    
            </div>
            <br>
            <div class="aside-element">
                <div>
                    <h4>Contáctanos</h4> 
                    <h4>Ext 46046</h4> 
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div>
            <p>CTA CUSUR © 2020. CRÉDITOS DE SITIO | PÓLÍTICA DE PRIVACIDAD Y MANEJO DE DATOS</p>
        </div>
    </div>

    <div class="aviso-cookies" id="aviso-cookies">
        <h3 class="titulo-c">Cookies</h3>
        <p class="parrafo-c">Utilizamos cookies propias para mejorar nuestros servicios.</p>
        <button class="boton" id="btn-aceptar-cookies">De acuerdo</button>
        <a class="enlace" href="aviso-cookies.html">Aviso de Cookies</a>
    </div>

    <div class="fondo-aviso-cookies" id="fondo-aviso-cookies"></div>

    <script src="js/aviso-cookies.js"></script>

    <script src="js/index.js" language="javascript" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/chat.css">
    <link href="css/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"> <!--load all styles -->
</body>
</html>