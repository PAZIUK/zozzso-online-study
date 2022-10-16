<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/models/database.php";
  require_once $_SERVER['DOCUMENT_ROOT']."/models/codes.php";

  $result = CODES::isCodeExist($_GET["code"]);
  if(count($result)==1){
    echo $result[0]["Codes_ClassName"];
  };
?>