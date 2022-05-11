<?php
    include '../../conexion.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer/Exception.php';
    require '../../PHPMailer/PHPMailer.php';
    require '../../PHPMailer/SMTP.php';

    $codigoI=$_POST['codigoI'];
    $nombreI=$_POST['nI'];
    $aPI=$_POST['aPI'];
    $aMI=$_POST['aMI'];
    $corI=$_POST['corI'];
    $uT =$_POST["ubicacion"];
    $pT = $_POST['pT'];
        $pdo->prepare('');        //Ver que no este registrado
        $sql="SELECT * FROM usuario WHERE id_Usu=:login";
        $resultado=$pdo->prepare($sql);
        $resultado->bindParam(":login",$codigoI,PDO::PARAM_INT);
        //$resultado->bindValue(":password",$password);
        $resultado->execute();
        $ar=$resultado->fetchAll();
        $numeroRegistros=$resultado->rowCount();
        
        if($numeroRegistros!=0){
          $pdo->prepare('');        //Ver que no este registrado
          //update usuario set id_Usu=218887484, nombre_Usu="Francisc8", ap_Pat_Usu="Vasquez", ap_Mat_Usu="Jr", correo_Usu="francisco.vasquezjr@alumnos.udg.mx" where id_Usu=218887444
          $sql="UPDATE usuario SET  id_Usu=:idUsu, nombre_Usu=:nombreUsu, ap_Pat_Usu=:appUsu, ap_Mat_Usu=:apmUsu, correo_Usu=:correoUsu WHERE id_Usu=:idUsu";
          $resultado=$pdo->prepare($sql);
          //$resultado=$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
          $resultado->bindParam(":idUsu",$codigoI,PDO::PARAM_INT);
          $resultado->bindParam(":nombreUsu",$nombreI,PDO::PARAM_STR);
          $resultado->bindParam(":appUsu",$aPI,PDO::PARAM_STR);
          $resultado->bindParam(":apmUsu",$aMI,PDO::PARAM_STR);
          $resultado->bindParam(":correoUsu",$corI,PDO::PARAM_STR);
          //$resultado->bindValue(":idUsu",$codigoI);
          //$login=htmlentities(addslashes($_POST["login"]));
          //$password=htmlentities(addslashes($_POST["password"]));
          $resultado->bindParam(":login",$codigoI,PDO::PARAM_INT);
          //$resultado->bindValue(":password",$password);
          $resultado->execute();
        }
        else{
          //Envio a tabla usuario
          $pdo->prepare('');
          $sqlP='INSERT INTO usuario (id_Usu,nombre_Usu,ap_Pat_Usu,ap_Mat_Usu,correo_Usu,activo_Usu) VALUES (:idUsu,:nombreUsu,:appUsu,:apmUsu,:correoUsu,"1")';
          $gsentP=$pdo->prepare($sqlP);
          //$gsentP=$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
          $gsentP->bindParam(":idUsu",$codigoI,PDO::PARAM_INT);
          $gsentP->bindParam(":nombreUsu",$nombreI,PDO::PARAM_STR);
          $gsentP->bindParam(":appUsu",$aPI,PDO::PARAM_STR);
          $gsentP->bindParam(":apmUsu",$aMI,PDO::PARAM_STR);
          $gsentP->bindParam(":correoUsu",$corI,PDO::PARAM_STR);
          $gsentP->execute();
        }

    
    $pdo->prepare('');
    $sqlT='INSERT INTO ticket (id_Usu, id_Ubi, problema_tic,id_tic,estado_tic) VALUES (:idUsu,:ubi,:problema,NULL,"Pendiente")';
    $gsentT=$pdo->prepare($sqlT);
    //$gsentT=$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    $gsentT->bindParam(":idUsu",$codigoI,PDO::PARAM_INT);
    $gsentT->bindParam(":ubi",$uT,PDO::PARAM_STR);
    $gsentT->bindParam(":problema",$pT,PDO::PARAM_STR);
    $gsentT->execute();

    //echo "1";

    $pdo->prepare('');
    $sqlT='SELECT id_tic FROM `ticket` WHERE id_Usu=:idUsu order by id_tic DESC LIMIT 1';
    $gsentT=$pdo->prepare($sqlT);
    //$gsentT=$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    $gsentT->bindParam(":idUsu",$codigoI,PDO::PARAM_INT);
    $gsentT->execute();
    $resultado = $gsentT->fetchAll();
    $nServicio = $resultado[0]["id_tic"];
    //echo $resultado[0]["id_tic"];

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'java10028@gmail.com';                     //SMTP username
        $mail->Password   = 'PagaN1728';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('java10028@gmail.com', 'Javier Vasquez');
        $mail->addAddress($corI);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Servicio HelpDesk '.$nServicio;
        $mail->Body    = '
        <html> 
        <head> 
        <title>Prueba de correo</title> 
        </head> 
        <body> 
        <h1 style="visibility:hidden backgroud-color:red">Hola nombre</h1> 
        <p> 
        <b>Bienvenido al servicio de atención HelpDesk del Centro Universitario del Sur </b>. 
        <br>
        El codigo de su servicio es '. $nServicio .', podrá consultar el estado de este en el apartado consultas.
        </p>
        <br>
        <form action="obtienepruebaform.php" method="post">
        <input style="visibility:hidden backgroud-color:red" type="text" id="name" name="codigoI" value='.$nServicio.'>
        <button type="submit" id="btn-Enviar">Quejas y sugerencias</button>
        </body> 
        </html> ';

        $mail->AltBody = '<h1 style="visibility:hidden backgroud-color:red">Hola nombre</h1> 
        <p> 
        <b>Bienvenido al servicio de atención HelpDesk del Centro Universitario del Sur </b>. 
        <br>
        El codigo de su servicio es '. $nServicio .', podrá consultar el estado de este en el apartado consultas.
        </p>
        <br>
        <form action="obtienepruebaform.php" method="post">
        <input style="visibility:hidden backgroud-color:red" type="text" id="name" name="codigoI" value='.$nServicio.'>
        <button type="submit" id="btn-Enviar">Quejas y sugerencias</button>
        </form>';
        $mail->CharSet = 'CHARSET_ISO88591';
        $mail->send();
        echo $nServicio;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    ?>