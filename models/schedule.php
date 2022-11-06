<?php
	class SCHEDULE
	{
		public static function getLessons(){
			$mysqli = DATABASE::Connect();
			$sql = "SELECT * FROM `zozzso-online-study_schedule`";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		}
		public static function scheduleFormatter(){
			$schedule = self::getLessons();
			$newSchedule = [];
			for ($i=0; $i < count($schedule); $i++) { 
				$number = $schedule[$i]["schedule_Number"];
				$start = $schedule[$i]["schedule_StartTime"].":00";
				$end = $schedule[$i]["schedule_EndTime"].":00";
				$newSchedule[$number] = [$start, $end];
			}
			return json_encode($newSchedule);
		}
		public static function saveChanges($post){
			if(count($post)>2){
				$mysqli = DATABASE::Connect();
				$schedule = self::getLessons();
				for ($i=1; $i <= intval($post["Schedule"]); $i++) { 
					if(isset($post["StartTimeHours:".$i])&&isset($post["StartTimeMinutes:".$i])){
						$startTimeHours = str_pad($post["StartTimeHours:".$i],2,"0", STR_PAD_LEFT);
						$startTimeMinutes = str_pad($post["StartTimeMinutes:".$i],2,"0", STR_PAD_LEFT);
						$sql = "UPDATE `zozzso-online-study_schedule` SET `schedule_StartTime` = ? WHERE `zozzso-online-study_schedule`.`schedule_ID` = ".$i.";"; 
						$time = $startTimeHours . ":" . $startTimeMinutes;
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $time);
						$stmt->execute();
					} else if(isset($post["StartTimeHours:".$i])){
						$startTimeHours = str_pad($post["StartTimeHours:".$i],2,"0", STR_PAD_LEFT);
						$startTimeMinutes = explode(":",$schedule[$i-1]["schedule_StartTime"])[1];
						$sql = " UPDATE `zozzso-online-study_schedule` SET `schedule_StartTime` = ? WHERE `zozzso-online-study_schedule`.`schedule_ID` = ".$i.";"; 
						$time = $startTimeHours . ":" . $startTimeMinutes;
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $time);
						$stmt->execute();
					} else if(isset($post["StartTimeMinutes:".$i])){
						$startTimeHours = explode(":",$schedule[$i-1]["schedule_StartTime"])[0];
						$startTimeMinutes = str_pad($post["StartTimeMinutes:".$i],2,"0", STR_PAD_LEFT);
						$sql = " UPDATE `zozzso-online-study_schedule` SET `schedule_StartTime` = ? WHERE `zozzso-online-study_schedule`.`schedule_ID` = ".$i.";"; 
						$time = $startTimeHours . ":" . $startTimeMinutes;
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $time);
						$stmt->execute();
					}
					if(isset($post["EndTimeHours:".$i])&&isset($post["EndTimeMinutes:".$i])){
						$endTimeHours = str_pad($post["EndTimeHours:".$i],2,"0", STR_PAD_LEFT);
						$endTimeMinutes = str_pad($post["EndTimeMinutes:".$i],2,"0", STR_PAD_LEFT);
						$sql = " UPDATE `zozzso-online-study_schedule` SET `schedule_EndTime` = ? WHERE `zozzso-online-study_schedule`.`schedule_ID` = ".$i.";"; 
						$time = $endTimeHours . ":" . $endTimeMinutes;
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $time);
						$stmt->execute();
					} else if(isset($post["EndTimeHours:".$i])){
						$endTimeHours = str_pad($post["EndTimeHours:".$i],2,"0", STR_PAD_LEFT);
						$endTimeMinutes = explode(":",$schedule[$i-1]["schedule_EndTime"])[1];
						$sql = " UPDATE `zozzso-online-study_schedule` SET `schedule_EndTime` = ? WHERE `zozzso-online-study_schedule`.`schedule_ID` = ".$i.";"; 
						$time = $endTimeHours . ":" . $endTimeMinutes;
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $time);
						$stmt->execute();
					} else if(isset($post["EndTimeMinutes:".$i])){
						$endTimeHours = explode(":",$schedule[$i-1]["schedule_StartTime"])[0];
						$endTimeMinutes = str_pad($post["EndTimeMinutes:".$i],2,"0", STR_PAD_LEFT);
						$sql = " UPDATE `zozzso-online-study_schedule` SET `schedule_EndTime` = ? WHERE `zozzso-online-study_schedule`.`schedule_ID` = ".$i.";"; 
						$time = $endTimeHours . ":" . $endTimeMinutes;
						$stmt = $mysqli->prepare($sql);
						$stmt->bind_param("s", $time);
						$stmt->execute();
					}
				}
			}
		}
	}
?>