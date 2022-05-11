<?php
     include '../conexion.php';
     echo "Hola";
     $fol=1;
     $id="1";
     $nombre="Gilberte";
     $apPat="Saldaña";
     $apMat="Perez";
     
     $contra="gil123";

     //$dispo=1;
     //$activo=1;
     $dispo="1";
     $activo="1";
     //echo $_POST['dispo'];
     //echo $_POST['activo'];
     
     echo $id;
     echo $nombre;
     echo $apPat;
     echo $apMat;
     echo $contra;
     echo $dispo;
     echo $activo;

     //UPDATE `personal` SET `nombre_Per` = 'Alejandro Miguel', `ap_Pat_Per` = 'Gil', `ap_Mat_Per` = 'Vázquez', `contra_Per` = 'Miguel1234', `estado_Per` = b'1', `activo_Per` = b'1' WHERE `personal`.`id_Per` = 3;
     $sql= 'UPDATE personal SET nombre_Per=:nom, ap_Pat_Per=:app, ap_Mat_Per=:apm, contra_Per=:con, estado_Per=:edo, activo_Per=:act WHERE id_Per=:id';
     //$sql= 'DELETE FROM ticket WHERE id_tic=:fol';
     $pdo->prepare('');
     $gsent=$pdo->prepare($sql);
     $gsent->bindValue(":id",$id,PDO::PARAM_INT);
    $gsent->bindParam(":nom",$nombre,PDO::PARAM_STR);
    $gsent->bindParam(":app",$apPat,PDO::PARAM_STR);
    $gsent->bindParam(":apm",$apMat,PDO::PARAM_STR);
    $gsent->bindParam(":con",$contra,PDO::PARAM_STR);
    $gsent->bindParam(":edo",$dispo,PDO::PARAM_INT);
    $gsent->bindParam(":act",$activo,PDO::PARAM_INT);
    $gsent->execute();
?>