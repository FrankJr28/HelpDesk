<?php
    session_start();
    if(!isset($_SESSION["personal"])){
        header("location:index.php");
    }
    include 'conexion.php';

    $login=$_SESSION["personal"]['id_Per']; 
    
    $pdo->prepare('');
    $sql="UPDATE personal SET estado_Per=0 WHERE id_Per=:login";
    $resultado=$pdo->prepare($sql);
    $resultado->bindValue(":login",$login);
    $resultado->execute();;

?>