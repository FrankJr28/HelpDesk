<?php
    session_start();
    if(!isset($_SESSION["personal"])){
        header("location:index.php");
    }
    include 'conexion.php';

    $pdo->prepare('');
    $sql="SELECT estado_Per FROM personal WHERE id_Per=:login";
    $resultado=$pdo->prepare($sql);
    $login=$_SESSION["personal"]['id_Per']; 
    $resultado->bindValue(":login",$login);
    $resultado->execute();
    $ar=$resultado->fetchAll();
    //$numeroRegistros=$resultado->rowCount();
    
    echo $ar[0]["estado_Per"];

?>