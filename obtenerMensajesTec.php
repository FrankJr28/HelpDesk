<?php    
    include 'conexion.php';
    if(!isset($_COOKIE["conv"])){   //en caso de que sea la primer vez seteamos la cookie de conv
        session_start();
        //SELECT folio_con FROM conversacion WHERE id_Per=1 LIMIT 1
        $tecnico=$_SESSION["personal"]["id_Per"];
        $sql='SELECT folio_con FROM conversacion WHERE id_Per=:idper LIMIT 1';  //obtenemos el folio de la conversacion
        $gsent=$pdo->prepare($sql);
        $gsent->bindValue(":idper",$tecnico);
        $gsent->execute();
        $resultado = $gsent->fetchAll();
        $folio=$resultado[0]['folio_con'];
        setCookie("conv",$folio,time()+3600);
    }

    $folio = $_COOKIE["conv"];
    $sql='SELECT * FROM conversacion WHERE folio_con=:fol';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":fol",$folio);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
?>
<?php foreach($resultado as $dato): ?>
    <?php if($dato["mensaje_usuario"]): ?>
        <h5 id="chat-timestamp"><?php echo formatearFecha($dato["fh_con"]); ?></h5>
        <p id="botStarterMessage" class="botText"><span><?php echo $dato["mensaje_usuario"]; ?></span></p>
    <?php endif?>
    <?php if($dato["mensaje_per"]): ?>
        <h5 id="chat-timestamp"><?php echo formatearFecha($dato["fh_con"]); ?></h5>
        <p id="botStarterMessage" class="userText"><span><?php echo $dato["mensaje_per"]; ?></span></p>
    <?php endif?>
<?php endforeach?>