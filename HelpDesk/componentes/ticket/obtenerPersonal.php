<?php    
    include '../../conexion.php';
    $sql='SELECT * FROM personal WHERE activo_Per=1';
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
?>
    <option value=<?php echo "0";?>><?php echo "Sin asignar";?></option>
<?php foreach($resultado as $dato): ?>
    <option value=<?php echo $dato["id_Per"];?>><?php echo $dato["nombre_Per"];?></option>
<?php endforeach?>