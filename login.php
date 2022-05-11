<?php
    try{
        include 'conexion.php';
        $pdo->prepare('');
        $sql="SELECT * FROM personal WHERE id_Per=:login AND contra_Per=:password";
        $resultado=$pdo->prepare($sql);
        $login=htmlentities(addslashes($_POST["login"]));
        $password=htmlentities(addslashes($_POST["password"]));
        $resultado->bindValue(":login",$login);
        $resultado->bindValue(":password",$password);
        $resultado->execute();
        $ar=$resultado->fetchAll();
        $numeroRegistros=$resultado->rowCount();
        
        if($numeroRegistros!=0){
            session_start();
            $_SESSION["personal"]=$ar[0];
            header("location:indexcta.php");
        }
        else{
            $pdo->prepare('');
            $sql="SELECT * FROM administrador WHERE id_Admin=:login AND contra_Admin=:password";
            $resultado=$pdo->prepare($sql);
            $resultado->bindValue(":login",$login);
            $resultado->bindValue(":password",$password);
            $resultado->execute();
            $ar=$resultado->fetchAll();
            $numeroRegistros=$resultado->rowCount();
            if($numeroRegistros!=0){
                session_start();
                $_SESSION["adminCta"]=$ar[0];
                header("location:admin.php");
            }
            else{
                header("location:index.php");
            }
        }
    }catch(Exception $e){
        die("Error: " . $e->getMessage());
    }
?>