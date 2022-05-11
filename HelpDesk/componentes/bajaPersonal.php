<?php
    include '../conexion.php';
    $id=$_POST['id'];
    
    $sql = "UPDATE personal SET activo_Per = 0, estado_Per=0 WHERE id_Per =:id";
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":id",$id);
    $gsent->execute();
?>