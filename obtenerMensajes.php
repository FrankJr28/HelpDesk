<?php    
    include 'conexion.php';
    session_start();
    $tecnico=$_SESSION["personal"]["id_Per"];
    $sql='SELECT * FROM conversacion WHERE id_Per=:idper';
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":idper",$tecnico);
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