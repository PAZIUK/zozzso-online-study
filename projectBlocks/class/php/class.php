<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/models/database.php";
  require_once $_SERVER['DOCUMENT_ROOT']."/models/schedule.php";

  echo SCHEDULE::scheduleFormatter();
?>