<?php
    include 'conexion.php';

    if(isset($_COOKIE["chat"])){

        $fol = $_COOKIE["chat"];
        $sql='SELECT * FROM conversacion WHERE folio_con=:fol';
        $pdo->prepare('');
        $gsent=$pdo->prepare($sql);
        $gsent->bindValue(":fol",$fol);
        $gsent->execute();
        $resultado = $gsent->fetchAll();
        $numeroRegistros=$gsent->rowCount();
        
        if($numeroRegistros){
            echo "1";
        }
        else{
            setCookie("chat",$fol,time()-3000);
            if(isset($_COOKIE["tecn"])){
                setCookie("tecn",$tecn,time()-3000);
            }
            
        }
        
    }
?>