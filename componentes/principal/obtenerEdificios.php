<?php    
    include '../../conexion.php';
    $sql='SELECT * FROM edificio';
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
?>
<?php foreach($resultado as $dato): ?>
    <option value=<?php echo $dato["id_Edi"];?>><?php echo $dato["edificio"];?></option>
<?php endforeach?>