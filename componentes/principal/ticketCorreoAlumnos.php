<?php
    include '../../conexion.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer/Exception.php';
    require '../../PHPMailer/PHPMailer.php';
    require '../../PHPMailer/SMTP.php';

    $corI = "franja10028@gmail.com";

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'francisco.vasquezjr@alumnos.udg.mx';                     //SMTP username
        $mail->Password   = '1B7C50F6DA';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('francisco.vasquezjr@alumnos.udg.mx', 'HelpDesk');
        $mail->addAddress($corI);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Servicio HelpDesk ';
        $mail->Body    = '<!DOCTYPE html>
        <html lang="es">
        <head>
          <meta charset="utf-8">
          <title>Notificacion</title>
        </head>
        <body style="background-color: black ">
        <table padding: 10px; margin:0 auto; border-collapse: collapse;">
          <tr>
            <td style="padding: 0">
              <img style="padding: 0; display: block" src="https://i.postimg.cc/s2sXwCZS/Captura-Help-Desk.jpg" width="100%">
            </td>
          </tr>
          <tr>
            <td style="background-color: #ecf0f1">
              <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
                <h2 style="color: #e8bd6d; margin: 0 0 7px">Código de su servicio</h2>
                <p style="margin: 2px; font-size: 15px">
                  Le informamos que el incidente ha sido levantado correctamente, en unos minutos atienden su solicitud:</p>
                
                <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
                  <h3>El codigo del incidente: 2021</h3>

                  <div style="width: 100%; text-align: center">
                    <form action="http://localhost/HelpDesk/QuejasySugerencias.php" method="post">
                      <div style="width: 100%;">
                          <input style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #fff; color: #000" type="hidden" id="name" name="nServicio" value=2021>
                          <input style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #fff; color: #000" type="hidden" id="name" name="token" value=158>
                     
                      </div>
                      
                      <button style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" type="submit" id="btn-Enviar">Quejas y sugerencias</button>
                    </form>
                  </div>
                  <br>
                  <div style="width: 100%; text-align: center">
                    <form action="http://localhost/HelpDesk/consultar.php" method="post">
                      <div style="width: 100%;">
                          <input style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #fff; color: #000" type="hidden" id="name" name="idU" value=218887444>
                          <input style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #fff; color: #000" type="hidden" id="name" name="nSer" value=2021>
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
        El codigo de su servicio es 2021, podrá consultar el estado de este en el apartado consultas.
        </p>
        <br>
        <form action="obtienepruebaform.php" method="post">
        <input style="visibility:hidden backgroud-color:red" type="text" id="name" name="codigoI" value="2021">
        <button type="submit" id="btn-Enviar">Quejas y sugerencias</button>';
        $mail->CharSet = 'CHARSET_ISO88591';
        $mail->send();
        echo "SERVICIO ENVIADO";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    ?>