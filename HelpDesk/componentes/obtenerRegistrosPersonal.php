<?php    
    include '../conexion.php';
    //SELECT * FROM personal LEFT JOIN correo ON personal.id_Correo = correo.id_Correo
    $sql='SELECT * from personal LEFT JOIN correo ON personal.id_Correo = correo.id_Correo WHERE activo_Per=1';
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
        <td><?php echo ($dato["correo"]); ?></td>
        <td><?php echo ($dato["contra_Per"]); ?></td>
        <td><?php echo ($dato["estado_Per"]); ?></td>
        <td class="c-acciones">
            <a href="#" class="edit"><i class="fas fa-edit"></i></a>
            <a href="#" class="delete"><i class="fas fa-trash"></i></a>
        </td>
    </tr>
<?php endforeach?>