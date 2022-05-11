<?php
    //INSERT INTO `personal` (`nombre_Per`, `ap_Pat_Per`, `ap_Mat_Per`, `contra_Per`, `estado_Per`, `activo_Per`) VALUES ('Francisco', 'Vasquez', 'Jr', 'fran1234', b'1', b'1');
    include '../conexion.php';
    $correo=$_POST['correoI'];
    $sql= 'INSERT INTO correo (correo) VALUES (:cor);';
    //$sql= 'DELETE FROM ticket WHERE id_tic=:fol';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindParam(":cor",$correo,PDO::PARAM_STR);
    $gsent->execute();

    $pdo->prepare('');
    $sqlT='SELECT id_Correo FROM `correo` WHERE correo=:cor order by id_Correo DESC LIMIT 1';
    $gsent=$pdo->prepare($sqlT);
    //$gsentT=$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    $gsent->bindParam(":cor",$correo,PDO::PARAM_STR);
    $gsent->execute();
    $resultado = $gsent->fetchAll();

    $idCorreo=$resultado[0]["id_Correo"];
    $nombre=$_POST['nombrePI'];
    $apPat=$_POST['apPatI'];
    $apMat=$_POST['apMatI'];
    $contra=$_POST['contraI'];

    //UPDATE `personal` SET `nombre_Per` = 'Alejandro Miguel', `ap_Pat_Per` = 'Gil', `ap_Mat_Per` = 'Vázquez', `contra_Per` = 'Miguel1234', `estado_Per` = b'1', `activo_Per` = b'1' WHERE `personal`.`id_Per` = 3;
    $sql= 'INSERT INTO personal (nombre_Per, ap_Pat_Per, ap_Mat_Per, contra_Per, id_Correo) VALUES (:nom, :app, :apm, :con, :cor);';
    //$sql= 'DELETE FROM ticket WHERE id_tic=:fol';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindParam(":nom",$nombre,PDO::PARAM_STR);
    $gsent->bindParam(":app",$apPat,PDO::PARAM_STR);
    $gsent->bindParam(":apm",$apMat,PDO::PARAM_STR);
    $gsent->bindParam(":con",$contra,PDO::PARAM_STR);
    $gsent->bindParam(":cor",$idCorreo,PDO::PARAM_INT);
    $correcto=$gsent->execute();
    if($correcto){
        echo "correcto";
    }
?>