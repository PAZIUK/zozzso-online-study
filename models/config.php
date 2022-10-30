<?php
	class CONFIG
	{
		public static function getDayName($day){
			$dayName = "";
			switch ($day) {
				case 1:
					$dayName = "ПОНЕДІЛОК";
					break;

				case 2:
					$dayName = "ВІВТОРОК";
					break;

				case 3:
					$dayName = "СЕРЕДА";
					break;

				case 4:
					$dayName = "ЧЕТВЕР";
					break;

				case 5:
					$dayName = "П'ЯТНИЦЯ";
					break;
			}
			return $dayName;
		}
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
		public static function getBtnRedirectTo(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_config` WHERE `Config_Name`='BtnRedirectTo'";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["Config_Value"];
		}
		public static function setTitle($title){
			$mysqli = DATABASE::Connect();
			$sql = "UPDATE `zozzso-online-study_config` SET `Config_Value` = ? WHERE `zozzso-online-study_config`.`Config_Name`='Title'";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("s", $title);
			$stmt->execute();
		}
		public static function setDescription($description){
			$mysqli = DATABASE::Connect();
			$sql = "UPDATE `zozzso-online-study_config` SET `Config_Value` = ? WHERE `zozzso-online-study_config`.`Config_Name`='Description'";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("s", $description);
			$stmt->execute();
		}
		public static function setBtnRedirectTo($btnRedirectTo){
			$mysqli = DATABASE::Connect();
			$sql = "UPDATE `zozzso-online-study_config` SET `Config_Value` = ? WHERE `zozzso-online-study_config`.`Config_Name`='BtnRedirectTo'";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("s", $btnRedirectTo);
			$stmt->execute();
		}
		public static function setSettings($post){
			if(isset($post["Title"])){
				self::setTitle($post["Title"]);
			}
			if(isset($post["Description"])){
				self::setDescription($post["Description"]);
			}
			if(isset($post["BtnRedirectTo"])){
				self::setBtnRedirectTo($post["BtnRedirectTo"]);
			}
		}
	}
?>