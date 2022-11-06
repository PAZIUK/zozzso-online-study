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
		public static function saveChangesLessons($post){
			if(count($post)>2){
				$mysqli = DATABASE::Connect();
				if(isset($post["AddLesson"])){
					$lessonName = strtoupper($post["AddLesson"]);

					$sql = "SELECT * FROM `zozzso-online-study_lessons` WHERE `zozzso-online-study_lessons`.`Lessons_Name` = ?"; 
					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param("s", $lessonName);
					$stmt->execute();
					$isRowExists = count($stmt->get_result()->fetch_all(MYSQLI_ASSOC));

					if($isRowExists==0){
						$sql = "INSERT INTO `zozzso-online-study_lessons` (`Lessons_ID`, `Lessons_Name`, `Lessons_AddTime`) VALUES (NULL, ?, current_timestamp());"; 
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $lessonName);
						$stmt->execute();
					}
				}
				for ($i=1; $i <= intval($post["Lessons"]); $i++) { 
					if(isset($post["Lesson:".$i])){
						$sql = "UPDATE `zozzso-online-study_lessons` SET `Lessons_Name` = ? WHERE `zozzso-online-study_lessons`.`Lessons_ID` = ".$i; 
						$lessonName = strtoupper($post["Lesson:".$i]);
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $lessonName);
						$stmt->execute();
					}
				}
			}
		}
		public static function saveChangesScheduleLessons($post,$code){
			if(count($post)>1){
				$mysqli = DATABASE::Connect();
				$classID = CODES::getClassIDViaCode($code);
				for ($day=1; $day <= 5; $day++) { 
					for ($lesson=1; $lesson <= 7; $lesson++) { 
						$subjects = [];
						$teachers = [];
						$countSubjects = 0;
						$countTeachers = 0;
						for ($subject=1; $subject <= 2; $subject++) { 
							if(isset($post["Lesson:".$day.":".$lesson.":".$subject])){
								array_push($subjects,$post["Lesson:".$day.":".$lesson.":".$subject]);
								if($post["Lesson:".$day.":".$lesson.":".$subject]>0){$countSubjects += 1;}
							}
							for ($teacher=1; $teacher <= 2; $teacher++) { 
								if(isset($post["Teacher:".$day.":".$lesson.":".$subject.":".$teacher])){
									array_push($teachers,$post["Teacher:".$day.":".$lesson.":".$subject.":".$teacher]);
									if($post["Teacher:".$day.":".$lesson.":".$subject.":".$teacher]>0){$countTeachers += 1;}
								}
							}
						}
						if($countSubjects>0&&$countTeachers>0){
							$subjects = implode("," , $subjects);
							$teachers = implode("," , $teachers);

							$sql = "SELECT * FROM `zozzso-online-study_schedulelessons` WHERE `zozzso-online-study_schedulelessons`.`ScheduleLessons_ClassID` = ? AND `zozzso-online-study_schedulelessons`.`ScheduleLessons_Day` = ? AND `zozzso-online-study_schedulelessons`.`ScheduleLessons_LessonNumber` = ?"; 
							$stmt = $mysqli->prepare($sql);
							$stmt->bind_param("iii", $classID, $day, $lesson);
							$stmt->execute();
							$isRowExists = count($stmt->get_result()->fetch_all(MYSQLI_ASSOC));

							if($isRowExists>0){
								$sql = "UPDATE `zozzso-online-study_schedulelessons` SET `ScheduleLessons_LessonID` = ?, `ScheduleLessons_TeacherID` = ? WHERE `zozzso-online-study_schedulelessons`.`ScheduleLessons_ClassID` = ? AND `zozzso-online-study_schedulelessons`.`ScheduleLessons_Day` = ? AND `zozzso-online-study_schedulelessons`.`ScheduleLessons_LessonNumber` = ?"; 
								$stmt = $mysqli->prepare($sql);
								$stmt->bind_param("ssiii", $subjects, $teachers, $classID, $day, $lesson);
								$stmt->execute();
							} else {
								$sql = "INSERT INTO `zozzso-online-study_schedulelessons` (`ScheduleLessons_ID`, `ScheduleLessons_ClassID`, `ScheduleLessons_Day`, `ScheduleLessons_LessonNumber`, `ScheduleLessons_LessonID`, `ScheduleLessons_TeacherID`, `ScheduleLessons_AddTime`) VALUES (NULL, ?, ?, ?, ?, ?, current_timestamp());"; 
								$stmt = $mysqli->prepare($sql);
								$stmt->bind_param("iiiss", $classID, $day, $lesson, $subjects, $teachers);
								$stmt->execute();
							}
						}
					}
				}
			}
		}
	}
?>