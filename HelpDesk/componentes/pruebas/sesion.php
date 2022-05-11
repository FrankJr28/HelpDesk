<?php
    session_start();
    if($_SESSION["adminCta"][0]==10)
        echo $_SESSION["adminCta"][0];
?>