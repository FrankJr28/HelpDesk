<?php
    include 'conexion.php';
    session_start (); 
    $idP = $_SESSION["personal"]['id_Per'];

    $sql2='SELECT folio_con, fh_con FROM conversacion WHERE id_Per=:idper LIMIT 1';  //obtenemos el folio de la conversacion
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql2);
    $gsent->bindValue(":idper",$idP);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
    $fecha=$resultado[0]['fh_con'];
    
    $format = "Y-m-d H:i:s";
    $dateobj = DateTime::createFromFormat($format, $fecha);
    $unix=date_format($dateobj, 'U');
    $unix=$unix+300;
        
    $t=time();
    //echo $_COOKIE["hora"] . " time ";
    //echo time();
    if($t>$unix){//+tiempo de duracion despues de crear la conversacion
        echo "2";
        $sql= 'DELETE FROM conversacion WHERE id_Per=:tec';
        $pdo->prepare('');
        $gsent=$pdo->prepare($sql);
        $gsent->bindValue(":tec",$idP);
        $gsent->execute();
        $u=$_COOKIE["hora"];
        setCookie("hora",$u,time()-3000);
    }
?>