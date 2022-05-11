<?php
    include 'conexion.php';
    //session_start (); 
    $mensaje = $_POST["mensaje"];
    $tecnico = $_COOKIE["tecn"];
    $folio = $_COOKIE["chat"];
    $sql= 'INSERT into conversacion (folio_con,id_Per,mensaje_usuario) VALUES (:fol,:tec,:men)';
    //$sql='Insert into conversacion () WHERE id_Per=:per';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":fol",$folio);
    $gsent->bindValue(":tec",$tecnico);
    //$gsent->bindValue(":men",$mensaje);
    $gsent->bindValue(":men",$mensaje);
    $gsent->execute();
?>