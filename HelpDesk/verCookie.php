<?php
if(isset($_COOKIE["chat"])){
    echo $_COOKIE["chat"];
}
else{
    echo "no existe chat";
}
if(isset($_COOKIE["tecn"])){
    echo "    usu" . $_COOKIE["tecn"];
}
else{
    echo "no existe tecn";
}

?>