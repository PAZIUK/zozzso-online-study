		<title><?php echo CONFIG::getTitle()?></title>

		<link rel="stylesheet" href="css/main.css">

	</head>
	<body>

		<section class="login login_active">
			<div class="login__nav">
				<form action="class.php" method="get" class="login__form" onSubmit="checkPassword(event)">
					<div class="login__className"></div>
					<input type="text" class="login__input login__input_active" placeholder="Введіть ваш код доступу" name="code">
					<div class="login__error">НЕПРАВИЛЬНИЙ КОД ДОСТУПУ</div>
					<div class="login__btns">
						<button class="login__checkPasswordBtn">Продовжити</button>
						<a class="login__helpLink" href="index.php?action=help">Допомога</a>
					</div>
				</form>
			</div>
			<div class="background background_active"></div>
		</section>

		<section class="hello">
			<div class="hello__container">

				<div class="hello__block">
					<div class="hello__images">
						<div class="hello__image hello__image_logo">
							<img src="img/config/ZOZZSO.png" alt="Logo">
						</div>
					</div>
				</div>
	
				<div class="hello__loading loading">
					<div class="loading__lines">
						<div class="loading__line"></div>
						<div class="loading__line"></div>
						<div class="loading__line"></div>
						<div class="loading__line"></div>
						<div class="loading__line"></div>
						<div class="loading__line"></div>
					</div>
					<p class="loading__text">Завантаження</p>
				</div>

			</div>
		</section>

		<script src="/projectBlocks/loading/js/loading.js"></script>
		<script src="/projectBlocks/login/js/login.js"></script>

	</body>
</html>
