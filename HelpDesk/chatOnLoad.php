<?php
    include 'conexion.php';
    if(isset($_COOKIE["chat"])){
        $t = 0;

        $folio=$_COOKIE["chat"];
        $sqlT= 'SELECT id_Per FROM conversacion WHERE folio_con=:fol limit 1';
        $pdo->prepare('');
        $gsent=$pdo->prepare($sqlT);
        $gsent->bindValue(":fol",$folio);
        $gsent->execute();
        $resultado = $gsent->fetchAll();
        $t=$gsent->rowCount();
        

        if($t){
            $auxid = $resultado[0]['id_Per'];
            $sqlT= 'SELECT nombre_Per FROM personal WHERE id_Per=:id';
            $pdo->prepare('');
            $gsent=$pdo->prepare($sqlT);
            $gsent->bindValue(":id",$auxid);
            $gsent->execute();
            $resultado = $gsent->fetchAll();
            $t=$gsent->rowCount();
            echo $resultado[0]["nombre_Per"] . '<i id="chat-icon" style="color: red;" class="fas fa-times-circle" style="float: right" onclick="cerrarChat()"></i>';       
        }
    }
    else{
        echo "0";
    }
?>