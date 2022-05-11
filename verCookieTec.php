<?php
if(isset($_COOKIE["hora"])){
    echo $_COOKIE["hora"];
}
else{
    echo "no existe hora";
}
?>