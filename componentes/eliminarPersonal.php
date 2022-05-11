<?php
     include '../conexion.php';
     $fol=$_POST['id'];
     $sql= 'DELETE FROM Personal WHERE id_Per=:id';
     $pdo->prepare('');
     $gsent=$pdo->prepare($sql);
     $gsent->bindValue(":id",$fol);
     $gsent->execute();
?>