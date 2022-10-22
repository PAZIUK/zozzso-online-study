<?php
  if(!isset($_SESSION["isAdmin"])||isset($_SESSION["isAdmin"])&&$_SESSION["isAdmin"]==false){
    REDIRECT::toErrorPage();
  }
?>
	  <title><?php echo CONFIG::getTitle()?> - Адмін Панель</title>
		<link rel="stylesheet" href="/css/admin.css">

	</head>
	<body>

    <aside class="leftMenu">
      <div class="leftMenu__logo logo">
        <img src="/img/config/admin-panel.png" alt="Адмін Панель" class="logo__img">
        <h1 class="logo__title">Адмін Панель</h1>
      </div>
      <div class="left__navigationBtns">

      </div>
    </aside>

    <main class="main">

    </main>

  </body>
</html>