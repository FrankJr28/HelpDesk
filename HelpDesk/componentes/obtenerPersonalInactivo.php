<?php    
    include '../conexion.php';
    
    $sql='SELECT * from personal where activo_Per=0';
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();

?>
<?php foreach($resultado as $dato): ?>
    <tr>
        <td><?php echo $dato['id_Per']; ?></td>
        <td><?php echo ($dato['nombre_Per']); ?></td>
        <td><?php echo ($dato["ap_Pat_Per"]); ?></td>
        <td><?php echo ($dato["ap_Mat_Per"]); ?></td>
        <td><button class="up">Activar</button></td>
        <td class="c-acciones">
            <a href="#" class="destroy"><i class="fas fa-user-minus"></i></a>
        </td>
    </tr>
<?php endforeach?>