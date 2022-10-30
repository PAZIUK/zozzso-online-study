<?php
	class LESSONS
	{
		public static function getAllLessons(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_lessons` ORDER BY `zozzso-online-study_lessons`.`Lessons_Name` ASC";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		}
		public static function getLessonsViaCodeAndDay($code,$day){
			$classID = CODES::getClassIDViaCode($code);

			$mysqli = DATABASE::Connect();
			$sql = "SELECT `ScheduleLessons_LessonNumber`,`ScheduleLessons_TeacherID`,`ScheduleLessons_LessonID` FROM `zozzso-online-study_schedulelessons` WHERE `ScheduleLessons_ClassID` = ? AND `ScheduleLessons_Day` = ? ORDER BY `ScheduleLessons_LessonNumber` ASC";
			$stmt = $mysqli->prepare($sql);
      $stmt->bind_param("ii", $classID,$day);
			$stmt->execute();
			$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

			if(count($result)>0){
				$teachersIDs = "";
				for ($i=0; $i < count($result); $i++) { 
					if($i>0){
						$teachersIDs .= ",".$result[$i]["ScheduleLessons_TeacherID"];
					} else {
						$teachersIDs .= $result[$i]["ScheduleLessons_TeacherID"];
					}
				}

				$lessonsIDs = "";
				for ($i=0; $i < count($result); $i++) { 
					if($i>0){
						$lessonsIDs .= ",".$result[$i]["ScheduleLessons_LessonID"];
					} else {
						$lessonsIDs .= $result[$i]["ScheduleLessons_LessonID"];
					}
				}

				$sql = "SELECT `Teachers_ID`,`Teachers_Name`,`Teachers_Link` FROM `zozzso-online-study_teachers` WHERE `zozzso-online-study_teachers`.`Teachers_ID` IN(".$teachersIDs.")";
				$stmt = $mysqli->prepare($sql);
				$stmt->execute();
				$teachers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

				$sql = "SELECT `Lessons_ID`,`Lessons_Name` FROM `zozzso-online-study_lessons` WHERE `zozzso-online-study_lessons`.`Lessons_ID` IN(".$lessonsIDs.")";
				$stmt = $mysqli->prepare($sql);
				$stmt->execute();
				$lessons = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

				return [$result,$teachers,$lessons];
			} else {
				return [];
			}
		}
		public static function saveChanges($post){
			if(count($post)>2){
				$mysqli = DATABASE::Connect();
				$sql = "";
				$paramsTypes = "";
				$params = [];
				if(isset($post["AddLesson"])){
					$sql .= "INSERT INTO `zozzso-online-study_lessons` (`Lessons_ID`, `Lessons_Name`, `Lessons_AddTime`) VALUES (NULL, ?, current_timestamp());"; 
					$paramsTypes .= "s";
					array_push($params, $post["AddLesson"]);
				}
				for ($i=1; $i <= intval($post["Lessons"]); $i++) { 
					if(isset($post["Lesson:".$i])){
						$sql .= " UPDATE `zozzso-online-study_lessons` SET `Lessons_Name` = ? WHERE `zozzso-online-study_lessons`.`Lessons_ID` = ".$i; 
						$paramsTypes .= "s";
						array_push($params, $post["Lesson:".$i]);
					}
				}
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param($paramsTypes, ...$params);
				$stmt->execute();
			}
		}
	}
?>