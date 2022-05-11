<?php    
    include '../../conexion.php';
    
    $sql='SELECT * from ubicacion LEFT JOIN edificio on ubicacion.edificio_corresp=edificio.id_Edi';
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();

?>
<?php foreach($resultado as $dato): ?>
    <tr>
        <td><?php echo $dato['id_Ubi']; ?></td>
        <td><?php echo ($dato['ubicacion_des']); ?></td>
        <td><?php echo ($dato['edificio']); ?></td>
        <td class="c-acciones">
            <a href="#" class="edit"><i class="fas fa-edit"></i></a>
            <a href="#" class="destroy"><i class="fas fa-trash"></i></a>
        </td>
    </tr>
<?php endforeach?>