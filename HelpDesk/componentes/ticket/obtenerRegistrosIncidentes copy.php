<?php    
    
    include '../../conexion.php'; 
    session_start();   
    $sql='SELECT * from ticket LEFT JOIN ubicacion on ticket.id_Ubi = ubicacion.id_Ubi LEFT JOIN personal on ticket.id_Per = personal.id_Per';
    
    $gsent=$pdo->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();

?>
<?php foreach($resultado as $dato): ?>
    <tr>
        <td><?php echo $dato['id_tic']; ?></td>
        <td><?php echo ($dato['problema_tic']); ?></td>
        <td><?php echo ($dato["ubicacion_des"]); ?></td>
        <td><?php echo ($dato["id_Usu"]); ?></td>
        <td><?php echo ($dato["estado_tic"]); ?></td>

        <td><?php if($dato["id_Per"]){ echo ($dato["id_Per"]); } else{ echo "0"; }?></td>
        <td><?php if($dato["id_Per"]){ echo ($dato["nombre_Per"]); } else{ echo "Sin asignar"; }?></td>
        <td><?php echo date('Y-m-d', strtotime($dato["fh_tic"])); ?></td>
        <td><?php echo date('H:i', strtotime($dato["fh_tic"])); ?></td>
        <td class="c-acciones">
            <a href="#" class="edit"><i class="fas fa-edit"></i></a>
            <?php if($_SESSION["adminCta"][0]==1000): ?>   <!-- Que solo a superadmin le permita eliminar-->
                <a href="#" class="delete"><i class="fas fa-trash"></i></a>
            <?php endif ?>
        </td>
    </tr>
<?php endforeach?>