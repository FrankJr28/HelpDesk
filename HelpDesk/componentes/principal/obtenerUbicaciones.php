<?php    
    include '../../conexion.php';
    $sql='SELECT * FROM ubicacion';
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
?>
<?php foreach($resultado as $dato): ?>
    <option value=<?php echo $dato["id_Ubi"];?>><?php echo $dato["ubicacion_des"];?></option>
<?php endforeach?>