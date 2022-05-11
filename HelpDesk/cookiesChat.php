<?php
    include 'conexion.php';
    if(!(isset($_COOKIE["chat"]) && isset($_COOKIE["tecn"]))){
        $claveChat = random_int(1000000,3000000);
        $claveTecnico = $_POST["tecnico"];
        setCookie("chat",$claveChat,time()+3000);
        setCookie("tecn",$claveTecnico,time()+3000);
        
        //session_start (); 
        $sql= 'INSERT into conversacion (folio_con,id_Per) VALUES (:fol,:tec)';
        //$sql='Insert into conversacion () WHERE id_Per=:per';
        $pdo->prepare('');
        $gsent=$pdo->prepare($sql);
        $gsent->bindValue(":fol",$claveChat);
        $gsent->bindValue(":tec",$claveTecnico);
        $gsent->execute();
    }

        $claveTecnico=$_POST["tecnico"];
        $sqlT= 'SELECT nombre_Per FROM personal WHERE id_Per=:tec';
        //$sql='Insert into conversacion () WHERE id_Per=:per';
        $pdo->prepare('');
        $gsent=$pdo->prepare($sqlT);
        $gsent->bindValue(":tec",$claveTecnico);
        $gsent->execute();
        $resultado = $gsent->fetchAll();
        $t=$gsent->rowCount();
    

    if($t){
        echo $resultado[0]["nombre_Per"] . '<i id="chat-icon" style="color: red;" class="fas fa-times-circle" style="float: right" onclick="cerrarChat()"></i>';           
    }
?>