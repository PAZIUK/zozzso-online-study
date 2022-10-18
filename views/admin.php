<?php
  if(!isset($_SESSION["isAdmin"])||isset($_SESSION["isAdmin"])&&$_SESSION["isAdmin"]==false){
    REDIRECT::toErrorPage();
  }
?>