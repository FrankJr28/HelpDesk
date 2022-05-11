<?php    
    if(isset($_COOKIE["chat"])){//Validamos que la cookie de chat este setteada, esto para evitar errores 
        include 'conexion.php';
        $folio = $_COOKIE["chat"];
        $sql='SELECT * FROM conversacion WHERE folio_con=:fol';
        $pdo->prepare('');
        $gsent=$pdo->prepare($sql);
        $gsent->bindValue(":fol",$folio);
        $gsent->execute();
        $resultado = $gsent->fetchAll();
    }
    else{
        echo "0";
    }
?>
<?php if(isset($_COOKIE["chat"])):?>    
<?php foreach($resultado as $dato): ?>
    <?php if($dato["mensaje_usuario"]): ?>
        <h5 id="chat-timestamp"><?php echo formatearFecha($dato["fh_con"]); ?></h5>
        <p id="botStarterMessage" class="userText"><span><?php echo $dato["mensaje_usuario"]; ?></span></p>
    <?php endif?>
    <?php if($dato["mensaje_per"]): ?>
        <h5 id="chat-timestamp"><?php echo formatearFecha($dato["fh_con"]); ?></h5>
        <p id="botStarterMessage" class="botText"><span><?php echo $dato["mensaje_per"]; ?></span></p>
    <?php endif?>
<?php endforeach?>
<?php endif ?>