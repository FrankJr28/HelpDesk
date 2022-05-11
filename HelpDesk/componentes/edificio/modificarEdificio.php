<?php
    include '../../conexion.php';
    echo "Hola";
    $fol=1;
    $id=$_POST['id'];
    $edificio=$_POST['Edificio'];

    //UPDATE `personal` SET `nombre_Per` = 'Alejandro Miguel', `ap_Pat_Per` = 'Gil', `ap_Mat_Per` = 'Vázquez', `contra_Per` = 'Miguel1234', `estado_Per` = b'1', `activo_Per` = b'1' WHERE `personal`.`id_Per` = 3;
    $sql= 'UPDATE edificio SET edificio=:edi WHERE id_Edi=:id';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":id",$id,PDO::PARAM_INT);
    $gsent->bindParam(":edi",$edificio,PDO::PARAM_STR);
    $gsent->execute();
?>