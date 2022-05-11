<?php
    include 'conexion.php';

    session_start (); 

    $tecnico=$_SESSION["personal"]["id_Per"];

    $sql= 'DELETE FROM conversacion WHERE id_Per=:tec';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":tec",$tecnico);
    $gsent->execute();
    if(isset($_COOKIE["hora"])){
        $hora=$_COOKIE["hora"];
        setCookie("hora",$hora,time()-300);
    }
        
?>