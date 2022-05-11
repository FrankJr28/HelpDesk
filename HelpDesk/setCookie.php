<?php
    
        $claveChat = random_int(1000000,3000000);
        setCookie("chat",$claveChat,time()+3600);
        echo $_COOKIE["chat"];
        
    
?>