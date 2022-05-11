<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $codigo=218887444;
    ?>
    <form action="obtienepruebaform.php" method="post">
        <?php echo "<input type='text' id='name' name='codigoI' value='$codigo' style='visibility:hidden'>"?>
        <button type="submit" id="btn-Enviar">Quejas y sugerencias</button>
    </form>
</body>
</html>