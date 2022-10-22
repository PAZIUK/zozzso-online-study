<?php
    session_start();
    
    require_once("models/database.php");
    require_once("models/config.php");  
    require_once("models/redirect.php");
    require_once("models/schedule.php");
    require_once("models/codes.php");
    require_once("models/lessons.php");

    require_once("layout/head.php");

    if(isset($_GET["action"])){
        $a = $_GET["action"];
        if (file_exists("views/".$a.".php")) {
            require_once("views/".$a.".php");
        } else {
            REDIRECT::toErrorPage();
        }
    } else {
        require_once("views/main.php");
    }
?>