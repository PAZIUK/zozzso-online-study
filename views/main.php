		<title><?php echo CONFIG::getTitle()?></title>

		<link rel="stylesheet" href="css/login.css">
	</head>
	<body>

		<section class="login login_active">
			<div class="login__nav">
				<form action="nav.php" method="post" class="login__form">
					<div class="login__className"></div>
					<input type="text" class="login__input login__input_active" placeholder="Введіть свій код доступу">
					<div class="login__error">НЕПРАВИЛЬНИЙ КОД ДОСТУПУ</div>
					<div class="login__btns">
						<button class="login__checkPasswordBtn">Продовжити</button>
						<a class="login__helpLink" href="help/help.html">Допомога</a>
					</div>
				</form>
			</div>
			<div class="login__background login__background_active"></div>
		</section>

		<section class="hello">
			<div class="hello__container">

				<div class="hello__block">
					<div class="hello__images">
						<div class="hello__image hello__image_logo">
							<img src="imgZoom/ZOZZSO.png" alt="Logo">
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



		<script src="js/animation.js"></script>
		<!-- <script src="js/passwords.js"></script> -->
	</body>
</html>
