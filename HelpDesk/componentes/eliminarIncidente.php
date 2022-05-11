<?php
     include '../conexion.php';
     $fol=$_POST['folio'];
     $sql= 'DELETE FROM ticket WHERE id_tic=:fol';
     $pdo->prepare('');
     $gsent=$pdo->prepare($sql);
     $gsent->bindValue(":fol",$fol);
     $gsent->execute();
?>