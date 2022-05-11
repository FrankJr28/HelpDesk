<?php
    include '../../conexion.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer/Exception.php';
    require '../../PHPMailer/PHPMailer.php';
    require '../../PHPMailer/SMTP.php';

    $id=$_POST['id'];
    $problema=$_POST['problema'];
    $tecnico=$_POST['tecnico'];
    $estado=$_POST['estado'];
    echo "el id es " . $id . "hasta";
    
    $pdo->prepare('');    
    $sql='SELECT correo.correo FROM personal LEFT JOIN correo ON personal.id_Correo = correo.id_Correo WHERE id_Per = :tec';
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":tec",$tecnico,PDO::PARAM_INT);
    $gsent->execute();
    $c=$gsent->fetchAll();
    $corI=$c[0][0];

    //select correo.correo from personal left join correo on personal.id_Correo = correo.id_Correo where id_Per = 11 
    $sql='SELECT id_Per FROM ticket WHERE id_tic=:id';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":id",$id,PDO::PARAM_INT);
    $gsent->execute();
    $idTec=$gsent->fetchAll();
    echo "id= " . $idTec[0][0] . " enviado= " . $tecnico;

    if($idTec[0][0]!=$tecnico){
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
            $mail->setFrom('francisco.vasquezjr@alumnos.udg.mx', 'Javier Vasquez');
            $mail->addAddress($corI);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Servicio HelpDesk '.$id;
            $mail->Body    = '<!DOCTYPE html>
            <html lang="es">
            <head>
            <meta charset="utf-8">
            <title>Notificacion</title>
            </head>
            <body style="background-color: black ">
            <table padding: 10px; margin:0 auto; border-collapse: collapse;  width=100%">
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
                    Hola. Se te ha asignado un nuevo incicdente:</p>
                    
                    <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
                    <h3>El código del incidente: '.$id.'</h3>

                    
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
            El codigo de su servicio es '. $id .', podrá consultar el estado de este en el apartado consultas.
            </p>
            <br>
            <form action="obtienepruebaform.php" method="post">
            <input style="visibility:hidden backgroud-color:red" type="text" id="name" name="codigoI" value='.$id.'>
            <button type="submit" id="btn-Enviar">Quejas y sugerencias</button>';
            $mail->CharSet = 'CHARSET_ISO88591';
            $mail->send();
            echo $id;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    if($estado=="Finalizado"){

        $pdo->prepare('');    
        $sql='SELECT ticket.estado_tic FROM ticket WHERE id_tic = :tic';
        //SELECT ticket.estado_tic, toqys.id_tok FROM ticket LEFT JOIN ticket.id_tic = toqys.id_tic
        $gsent=$pdo->prepare($sql);
        $gsent->bindValue(":tic",$id,PDO::PARAM_INT);
        $gsent->execute();
        $t=$gsent->fetchAll();
        $edoT=$t[0][0];

        if($edoT!="Finalizado"){

            $pdo->prepare('');    
            $sql='SELECT correo_Usu, nombre_Usu, toqys.id_tok FROM ticket LEFT JOIN usuario ON ticket.id_Usu = usuario.id_Usu LEFT JOIN toqys ON ticket.id_tic = toqys.id_tic where ticket.id_tic = :tic';
            $gsent=$pdo->prepare($sql);
            $gsent->bindValue(":tic",$id,PDO::PARAM_INT);
            $gsent->execute();
            $cU=$gsent->fetchAll();
            $corI=$cU[0][0];
            $nomUsu=$cU[0][1];
            $token=$cU[0][2];
            //SELECT ticket.estado_tic, toqys.id_tok FROM ticket LEFT JOIN toqys on ticket.id_tic = toqys.id_tic
            $mail = new PHPMailer(true);
            if($token){
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
                    $mail->Subject = 'Servicio HelpDesk '.$id;
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
                            <h2 style="color: #e8bd6d; margin: 0 0 7px">Código de su servicio</h2>
                            <p style="margin: 2px; font-size: 15px">
                            Hola, '.$nomUsu.'. Le informamos que el incidente '.$id.' que usted reportó ha finalizado.
                            </p>
                            <br>
                            <p style="margin: 2px; font-size: 15px">
                            Lo invitamos a que comparta su experiencia, pulse en el botón quejas y sugerencias, para nosotros es importante conocer como fue la atención brindada por nuestro personal. 
                            </p>
                            <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
                            
                            

                            <div style="width: 100%; text-align: center">
                                <form action="10.106.2.14/HelpDesk/QuejasySugerencias.php" method="post">
                                <div style="width: 100%;">
                                    <input style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #fff; color: #000" type="hidden" name="nS" value='.$id.'>                            
                                    <input style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #fff; color: #000" type="hidden" name="t" value='.$token.'>
                                </div> 
                                <button style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" type="submit" id="btn-Enviar">Quejas y sugerencias</button>
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

                    
                    $mail->CharSet = 'CHARSET_ISO88591';
                    $mail->send();
                    echo "token = ".$token;
                    echo $corI;
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }//if del token
        }
    }
    
    $sql= 'UPDATE ticket SET problema_tic=:prob, id_Per=:tec, estado_tic=:edo WHERE id_tic=:id';
    //$sql= 'DELETE FROM ticket WHERE id_tic=:fol';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":id",$id,PDO::PARAM_INT);
    
    $gsent->bindParam(":prob",$problema,PDO::PARAM_STR);
    $gsent->bindParam(":tec",$tecnico,PDO::PARAM_INT);
    $gsent->bindParam(":edo",$estado,PDO::PARAM_STR);
    $gsent->execute();
?>