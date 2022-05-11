<?php
    include 'conexion.php';
    session_start (); 

    $tecnico=$_SESSION["personal"]["id_Per"];

    $sql='SELECT folio_con FROM conversacion WHERE id_Per=:idper LIMIT 1';  //obtenemos el folio de la conversacion
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":idper",$tecnico);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
    $folio=$resultado[0]['folio_con'];
    setCookie("conv",$folio,time()+30);

    //$folio = $_COOKIE["conv"];
    $mensaje = $_POST["mensaje"];
    $sql= 'INSERT into conversacion (folio_con,id_Per,mensaje_per) VALUES (:fol,:tec,:men)';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":fol",$folio);
    $gsent->bindValue(":tec",$tecnico);
    $gsent->bindValue(":men",$mensaje);
    $gsent->execute();
?>