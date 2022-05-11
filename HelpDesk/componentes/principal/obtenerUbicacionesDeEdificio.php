<?php    
    include '../../conexion.php';
    $idEdi=$_POST['idEdi'];
    $sql='SELECT * FROM ubicacion where edificio_corresp=:ediCorresp';

    $gsent=$pdo->prepare($sql);
    $gsent->bindParam(":ediCorresp",$idEdi,PDO::PARAM_STR);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
?>
<?php foreach($resultado as $dato): ?>
    <option value=<?php echo $dato["id_Ubi"];?>><?php echo $dato["ubicacion_des"];?></option>
<?php endforeach?>