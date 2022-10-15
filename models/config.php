<?php
	class CONFIG
	{
		public static function getTitle(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_config` WHERE `Config_Name`='Title'";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["Config_Value"];
		}
		public static function getDescription(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_config` WHERE `Config_Name`='Description'";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["Config_Value"];
		}
	}
?>