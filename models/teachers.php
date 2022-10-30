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
				$sql = "";
				$paramsTypes = "";
				$params = [];
				if(isset($post["AddTN"])&&isset($post["AddTL"])){
					$sql .= "INSERT INTO `zozzso-online-study_teachers` (`Teachers_ID`, `Teachers_Name`, `Teachers_Link`, `Teachers_AddTime`) VALUES (NULL, ?, ?, current_timestamp())"; 
					$paramsTypes .= "ss";
					array_push($params, $post["AddTN"]);
					array_push($params, $post["AddTL"]);
				} else if(isset($post["AddTL"])){
					$sql .= "INSERT INTO `zozzso-online-study_teachers` (`Teachers_ID`, `Teachers_Name`, `Teachers_Link`, `Teachers_AddTime`) VALUES (NULL, '', ?, current_timestamp())";
					$paramsTypes .= "s";
					array_push($params, $post["AddTL"]);
				} else if(isset($post["AddTN"])){
					$sql .= "INSERT INTO `zozzso-online-study_teachers` (`Teachers_ID`, `Teachers_Name`, `Teachers_Link`, `Teachers_AddTime`) VALUES (NULL, ?, '', current_timestamp())";
					$paramsTypes .= "s";
					array_push($params, $post["AddTN"]);
				}
				for ($i=1; $i <= intval($post["Teachers"]); $i++) { 
					if(isset($post["TN:".$i])&&isset($post["TL:".$i])){
						$sql .= " UPDATE `zozzso-online-study_teachers` SET `Teachers_Name` = ?, `Teachers_Link` = ? WHERE `zozzso-online-study_teachers`.`Teachers_ID` = ".$i; 
						$paramsTypes .= "ss";
						array_push($params, $post["TN:".$i]);
						array_push($params, $post["TL:".$i]);
					} else if(isset($post["TL:".$i])){
						$sql .= " UPDATE `zozzso-online-study_teachers` SET `Teachers_Link` = ? WHERE `zozzso-online-study_teachers`.`Teachers_ID` = ".$i;
						$paramsTypes .= "s";
						array_push($params, $post["TL:".$i]);
					} else if(isset($post["TN:".$i])){
						$sql .= " UPDATE `zozzso-online-study_teachers` SET `Teachers_Name` = ? WHERE `zozzso-online-study_teachers`.`Teachers_ID` = ".$i;
						$paramsTypes .= "s";
						array_push($params, $post["TN:".$i]);
					}
				}
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param($paramsTypes, ...$params);
				$stmt->execute();
			}
		}
	}
?>