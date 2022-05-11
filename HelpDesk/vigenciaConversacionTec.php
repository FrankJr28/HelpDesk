<?php
    include 'conexion.php';
    session_start (); 
    if(isset($_COOKIE["conv"])){
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
            $fol = $_COOKIE["conv"];
            setCookie("conv",$fol,time()-3000);
        }
    }
    else{
        $idP = $_SESSION["personal"]['id_Per'];
        $sql='SELECT * FROM conversacion WHERE id_Per=:per';
        $pdo->prepare('');
        $gsent=$pdo->prepare($sql);
        $gsent->bindValue(":per",$idP);
        $gsent->execute();
        $resultado = $gsent->fetchAll();
        $numeroRegistros=$gsent->rowCount();
        
        if($numeroRegistros){
            $sql='DELETE FROM conversacion WHERE id_Per=:per';
            $pdo->prepare('');
            $gsent=$pdo->prepare($sql);
            $gsent->bindValue(":per",$idP);
            $gsent->execute();
        }
    }

?>