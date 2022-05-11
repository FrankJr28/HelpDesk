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
          $sql="UPDATE usuario SET  id_Usu=:idUsu, nombre_Usu=:nombreUsu, ap_Pat_Usu=:appUsu, ap_Mat_Usu=:apmUsu, correo_Usu=:correoUsu WHERE id_Usu=:idUsu";
          $resultado=$pdo->prepare($sql);
          //$resultado=$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
          $resultado->bindParam(":idUsu",$codigoI,PDO::PARAM_INT);
          $resultado->bindParam(":nombreUsu",$nombreI,PDO::PARAM_STR);
          $resultado->bindParam(":appUsu",$aPI,PDO::PARAM_STR);
          $resultado->bindParam(":apmUsu",$aMI,PDO::PARAM_STR);
          $resultado->bindParam(":correoUsu",$corI,PDO::PARAM_STR);
          $resultado->bindParam(":login",$codigoI,PDO::PARAM_INT);
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
    /////////////////////////////01 05 22

    $pdo->prepare('');
    $sqlT='SELECT id_tic FROM `ticket` WHERE id_Usu=:idUsu order by id_tic DESC LIMIT 1';
    $gsentT=$pdo->prepare($sqlT);
    //$gsentT=$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    $gsentT->bindParam(":idUsu",$codigoI,PDO::PARAM_INT);
    $gsentT->execute();
    $resultado = $gsentT->fetchAll();
    $nServicio = $resultado[0]["id_tic"];
    
    $i=0;
    while($i==0){
      $tok = rand(1,99999);
      $pdo->prepare('');
      $sql="SELECT * FROM toqys WHERE id_tok=:tok";
      $resultado=$pdo->prepare($sql);
      $resultado->bindValue(":tok",$tok);
      $resultado->execute();
      $resultado->fetchAll();
      $numeroRegistros=$resultado->rowCount();
      if($numeroRegistros==0){
        $pdo->prepare('');
        $sql="INSERT INTO toqys (id_tok,id_tic) VALUES (:idtok,:idtic)";
        $resultado=$pdo->prepare($sql);
        $resultado->bindValue(":idtok",$tok,PDO::PARAM_INT);
        $resultado->bindValue(":idtic",$nServicio,PDO::PARAM_INT);
        $resultado->execute();
        $i=1;
      }
      
    }

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
        $mail->Body    = '<!DOCTYPE html>
        <html lang="es">
        <head>
          <meta charset="utf-8">
          <title>Notificacion</title>
        </head>
        <body style="background-color: black ">
        <table padding: 10px; margin:0 auto; border-collapse: collapse; width=100%">
          <tr>
            <td style="padding: 0">
              <img style="padding: 0; display: block" src="https://i.postimg.cc/s2sXwCZS/Captura-Help-Desk.jpg" width="100%">
            </td>
          </tr>
          <tr>
            <td style="background-color: #ecf0f1">
              <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
                <h2 style="color: #e8bd6d; margin: 0 0 7px">Código de su reporte</h2>
                <p style="margin: 2px; font-size: 15px">
                  Le informamos que el incidente ha sido levantado correctamente, en unos minutos nuestro personal lo atenderá</p>
                
                <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
                  <h3>El codigo del incidente: '.$nServicio.'</h3>

                  <br>
                  <div style="width: 100%; text-align: center">
                    <form action="10.106.2.14/HelpDesk/consultar.php" method="post">
                      <div style="width: 100%;">
                          <input style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #fff; color: #000" type="hidden" id="name" name="idU" value='.$codigoI.'>
                          <input style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #fff; color: #000" type="hidden" id="name" name="nSer" value='.$nServicio.'>
                      </div>
                      
                      <button style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" type="submit" id="btn-Enviar">Consultar</button>
                    </form>
                  </div>
                </div>

                <p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">Coordinacion de tecnologias de la Información 2021</p>
              </div>
            </td>
          </tr>
        </table>
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
        <button type="submit" id="btn-Enviar">Quejas y sugerencias</button>';
        $mail->CharSet = 'CHARSET_ISO88591';
        $mail->send();
        echo $nServicio;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    ?>