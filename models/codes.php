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
			$sql = "SELECT `Roles_Role` FROM `zozzso-online-study_roles` INNER JOIN `zozzso-online-study_codes` ON `zozzso-online-study_codes`.`Codes_ID` = `zozzso-online-study_roles`.`Roles_CodeID` WHERE `zozzso-online-study_codes`.`Codes_Code`= ? ";
			$stmt = $mysqli->prepare($sql);
      $stmt->bind_param("i", $code);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["Roles_Role"] == "Admin";
		}
	}
?>