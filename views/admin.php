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
      <a class="leftMenu__logo logo" href="/view/admin">
        <img src="/img/config/admin/admin-panel.png" alt="Адмін Панель" class="logo__img">
        <h1 class="logo__title">Адмін Панель</h1>
      </a>
      <div class="leftMenu__navigationBtns navigationBtns">
        <div class="navigationBtns__title title">
          <div class="title__btn"><img src="/img/config/admin/menu.png" alt="Керування" class="title__img"/></div>
          <div class="title__text">Керування</div>
        </div>
        <ul class="navigationBtns__buttons buttons">
          <li class="buttons__button button">
            <a href="/view/admin/config" class="button__link <?php if(isset($_GET["view"])&&$_GET["view"]=="config"){ echo "button__link_active"; }?>">
              <img src="/img/config/admin/settings.png" alt="Налаштування сайту" class="button__img"/>
              <p class="button__text">Налаштування сайту</p>
            </a>
          </li>
          <li class="buttons__button button">
            <a href="/view/admin/teachers" class="button__link <?php if(isset($_GET["view"])&&$_GET["view"]=="teachers"){ echo "button__link_active"; }?>">
              <img src="/img/config/admin/teacher.png" alt="Учителі" class="button__img"/>
              <p class="button__text">Учителі</p>
            </a>
          </li>
          <li class="buttons__button button">
            <a href="/view/admin/lessons" class="button__link <?php if(isset($_GET["view"])&&$_GET["view"]=="lessons"){ echo "button__link_active"; }?>">
              <img src="/img/config/admin/subject.png" alt="Предмети" class="button__img"/>
              <p class="button__text">Предмети</p>
            </a>
          </li>
          <li class="buttons__button button">
            <a href="/view/admin/schedule" class="button__link <?php if(isset($_GET["view"])&&$_GET["view"]=="schedule"){ echo "button__link_active"; }?>">
              <img src="/img/config/admin/bell.png" alt="Розклад дзвінків" class="button__img"/>
              <p class="button__text">Розклад дзвінків</p>
            </a>
          </li>
          <li class="buttons__button button">
            <a href="/view/admin/scheduleLessons" class="button__link <?php if(isset($_GET["view"])&&$_GET["view"]=="scheduleLessons"){ echo "button__link_active"; }?>">
              <img src="/img/config/admin/schedule.png" alt="Розклад уроків" class="button__img"/>
              <p class="button__text">Розклад уроків</p>
            </a>
          </li>
          <li class="buttons__button button">
            <a href="/view/admin/codes" class="button__link <?php if(isset($_GET["view"])&&$_GET["view"]=="codes"){ echo "button__link_active"; }?>">
              <img src="/img/config/admin/codes.png" alt="Коди доступу" class="button__img"/>
              <p class="button__text">Коди доступу</p>
            </a>
          </li>
        </ul>
      </div>
    </aside>

    <main class="main">
      <header class="main__header header">
        <div class="header__title">
          <?php 
            if(!isset($_GET["view"])){
              echo CONFIG::getTitle();
            } else {
              switch ($_GET["view"]) {
                case "config":
                  echo "Налаштування сайту";
                  break;
                case "teachers":
                  echo "Учителі";
                  break;
                case "lessons":
                  echo "Предмети";
                  break;
                case "schedule":
                  echo "Розклад дзвінків";
                  break;
                case "scheduleLessons":
                  echo "Розклад уроків";
                  break;
                case "codes":
                  echo "Коди доступу";
                  break;
              }
            }
          ?>
        </div>
      </header>
    </main>

    <script src="/projectBlocks/admin/js/admin.js"></script>

  </body>
</html>