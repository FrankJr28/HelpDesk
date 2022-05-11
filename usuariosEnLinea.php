<?php    
    include 'conexion.php';
    $sql='SELECT id_Per, nombre_Per, ap_Pat_Per FROM personal WHERE estado_Per=1';
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
?>
<?php foreach($resultado as $dato): ?>
    <div class="personal">
        <a href="#" onclick="comenzarConversacion('<?php echo $dato["id_Per"]; ?>')"> <?php echo $dato["nombre_Per"];?></a>
    </div>
<?php endforeach?>