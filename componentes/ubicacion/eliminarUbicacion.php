<?php
     include '../../conexion.php';
     $id=$_POST['id'];
     $sql= 'DELETE FROM ubicacion WHERE id_Ubi=:fol';
     $pdo->prepare('');
     $gsent=$pdo->prepare($sql);
     $gsent->bindValue(":fol",$id);
     $gsent->execute();
?>