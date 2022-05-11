<?php
    $fol = $_COOKIE["chat"];
    $tecn = $_COOKIE["tecn"];
    include 'conexion.php';
    $sql= 'DELETE FROM conversacion WHERE folio_con=:fol';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":fol",$fol);
    $gsent->execute();
    setCookie("chat",$fol,time()-3000);
    setCookie("tecn",$tecn,time()-3000);
?>