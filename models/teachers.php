<?php
	class TEACHERS
	{
		public static function getAllTeachers(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_teachers`";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		}
		public static function saveChanges($post){
			if(count($post)>2){
				$mysqli = DATABASE::Connect();
				if(isset($post["AddTN"])&&isset($post["AddTL"])){
					$sql = "INSERT INTO `zozzso-online-study_teachers` (`Teachers_ID`, `Teachers_Name`, `Teachers_Link`, `Teachers_AddTime`) VALUES (NULL, ?, ?, current_timestamp())"; 
					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param("ss", $post["AddTN"], $post["AddTL"]);
					$stmt->execute();
				}
				for ($i=1; $i <= intval($post["Teachers"]); $i++) { 
					if(isset($post["TN:".$i])&&isset($post["TL:".$i])){
						$sql = " UPDATE `zozzso-online-study_teachers` SET `Teachers_Name` = ?, `Teachers_Link` = ? WHERE `zozzso-online-study_teachers`.`Teachers_ID` = ".$i.";"; 
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("ss", $post["TN:".$i], $post["TL:".$i]);
						$stmt->execute();
					} else if(isset($post["TL:".$i])){
						$sql = " UPDATE `zozzso-online-study_teachers` SET `Teachers_Link` = ? WHERE `zozzso-online-study_teachers`.`Teachers_ID` = ".$i.";";
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $post["TL:".$i]);
						$stmt->execute();
					} else if(isset($post["TN:".$i])){
						$sql = " UPDATE `zozzso-online-study_teachers` SET `Teachers_Name` = ? WHERE `zozzso-online-study_teachers`.`Teachers_ID` = ".$i.";";
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $post["TN:".$i]);
						$stmt->execute();
					}
				}
			}
		}
	}
?>