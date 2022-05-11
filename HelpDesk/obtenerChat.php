<?php
    include 'conexion.php';
    session_start (); 
    $idP = $_SESSION["personal"]['id_Per'];
    $sql='SELECT * FROM conversacion WHERE id_Per=:per';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":per",$idP);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
    $numeroRegistros=$gsent->rowCount();
    
    if($numeroRegistros){
        echo "1";
    }
    else{
        if(isset($_COOKIE["hora"])){
            $hora=$_COOKIE["hora"];
            setCookie("hora",$hora,time()-300);
        }
    }
    
?>