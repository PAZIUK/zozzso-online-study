<?php
	class CODES
	{
		public static function isCodeExist($code){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_codes` WHERE `Codes_Code`= ? ";
			$stmt = $mysqli->prepare($sql);
      $stmt->bind_param("i", $code);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		}
		public static function getNameByCode($code){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_codes` WHERE `Codes_Code`= ? ";
			$stmt = $mysqli->prepare($sql);
      $stmt->bind_param("i", $code);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["Codes_ClassName"];
		}
		public static function isCodeBelongsAdmin($code){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_codes` WHERE `Codes_Code`= ? ";
			$stmt = $mysqli->prepare($sql);
      $stmt->bind_param("i", $code);
			$stmt->execute();
			// return count($stmt->get_result()->fetch_all(MYSQLI_ASSOC))!=0;
			if($code == "71089"){
				return true;
			}
			return false;
		}
	}
?>