<?php
	class CODES
	{
		public static function getAllCodes(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_codes`";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		}
		public static function getAllFormatedCodes(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_codes`";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		}
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
			$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			if(count($result)>0){
				return $result[0]["Codes_ClassName"];
			} else {
				return "";
			}
		}
		public static function getClassIDViaCode($code){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_codes` WHERE `Codes_Code`= ? ";
			$stmt = $mysqli->prepare($sql);
      $stmt->bind_param("i", $code);
			$stmt->execute();
			$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			if(count($result)>0){
				return $result[0]["Codes_ID"];
			} else {
				return "";
			}
		}
		public static function getMaxID(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT MAX(`Codes_ID`) FROM `zozzso-online-study_codes`";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["MAX(`Codes_ID`)"];
		}
		public static function isCodeBelongsAdmin($code){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT `Roles_Role` FROM `zozzso-online-study_roles` INNER JOIN `zozzso-online-study_codes` ON `zozzso-online-study_codes`.`Codes_ID` = `zozzso-online-study_roles`.`Roles_CodeID` WHERE `zozzso-online-study_codes`.`Codes_Code`= ? ";
			$stmt = $mysqli->prepare($sql);
      $stmt->bind_param("i", $code);
			$stmt->execute();
			$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			if(count($result)>0){
				return ($result[0]["Roles_Role"] == "Admin");
			}
			return false;
		}
		public static function saveChanges($post){
			if(count($post)>2){
				$mysqli = DATABASE::Connect();
				if(isset($post["AddClassName"])&&isset($post["AddCode"])){
					$sql = "INSERT INTO `zozzso-online-study_codes` (`Codes_ID`, `Codes_Code`, `Codes_ClassName`, `Codes_AddTime`) VALUES (NULL, ?, ?, current_timestamp());"; 
					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param("ss", $post["AddCode"],$post["AddClassName"]);
					$stmt->execute();
				}
				for ($i=1; $i <= intval($post["Codes"]); $i++) { 
					if(isset($post["ClassName:".$i])&&isset($post["Code:".$i])){
						$sql = "UPDATE `zozzso-online-study_codes` SET `Codes_ClassName` = ?,`Codes_Code` = ? WHERE `zozzso-online-study_codes`.`Codes_ID` = ".$i; 
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("ss", $post["ClassName:".$i], $post["Code:".$i]);
						$stmt->execute();
					} else if(isset($post["Code:".$i])){
						$sql = "UPDATE `zozzso-online-study_codes` SET `Codes_Code` = ? WHERE `zozzso-online-study_codes`.`Codes_ID` = ".$i;
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $post["Code:".$i]);
						$stmt->execute();
					} else if(isset($post["ClassName:".$i])){
						$sql = "UPDATE `zozzso-online-study_codes` SET `Codes_ClassName` = ? WHERE `zozzso-online-study_codes`.`Codes_ID` = ".$i;
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $post["ClassName:".$i]);
						$stmt->execute();
					}
					
					if(isset($post["Delete:".$i])){
						$sql = "DELETE FROM `zozzso-online-study_codes` WHERE `zozzso-online-study_codes`.`Codes_ID` = ?"; 
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("i", $post["Delete:".$i]);
						$stmt->execute();

						$sql = "DELETE FROM `zozzso-online-study_schedulelessons` WHERE `zozzso-online-study_schedulelessons`.`ScheduleLessons_ClassID` = ?"; 
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("i", $post["Delete:".$i]);
						$stmt->execute();
					}
				}
			}
		}
	}
?>