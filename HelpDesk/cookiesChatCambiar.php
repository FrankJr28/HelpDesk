<?php
    $fol = $_COOKIE["chat"];
    $tecn = $_COOKIE["tecn"];
    include 'conexion.php';
    $sql= 'DELETE FROM conversacion WHERE folio_con=:fol';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":fol",$fol);
    $gsent->execute();
    setCookie("chat",$fol,time()-3000);
    setCookie("tecn",$tecn,time()-3000);


    $claveChat = random_int(1000000,3000000);
    $claveTecnico = $_POST["tecnico"];
    setCookie("chat",$claveChat,time()+3600);
    setCookie("tecn",$claveTecnico,time()+3600);
    //session_start (); 
    $sql= 'INSERT into conversacion (folio_con,id_Per) VALUES (:fol,:tec)';
    //$sql='Insert into conversacion () WHERE id_Per=:per';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":fol",$claveChat);
    $gsent->bindValue(":tec",$claveTecnico);
    $gsent->execute();

    $sqlT= 'SELECT nombre_Per FROM personal WHERE id_Per=:tec';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sqlT);
    $gsent->bindValue(":tec",$claveTecnico);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
    $t=$gsent->rowCount();
    

    if($t){
        echo $resultado[0]["nombre_Per"] . '<i id="chat-icon" style="color: red;" class="fas fa-times-circle" style="float: right" onclick="cerrarChat()"></i>';          
    }

/*
    $claveChat = random_int(1000000,3000000);
    setCookie("chat",$claveChat,time()+3000);
    echo "1 se cambió";
    include 'conexion.php';
    $tec = $_POST["tecnico"];
    $sql= 'INSERT into conversacion (folio_con,id_Per) VALUES (:fol,:tec)';
    
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":fol",$claveChat);
    $gsent->bindValue(":tec",$tec);
    $gsent->execute();
    */
?>