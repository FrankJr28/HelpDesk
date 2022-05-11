<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript">
        var areYouReallySure=false;
        var internalLink = false;
        function areYouSure(){
            if(allowPrompt){
                if(!areYouReallySure && !internalLink && true){
                    areYouReallySure = true;
                    //var confMessage = "deseas salir"
                    var confMessage = "***************************************nn E S P E R A !!! nnAntes de abandonar nuestra web, síguenos en nuestras redes sociales como Facebook, Twitter o Instagram.nnnYA PUEDES HACER CLIC EN EL BOTÓN CANCELAR SI QUIERES...nn***************************************";
                    return confMessage;        
                }
                else{
                    allowPrompt = true;
                }
            }
        }
        allowPrompt = true;
        window.onbeforeunload = areYouSure;

        
    </script>
</head>
<body>
    <div class="center">
        <input type="checkbox">
    </div>
    <link rel="stylesheet" type="text/css" href="css/lol.css">
</body>
</html>