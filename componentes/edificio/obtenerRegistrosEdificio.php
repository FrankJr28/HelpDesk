<?php    
    include '../../conexion.php';
    
    $sql='SELECT * from edificio';
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();

?>
<?php foreach($resultado as $dato): ?>
    <tr>
        <td><?php echo $dato['id_Edi']; ?></td>
        <td><?php echo ($dato['edificio']); ?></td>
        <td class="c-acciones">
            <a href="#" class="edit"><i class="fas fa-edit"></i></a>
            <a href="#" class="destroy"><i class="fas fa-trash"></i></a>
        </td>
    </tr>
<?php endforeach?>