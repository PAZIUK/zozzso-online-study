<?php
    session_start();
    
    require_once("models/database.php");
    require_once("models/config.php");  
    require_once("models/redirect.php");

    require_once("layout/head.php");

    if(isset($_GET["action"])){
        $a = $_GET["action"];
        if (file_exists("views/".$a.".php")) {
            require_once("views/".$a.".php");
        }	else {
            REDIRECT::toUserHome();
        }
    }
    else {
        require_once("views/main.php");
    }
?>