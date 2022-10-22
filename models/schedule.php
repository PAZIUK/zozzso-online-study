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
	}
?>