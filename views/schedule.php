		<title><?php echo CONFIG::getTitle()?> - Розклад Дзвінків</title>

		<link rel="stylesheet" href="/css/schedule.css">
	</head>
	<body>

		<a class="returnBack returnBack_active" href="/view/help">
			<img src="/img/config/arrow-left.png" class="returnBack__img">
		</a>

		<section class="schedule">
			<h2 class="schedule__title">
				Розклад Дзвінків<br/>
				КЗ “Заставнівський опорний ЗЗСО I-III ст.”<br/>
				та Вербовецької філії I ст.
			</h2>
			<div class="schedule__lessons">
				<?php 
					$lessons = SCHEDULE::getLessons();
					for ($i=0; $i < count($lessons); $i++) { 
						?>
						<div class="schedule__lesson lesson">
							<p class="lesson__number"><?php echo $lessons[$i]["schedule_Number"]?>.</p>
							<p class="lesson__time">
								<?php echo $lessons[$i]["schedule_StartTime"]?> - <?php echo $lessons[$i]["schedule_EndTime"]?>
							</p>
						</div>
						<?php
					}
				?>
			</div>
		</section>

		<div class="background"></div>

	</body>
</html>