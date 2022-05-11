<?php
    include '../conexion.php';
     
    $id=$_POST['id']; 
    
    $pdo->prepare('');
    $sqlT='SELECT id_Correo FROM `personal` WHERE id_Per=:per order by id_Correo DESC LIMIT 1';
    $gsent=$pdo->prepare($sqlT);
    $gsent->bindParam(":per",$id,PDO::PARAM_INT);
    $gsent->execute();
    $resultado = $gsent->fetchAll();

    $idCorreo=$resultado[0]["id_Correo"];
    $correo=$_POST['correo'];

    $sql= 'UPDATE correo SET correo=:cor WHERE id_Correo=:id';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindParam(":cor",$correo,PDO::PARAM_STR);
    $gsent->bindValue(":id",$idCorreo,PDO::PARAM_INT);
    $gsent->execute();

     echo "Hola";
     $fol=1;
     
     $nombre=$_POST['nombreP'];
     $apPat=$_POST['apPat'];
     $apMat=$_POST['apMat'];
     $apPat=$_POST['apPat'];
     $contra=$_POST['contra'];

     $dispo=$_POST['dispo'];
     
     echo $id;
     echo $nombre;
     echo $apPat;
     echo $apMat;
     echo $contra;
     echo $dispo;

    $sql= 'UPDATE personal SET nombre_Per=:nom, ap_Pat_Per=:app, ap_Mat_Per=:apm, contra_Per=:con, estado_Per=:edo WHERE id_Per=:id';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":id",$id,PDO::PARAM_INT);
    $gsent->bindParam(":nom",$nombre,PDO::PARAM_STR);
    $gsent->bindParam(":app",$apPat,PDO::PARAM_STR);
    $gsent->bindParam(":apm",$apMat,PDO::PARAM_STR);
    $gsent->bindParam(":con",$contra,PDO::PARAM_STR);
    $gsent->bindParam(":edo",$dispo,PDO::PARAM_INT);
    $gsent->execute();
?>