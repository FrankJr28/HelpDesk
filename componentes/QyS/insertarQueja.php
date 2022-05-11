<?php
    include '../../conexion.php';
    $s=$_POST['sugerencia'];
    $c=$_POST['calif'];
    //echo var_dump($_POST);
    $id_t=$_POST['tic'];
    $to=$_POST['toc'];
//INSERT INTO queysug (id_tictok, calif, qsoc) VALUES (92,10,'Excelente servicio')
    $sql = "INSERT INTO queysug (id_tictok, calif, qsoc) VALUES (:t,:c,:s)";
    $pdo->prepare('');
    $gsent=$pdo->prepare($sql);
    $gsent->bindValue(":t",$id_t);
    $gsent->bindValue(":c",$c);
    $gsent->bindValue(":s",$s);
    $qS=$gsent->execute();
    if($qS){
        $pdo->prepare('');
        $sql= 'DELETE FROM toqys WHERE id_tok=:token';
        $gsent=$pdo->prepare($sql);
        $gsent->bindValue(":token",$to);
        $qS=$gsent->execute();
        if($qS)
            echo "ok";
    }
?>