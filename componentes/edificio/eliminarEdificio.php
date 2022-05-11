<?php
     include '../../conexion.php';
     $id=$_POST['id'];
     $sql= 'DELETE FROM edificio WHERE id_Edi=:fol';
     $pdo->prepare('');
     $gsent=$pdo->prepare($sql);
     $gsent->bindValue(":fol",$id);
     $gsent->execute();
?>
