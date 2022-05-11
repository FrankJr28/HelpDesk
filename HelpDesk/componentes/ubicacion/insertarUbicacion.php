<?php
    //INSERT INTO `personal` (`nombre_Per`, `ap_Pat_Per`, `ap_Mat_Per`, `contra_Per`, `estado_Per`, `activo_Per`) VALUES ('Francisco', 'Vasquez', 'Jr', 'fran1234', b'1', b'1');
    include '../../conexion.php';
    $lugarI=$_POST['LugarI'];
    $edificioI=$_POST['EdificioI'];
    echo $edificioI;
    //UPDATE `personal` SET `nombre_Per` = 'Alejandro Miguel', `ap_Pat_Per` = 'Gil', `ap_Mat_Per` = 'Vázquez', `contra_Per` = 'Miguel1234', `estado_Per` = b'1', `activo_Per` = b'1' WHERE `personal`.`id_Per` = 3;
    $sql= 'INSERT INTO ubicacion (ubicacion_des, edificio_corresp) VALUES (:ubi,:edi);';
    //$sql= 'DELETE FROM ticket WHERE id_tic=:fol';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindParam(":ubi",$lugarI,PDO::PARAM_STR);
    $gsent->bindParam(":edi",$edificioI,PDO::PARAM_INT);
    $gsent->execute();
?>