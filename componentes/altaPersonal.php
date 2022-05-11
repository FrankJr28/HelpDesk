<?php
    include '../conexion.php';
    $id=$_POST['id'];
    
    $sql = "UPDATE personal SET activo_Per = 1 WHERE id_Per =:id";
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":id",$id);
    $gsent->execute();
?>