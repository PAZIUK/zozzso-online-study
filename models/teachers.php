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
		public static function getMaxID(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT MAX(`Teachers_ID`) FROM `zozzso-online-study_teachers`";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["MAX(`Teachers_ID`)"];
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

					if(isset($post["Delete:".$i])){
						$sql = "DELETE FROM `zozzso-online-study_teachers` WHERE `zozzso-online-study_teachers`.`Teachers_ID` = ?"; 
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("i", $post["Delete:".$i]);
						$stmt->execute();

						$scheduleLessons = LESSONS::getAllScheduleLessons();

						for ($s=0; $s < count($scheduleLessons); $s++) { 
							$lessons = explode(",",$scheduleLessons[$s]["ScheduleLessons_LessonID"]);
							$teachers = explode(",",$scheduleLessons[$s]["ScheduleLessons_TeacherID"]);
							$ID = $scheduleLessons[$s]["ScheduleLessons_ID"];
							$teachersForUpdate = [[$teachers[0],$teachers[1]],[$teachers[2],$teachers[3]]];
							$newLessonsValue = "";
							$newTeachersValue = "";
							for ($u=0; $u < count($teachersForUpdate); $u++) { 
								if($teachersForUpdate[$u][0]==$post["Delete:".$i]){
									$teachersForUpdate[$u][0] = 0;
								}
								if($teachersForUpdate[$u][1]==$post["Delete:".$i]){
									$teachersForUpdate[$u][1] = 0;
								}
							}

							if(($teachers[0]==$post["Delete:".$i]&&intval($teachers[1])==0&&intval($teachers[2])==0&&intval($teachers[3])==0)||($teachers[0]==$post["Delete:".$i]&&$teachers[1]==$post["Delete:".$i]&&$teachers[2]==$post["Delete:".$i]&&$teachers[3]==$post["Delete:".$i])||($teachersForUpdate==[[0,0],[0,0]])){
								$sql = "DELETE FROM `zozzso-online-study_schedulelessons` WHERE `zozzso-online-study_schedulelessons`.`ScheduleLessons_ID` = ?"; 
								$stmt = $mysqli->prepare($sql);
								$stmt->bind_param("i", $ID);
								$stmt->execute();
							}
							if($teachersForUpdate[0]==[0,0]){
								$newLessonsValue = $lessons[1].",0";
								$newTeachersValue = $teachers[2].",".$teachers[3].",0,0";
								$sql = "UPDATE `zozzso-online-study_schedulelessons` SET `ScheduleLessons_LessonID` = ?, `ScheduleLessons_TeacherID` = ? WHERE `zozzso-online-study_schedulelessons`.`ScheduleLessons_ID` = ?"; 
								$stmt = $mysqli->prepare($sql);
								$stmt->bind_param("ssi", $newLessonsValue, $newTeachersValue, $ID);
								$stmt->execute();
							}
							if($teachersForUpdate[1]==[0,0]){
								$newLessonsValue = $lessons[0].",0";
								$newTeachersValue = $teachers[0].",".$teachers[1].",0,0";
								$sql = "UPDATE `zozzso-online-study_schedulelessons` SET `ScheduleLessons_LessonID` = ?, `ScheduleLessons_TeacherID` = ? WHERE `zozzso-online-study_schedulelessons`.`ScheduleLessons_ID` = ?"; 
								$stmt = $mysqli->prepare($sql);
								$stmt->bind_param("ssi", $newLessonsValue, $newTeachersValue, $ID);
								$stmt->execute();
							}
							if($teachersForUpdate[0][1]==0){
								$scheduleLessons = LESSONS::getAllScheduleLessons();
								$teachers = explode(",",$scheduleLessons[$s]["ScheduleLessons_TeacherID"]);
								$newTeachersValue = $teachers[0].",0,".$teachers[2].",".$teachers[3];
								$sql = "UPDATE `zozzso-online-study_schedulelessons` SET `ScheduleLessons_TeacherID` = ? WHERE `zozzso-online-study_schedulelessons`.`ScheduleLessons_ID` = ?"; 
								$stmt = $mysqli->prepare($sql);
								$stmt->bind_param("si", $newTeachersValue, $ID);
								$stmt->execute();
							}
							if($teachersForUpdate[0][0]==0){
								$scheduleLessons = LESSONS::getAllScheduleLessons();
								$teachers = explode(",",$scheduleLessons[$s]["ScheduleLessons_TeacherID"]);
								$newTeachersValue = $teachers[1].",0,".$teachers[2].",".$teachers[3];
								$sql = "UPDATE `zozzso-online-study_schedulelessons` SET `ScheduleLessons_TeacherID` = ? WHERE `zozzso-online-study_schedulelessons`.`ScheduleLessons_ID` = ?"; 
								$stmt = $mysqli->prepare($sql);
								$stmt->bind_param("si", $newTeachersValue, $ID);
								$stmt->execute();
							}
							if($teachersForUpdate[1][1]==0){
								$scheduleLessons = LESSONS::getAllScheduleLessons();
								$teachers = explode(",",$scheduleLessons[$s]["ScheduleLessons_TeacherID"]);
								$newTeachersValue = $teachers[0].",".$teachers[1].",".$teachers[2].",0";
								$sql = "UPDATE `zozzso-online-study_schedulelessons` SET `ScheduleLessons_TeacherID` = ? WHERE `zozzso-online-study_schedulelessons`.`ScheduleLessons_ID` = ?"; 
								$stmt = $mysqli->prepare($sql);
								$stmt->bind_param("si", $newTeachersValue, $ID);
								$stmt->execute();
							}
							if($teachersForUpdate[1][0]==0){
								$scheduleLessons = LESSONS::getAllScheduleLessons();
								$teachers = explode(",",$scheduleLessons[$s]["ScheduleLessons_TeacherID"]);
								$newTeachersValue = $teachers[0].",".$teachers[1].",".$teachers[3].",0";
								$sql = "UPDATE `zozzso-online-study_schedulelessons` SET `ScheduleLessons_TeacherID` = ? WHERE `zozzso-online-study_schedulelessons`.`ScheduleLessons_ID` = ?"; 
								$stmt = $mysqli->prepare($sql);
								$stmt->bind_param("si", $newTeachersValue, $ID);
								$stmt->execute();
							}
						}
					}
				}
			}
		}
	}
?>
