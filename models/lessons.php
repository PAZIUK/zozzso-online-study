<?php
	class LESSONS
	{
		public static function getLessonsViaCodeAndDay($code,$day){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT `ScheduleLessons_LessonNumber`,`ScheduleLessons_TeacherID`,`ScheduleLessons_LessonID` FROM `zozzso-online-study_schedulelessons` WHERE `ScheduleLessons_ClassCode` = ? AND `ScheduleLessons_Day` = ? ORDER BY `ScheduleLessons_LessonNumber` ASC";
			$stmt = $mysqli->prepare($sql);
      $stmt->bind_param("ii", $code,$day);
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
	}
?>