		<title><?php echo CONFIG::getTitle()?> - Допомога</title>

		<link rel="stylesheet" href="css/help.css">
	</head>
	<body>

		<a class="returnBack returnBack_active" href="/">
			<img src="/img/config/arrow-left.png" class="returnBack__img">
		</a>

		<section class="help">
			<div class="help__block block"> 
				<a href="/index.php?action=rules" class="block__link">
					<img src="/img/help/book.png" alt="Rules" class="block__img">
					<h2 class="block__text">Правила поведінки</h2>
				</a>
			</div>
			
			<div class="help__block block">
				<a href="/index.php?action=schedule" class="block__link">
					<img src="/img/help/bell.png" alt="Bell" class="block__img">
					<h2 class="block__text">Розклад дзвінків</h2>
				</a>
			</div>
			
			<div class="help__block block">
				<a href="/index.php?action=telegramBot" class="block__link">
					<img src="/img/help/telegram.png" alt="Telegram" class="block__img">
					<h2 class="block__text">Telegram - допомога</h2>
				</a>
			</div>
		</section>

		<div class="background"></div>

	</body>
</html>
