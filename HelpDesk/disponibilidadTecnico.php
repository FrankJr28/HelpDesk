<?php
    include 'conexion.php';
    session_start (); 
    $idP = $_POST["tecnico"];
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
        echo "0";
    }
    
?>