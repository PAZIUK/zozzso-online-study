<?php
  if(!isset($_SESSION["isAdmin"])||isset($_SESSION["isAdmin"])&&$_SESSION["isAdmin"]==false){
    REDIRECT::toErrorPage();
  }
  if(isset($_POST)&&isset($_POST["Section"])){
    switch ($_POST["Section"]) {
      case 'Config':
        CONFIG::setSettings($_POST);
        REDIRECT::toPageViaLink("/view/admin/config");
        break;
      
      case 'Teachers':
        if((isset($_POST["AddTN"])&&!isset($_POST["AddTL"]))||(!isset($_POST["AddTN"])&&isset($_POST["AddTL"]))){
          REDIRECT::toPageViaLink("/view/admin/teachers");
        }
        TEACHERS::saveChanges($_POST);
        REDIRECT::toPageViaLink("/view/admin/teachers");
        break;

      case 'Lessons':
        LESSONS::saveChangesLessons($_POST);
        REDIRECT::toPageViaLink("/view/admin/lessons");
        break;

      case 'Schedule':
        SCHEDULE::saveChanges($_POST);
        REDIRECT::toPageViaLink("/view/admin/schedule");
        break;

      case 'ScheduleLessons':
        LESSONS::saveChangesScheduleLessons($_POST,$_GET["class"]);
        REDIRECT::reloadPage();
        break;

      case 'Codes':
        if((isset($_POST["AddClassName"])&&!isset($_POST["AddCode"]))||(!isset($_POST["AddClassName"])&&isset($_POST["AddCode"]))){
          REDIRECT::toPageViaLink("/view/admin/codes");
        }
        CODES::saveChanges($_POST);
        REDIRECT::toPageViaLink("/view/admin/codes");
        break;
    }
  }
?>
	  <title><?php echo $siteName?> - Адмін Панель</title>
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
            <a href="/view/admin/scheduleLessons" class="button__link <?php if(isset($_GET["view"])&&($_GET["view"]=="scheduleLessons"||$_GET["view"]=="scheduleLessonsClass"||$_GET["view"]=="scheduleLessonsClassSchedule")){ echo "button__link_active"; }?>">
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
        <div class="header__wrapper wrapper">
          <div class="header__title">
            <?php 
              if(!isset($_GET["view"])){
                echo $siteName;
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
                  case "scheduleLessonsClass":
                  case "scheduleLessonsClassSchedule":
                    $className = CODES::getNameByCode($_GET["class"]);
                    if(strlen($className)>0){
                      echo "Розклад уроків - ".$className;
                    } else {
                      echo "Розклад уроків";
                    }
                    break;
                  case "codes":
                    echo "Коди доступу";
                    break;
                }
              }
            ?>
          </div>
        </div>
      </header>
      <main class="main__mainBlock mainBlock">
        <div class="mainBlock__wrapper wrapper">
          <div class="mainBlock__section section section_hello <?php if(!isset($_GET["view"])){ echo "section_active"; }?>">
            <div class="section__infoBlock infoBlock infoBlock_hello">
              <div class="infoBlock__wrapper">
                <p class="infoBlock__subtitle">Дорогий, адміне,</p>
                <h2 class="infoBlock__title">ПРИВІТ</h2>
                <p class="infoBlock__desc">
                  Радий бачити вас на цій сторінці! <br/>
                  Тут ви зможете повністю налаштувати сайт <br/> 
                  для онлайн навчання в нашій школі. <br/><br/> 
                  Для навігації використовуйте <br/> 
                  Меню Керування в Адмін Панелі
                </p>
                <button class="infoBlock__buttonOpenLeftMenu">Меню Керування</button>
              </div>
            </div>
            <div class="section__imageBlock imageBlock imageBlock_hello">
              <img class="imageBlock__image" src="/img/config/admin/student.png" alt="Привіт!"/>
            </div>
          </div>
          <div class="mainBlock__section section section_config <?php if(isset($_GET["view"])&&$_GET["view"]=="config"){ echo "section_active"; }?>">
            <div class="section__infoBlock infoBlock infoBlock_config">
              <div class="infoBlock__wrapper">
                <h2 class="infoBlock__desc desc">
                  <img src="/img/config/admin/advice-message.png" alt="Порада" class="desc__image">
                  Налаштуйте назву, опис та інші дрібниці для кращої взаємодії із сайтом
                </h2>
                <form class="infoBlock__settings settings" method="POST">
                  <input type="hidden" name="Section" value="Config">
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/trophy.png" alt="Назва сайту" class="setting__image"></div>
                    <div class="setting__title">Назва сайту</div>
                    <div class="setting__changeBlock">
                      <input type="text" class="setting__input" maxlength="50" required name="Title" value="<?php echo CONFIG::getTitle()?>" placeholder="Введіть назву сайту">
                    </div>
                  </div>
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/description.png" alt="Опис сайту" class="setting__image"></div>
                    <div class="setting__title">Опис сайту</div>
                    <div class="setting__changeBlock">
                      <textarea type="text" class="setting__input" maxlength="255" required name="Description" placeholder="Введіть опис сайту"><?php echo CONFIG::getDescription()?></textarea>
                    </div>
                  </div>
                  <div class="settings__line line"></div>
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/link.png" alt="Кнопка посилання" class="setting__image"></div>
                    <div class="setting__title">Кнопка посилання</div>
                    <div class="setting__changeBlock">
                      <input type="text" class="setting__input" maxlength="50" required name="BtnRedirectTo" value="<?php echo CONFIG::getBtnRedirectTo()?>" placeholder="Введіть напис на кнопці посилання">
                    </div>
                  </div>
                  <div class="settings__setting setting">
                    <div class="setting__buttons">
                      <button class="setting__submitBtn button">Зберегти зміни</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="section__imageBlock imageBlock imageBlock_config">
              <img class="imageBlock__image" src="/img/config/admin/setting.webp" alt="Налаштування сайту"/>
            </div>
          </div>
          <div class="mainBlock__section section <?php if(isset($_GET["view"])&&$_GET["view"]=="teachers"){ echo "section_active"; }?>">
            <div class="section__infoBlock infoBlock infoBlock_teachers">
              <div class="infoBlock__wrapper">
                <h2 class="infoBlock__desc desc">
                  <img src="/img/config/admin/advice-message.png" alt="Порада" class="desc__image">
                  Налаштуйте посилання учителів для організації онлайн навчання в нашій школі
                </h2>
                <div class="infoBlock__settings settings">
                  <?php 
                    $teachers = TEACHERS::getAllTeachers();
                    for ($i=0; $i < count($teachers); $i++) {
                  ?>
                    <div class="settings__setting setting">
                      <div class="setting__imageBlock"><img src="/img/config/admin/teachers-icon.png" alt="Учитель" class="setting__image"></div>
                      <div class="setting__title">
                        <input type="text" class="setting__input setting__input_second" minlength="5" maxlength="50" name="TN:<?php echo $teachers[$i]["Teachers_ID"]?>" required value="<?php echo $teachers[$i]["Teachers_Name"]?>" <?php if($i==0){ echo "disabled";}?> placeholder="Введіть П.І.П вчителя">
                      </div>
                      <div class="setting__changeBlock">
                        <input type="text" class="setting__input" minlength="5" maxlength="100" name="TL:<?php echo $teachers[$i]["Teachers_ID"]?>" required value="<?php echo $teachers[$i]["Teachers_Link"]?>" <?php if($i==0){ echo "disabled";} else { echo "placeholder='Введіть посилання вчителя'"; }?>>
                      </div>
                    </div>
                  <?php } ?>
                  <div class="settings__setting setting addInputBlock">
                    <div class="setting__imageBlock">
                      <img src="/img/config/admin/teachers-icon.png" alt="Учитель" class="setting__image">
                    </div>
                    <div class="setting__title">
                      <input type="text" class="setting__input setting__input_second" minlength="5" maxlength="50" required placeholder="Введіть П.І.П вчителя" name="AddTN" value="">
                    </div>
                    <div class="setting__changeBlock">
                      <input type="text" class="setting__input" minlength="5" maxlength="100" required placeholder="Введіть посилання вчителя" name="AddTL" value="">
                    </div>
                  </div>
                  <form class="settings__setting setting <?php if(isset($_GET["view"])&&$_GET["view"]=="teachers"){ echo "setting_visible"; }?>" method="POST">
                    <input type="hidden" name="Section" value="Teachers">
                    <input type="hidden" name="Teachers" value="<?php echo count($teachers);?>">
                    <div class="setting__buttons">
                      <button class="setting__addBtn button" type="button">
                        <img src="/img/config/plus.png" class="btnImage" alt="Плюс">
                        Додати учителя
                      </button>
                      <button class="setting__submitBtn button">Зберегти зміни</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="section__imageBlock imageBlock imageBlock_teachers">
              <img class="imageBlock__image" src="/img/config/admin/online-learning.webp" alt="Учителі"/>
            </div>
          </div>
          <div class="mainBlock__section section <?php if(isset($_GET["view"])&&$_GET["view"]=="lessons"){ echo "section_active"; }?>">
            <div class="section__infoBlock infoBlock infoBlock_lessons">
              <div class="infoBlock__wrapper">
                <h2 class="infoBlock__desc desc">
                  <img src="/img/config/admin/advice-message.png" alt="Порада" class="desc__image">
                  Визначіть унікальні предмети, які вивчатимуть учні нашої школи, та перевірте їхню наявність в списку предметів
                </h2>
                <?php $lessons = LESSONS::getAllLessons(); ?>
                <div class="infoBlock__settings settings">
                  <?php for ($i=0; $i < count($lessons); $i++) { ?>
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/literature.png" alt="Предмет" class="setting__image"></div>
                    <div class="setting__title">Предмет</div>
                    <div class="setting__changeBlock">
                      <input type="text" class="setting__input" maxlength="50" required name="Lesson:<?php echo $lessons[$i]["Lessons_ID"]?>" value="<?php echo $lessons[$i]["Lessons_Name"]?>" placeholder="Введіть назву предмету">
                    </div>
                  </div>
                  <?php } ?>
                  <div class="settings__setting setting addInputBlock">
                    <div class="setting__imageBlock"><img src="/img/config/admin/literature.png" alt="Предмет" class="setting__image"></div>
                    <div class="setting__title">Предмет</div>
                    <div class="setting__changeBlock">
                      <input type="text" class="setting__input" maxlength="50" required name="AddLesson" value="" placeholder="Введіть назву предмету">
                    </div>
                  </div>
                  <form class="settings__setting setting <?php if(isset($_GET["view"])&&$_GET["view"]=="lessons"){ echo "setting_visible"; }?>" method="POST">
                    <input type="hidden" name="Section" value="Lessons">
                    <input type="hidden" name="Lessons" value="<?php echo count($lessons)?>">
                    <div class="setting__buttons">
                      <button class="setting__addBtn button" type="button">
                        <img src="/img/config/plus.png" class="btnImage" alt="Плюс">
                        Додати предмет
                      </button>
                      <button class="setting__submitBtn button">Зберегти зміни</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="section__imageBlock imageBlock imageBlock_lessons">
              <img class="imageBlock__image" src="/img/config/admin/books-and-laptop.png" alt="Предмети"/>
            </div>
          </div>
          <div class="mainBlock__section section <?php if(isset($_GET["view"])&&$_GET["view"]=="schedule"){ echo "section_active"; }?>">
            <div class="section__infoBlock infoBlock infoBlock_schedule">
              <div class="infoBlock__wrapper">
                <h2 class="infoBlock__desc desc">
                  <img src="/img/config/admin/advice-message.png" alt="Порада" class="desc__image">
                  Налаштуйте роклад дзвінків для того, щоб кожен учень знав коли розпочинається та закінчується урок
                </h2>
                <?php $schedule = SCHEDULE::getLessons();?>
                <div class="infoBlock__settings settings">
                  <?php for ($i=0; $i < count($schedule); $i++) { ?>
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/watches.png" alt="Годинник" class="setting__image"></div>
                    <div class="setting__title"><?php echo $schedule[$i]["schedule_Number"]?> урок</div>
                    <div class="setting__changeBlock">
                      <?php 
                        $startTimeHours = explode(":",$schedule[$i]["schedule_StartTime"])[0];
                        $startTimeMinutes = explode(":",$schedule[$i]["schedule_StartTime"])[1];
                        $endTimeHours = explode(":",$schedule[$i]["schedule_EndTime"])[0];
                        $endTimeMinutes = explode(":",$schedule[$i]["schedule_EndTime"])[1];
                      ?>
                      <input type="number" class="setting__input" min="1" max="23" required name="StartTimeHours:<?php echo $schedule[$i]["schedule_ID"];?>" value="<?php echo $startTimeHours;?>">
                      <span class="hm">:</span>
                      <input type="number" class="setting__input" min="0" max="59" required name="StartTimeMinutes:<?php echo $schedule[$i]["schedule_ID"];?>" value="<?php echo $startTimeMinutes;?>">
                      <span class="se">-</span>
                      <input type="number" class="setting__input" min="1" max="23" required name="EndTimeHours:<?php echo $schedule[$i]["schedule_ID"];?>" value="<?php echo $endTimeHours;?>">
                      <span class="hm">:</span>
                      <input type="number" class="setting__input" min="0" max="59" required name="EndTimeMinutes:<?php echo $schedule[$i]["schedule_ID"];?>" value="<?php echo $endTimeMinutes;?>">
                    </div>
                  </div>
                  <?php } ?>
                  <form class="settings__setting setting <?php if(isset($_GET["view"])&&$_GET["view"]=="schedule"){ echo "setting_visible"; }?>" method="POST">
                    <input type="hidden" name="Section" value="Schedule">
                    <input type="hidden" name="Schedule" value="<?php echo count($schedule)?>">
                    <div class="setting__buttons">
                      <button class="setting__submitBtn button">Зберегти зміни</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="section__imageBlock imageBlock imageBlock_schedule">
              <img class="imageBlock__image" src="/img/config/admin/bell.webp" alt="Роклад дзвінків"/>
            </div>
          </div>
          <div class="mainBlock__section section <?php if(isset($_GET["view"])&&$_GET["view"]=="scheduleLessons"){ echo "section_active"; }?>">
            <div class="section__infoBlock infoBlock infoBlock_scheduleLessons">
              <div class="infoBlock__wrapper">
                <h2 class="infoBlock__desc desc">
                  <img src="/img/config/admin/advice-message.png" alt="Порада" class="desc__image">
                  Налаштуйте роклад уроків для кожного класу так, щоб кожен учень зміг без проблем навчатися дистанційно
                </h2>
                <?php $codes = CODES::getAllFormatedCodes(); ?>
                <div class="infoBlock__settings settings">
                  <?php 
                  for ($i=0; $i < count($codes); $i++) {
                    if($codes[$i]["Codes_ClassName"]=="Адмін Панель"){
                      continue;
                    }
                  ?>
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/classroom.png" alt="Код доступу" class="setting__image"></div>
                    <div class="setting__title"><?php echo $codes[$i]["Codes_ClassName"]?></div>
                    <div class="setting__changeBlock">
                      <a href="/view/admin/scheduleLessonsClass/<?php echo $codes[$i]["Codes_Code"]?>" class="setting__button">Роклад уроків</a>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="settings__setting setting"></div>
                </div>
              </div>
            </div>
            <div class="section__imageBlock imageBlock imageBlock_scheduleLessons">
              <img class="imageBlock__image" src="/img/config/admin/calendar.webp" alt="Роклад уроків"/>
            </div>
          </div>
          <div class="mainBlock__section section <?php if(isset($_GET["view"])&&$_GET["view"]=="codes"){ echo "section_active"; }?>">
            <div class="section__infoBlock infoBlock infoBlock_codes">
              <div class="infoBlock__wrapper">
                <h2 class="infoBlock__desc desc">
                  <img src="/img/config/admin/advice-message.png" alt="Порада" class="desc__image">
                  Налаштуйте коди доступу для кожного класу, щоб ніхто з шахраїв не змів вдертися без запрошення на дистанційний урок
                </h2>
                <?php $codes = CODES::getAllFormatedCodes(); ?>
                <div class="infoBlock__settings settings">
                  <?php 
                  for ($i=0; $i < count($codes); $i++) {
                    if($codes[$i]["Codes_ClassName"]=="Адмін Панель"){
                      continue;
                    }
                  ?>
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/binary-code-small.png" alt="Код доступу" class="setting__image"></div>
                    <div class="setting__title">
                    <input type="text" class="setting__input setting__input_second" maxlength="9" required name="ClassName:<?php echo $codes[$i]["Codes_ID"]?>" value="<?php echo $codes[$i]["Codes_ClassName"]?>" placeholder="Введіть назву класу">
                    </div>
                    <div class="setting__changeBlock">
                      <input type="text" class="setting__input setting__input_numbers" maxlength="5" required name="Code:<?php echo $codes[$i]["Codes_ID"]?>" value="<?php echo $codes[$i]["Codes_Code"]?>" placeholder="Введіть код доступу класу">
                    </div>
                  </div>
                  <?php } ?>
                  <div class="settings__setting setting addInputBlock">
                    <div class="setting__imageBlock"><img src="/img/config/admin/binary-code-small.png" alt="Код доступу" class="setting__image"></div>
                    <div class="setting__title">
                    <input type="text" class="setting__input setting__input_second" maxlength="9" required name="AddClassName" value="" placeholder="Введіть назву класу">
                    </div>
                    <div class="setting__changeBlock">
                      <input type="text" class="setting__input setting__input_numbers" maxlength="5" required name="AddCode" value="" placeholder="Введіть код доступу класу">
                    </div>
                  </div>
                  <form class="settings__setting setting <?php if(isset($_GET["view"])&&$_GET["view"]=="codes"){ echo "setting_visible"; }?>" method="POST">
                    <input type="hidden" name="Section" value="Codes">
                    <input type="hidden" name="Codes" value="<?php echo count($codes)?>">
                    <div class="setting__buttons">
                      <button class="setting__addBtn button" type="button">
                        <img src="/img/config/plus.png" class="btnImage" alt="Плюс">
                        Додати код доступу
                      </button>
                      <button class="setting__submitBtn button">Зберегти зміни</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="section__imageBlock imageBlock imageBlock_codes">
              <img class="imageBlock__image" src="/img/config/admin/binary-code.png" alt="Коди доступу"/>
            </div>
          </div>
          <div class="mainBlock__section section <?php if(isset($_GET["view"])&&$_GET["view"]=="scheduleLessonsClass"){ echo "section_active"; }?>">
            <div class="section__infoBlock infoBlock infoBlock_scheduleLessonsClass">
              <div class="infoBlock__wrapper">
                <?php if(isset($_GET["view"])&&$_GET["view"]=="scheduleLessonsClass"&&!CODES::isCodeExist($_GET["class"])){
                  REDIRECT::toPageViaLink("/view/admin/scheduleLessons");
                }?>
                <div class="infoBlock__settings settings settings_classNavigation">
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/date-span.png" alt="День" class="setting__image"></div>
                    <div class="setting__title">1 День</div>
                    <div class="setting__changeBlock">
                      <a href="/view/admin/scheduleLessonsClassSchedule/<?php echo $_GET["class"]?>/1" class="setting__button">ПОНЕДІЛОК</a>
                    </div>
                  </div>
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/date-span.png" alt="День" class="setting__image"></div>
                    <div class="setting__title">2 День</div>
                    <div class="setting__changeBlock">
                      <a href="/view/admin/scheduleLessonsClassSchedule/<?php echo $_GET["class"]?>/2" class="setting__button">ВІВТОРОК</a>
                    </div>
                  </div>
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/date-span.png" alt="День" class="setting__image"></div>
                    <div class="setting__title">3 День</div>
                    <div class="setting__changeBlock">
                      <a href="/view/admin/scheduleLessonsClassSchedule/<?php echo $_GET["class"]?>/3" class="setting__button">СЕРЕДА</a>
                    </div>
                  </div>
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/date-span.png" alt="День" class="setting__image"></div>
                    <div class="setting__title">4 День</div>
                    <div class="setting__changeBlock">
                      <a href="/view/admin/scheduleLessonsClassSchedule/<?php echo $_GET["class"]?>/4" class="setting__button">ЧЕТВЕР</a>
                    </div>
                  </div>
                  <div class="settings__setting setting">
                    <div class="setting__imageBlock"><img src="/img/config/admin/date-span.png" alt="День" class="setting__image"></div>
                    <div class="setting__title">5 День</div>
                    <div class="setting__changeBlock">
                      <a href="/view/admin/scheduleLessonsClassSchedule/<?php echo $_GET["class"]?>/5" class="setting__button">П'ЯТНИЦЯ</a>
                    </div>
                  </div>
                  <div class="settings__setting setting"></div>
                </div>
              </div>
            </div>
            <div class="section__imageBlock imageBlock imageBlock_scheduleLessonsClass">
              <img class="imageBlock__image" src="/img/config/admin/calendar.webp" alt="Роклад уроків"/>
            </div>
          </div>
          <div class="mainBlock__section section <?php if(isset($_GET["view"])&&$_GET["view"]=="scheduleLessonsClassSchedule"){ echo "section_active"; }?>">
            <div class="section__infoBlock infoBlock infoBlock_scheduleLessonsClass">
              <div class="infoBlock__wrapper">
                <?php if((isset($_GET["view"])&&$_GET["view"]=="scheduleLessonsClassSchedule"&&!CODES::isCodeExist($_GET["class"]))||(isset($_GET["day"])&&(intval($_GET["day"])<1||intval($_GET["day"])>5))){
                  REDIRECT::toPageViaLink("/view/admin/scheduleLessons");
                } else if(isset($_GET["day"])&&isset($_GET["class"])){?>
                <form class="infoBlock__settings settings" method="POST">
                  <input type="hidden" name="Section" value="ScheduleLessons">
                  <div class="settings__setting setting setting_classSchedule">
                    <div class="setting__dayTitle">
                      <?php switch (intval($_GET["day"])) {
                        case 1:
                          echo "ПОНЕДІЛОК"; 
                          break;
                        case 2:
                          echo "ВІВТОРОК"; 
                          break;
                        case 3:
                          echo "СЕРЕДА"; 
                          break;
                        case 4:
                          echo "ЧЕТВЕР"; 
                          break;
                        case 5:
                          echo "П'ЯТНИЦЯ"; 
                          break;
                      }?>
                    </div>
                    <?php 
                      $scheduleLessons = LESSONS::getLessonsViaCodeAndDay($_GET["class"],$_GET["day"]);
                      if(count($scheduleLessons)>0){
                        $scheduleLessons = $scheduleLessons[0];
                      }
                      for ($l=1; $l <= 7; $l++) { 
                        $lessonNumber = $l;
                        $lessonTeachers = [];
                        $lessonLessons = [];
                        for ($r=0; $r < count($scheduleLessons); $r++) {
                          if($scheduleLessons[$r]["ScheduleLessons_LessonNumber"]==$l){
                            $lessonNumber = $scheduleLessons[$r]["ScheduleLessons_LessonNumber"];
                            $lessonTeachers = explode(",", $scheduleLessons[$r]["ScheduleLessons_TeacherID"]);
                            $lessonLessons = explode(",", $scheduleLessons[$r]["ScheduleLessons_LessonID"]);
                          } else {
                            continue;
                          }
                        }
                    ?>
                        <div class="setting__lessonBlock lessonBlock">
                          <div class="lessonBlock__number"><?php echo $l?>.</div>
                          <div class="lessonBlock__lessonWrapper">
                            <div class="lessonBlock__lessonSelectBlock lessonBlock__lessonSelectBlock_active">
                              <div class="lessonBlock__selectLessons">
                                <select name="Lesson:<?php echo $_GET["day"].":".$l?>:1" class="setting__input setting__input_active">
                                  <option value="0">Виберіть предмет</option>
                                  <?php for ($lesson=0; $lesson < count($lessons); $lesson++) { ?>
                                    <option value="<?php echo $lessons[$lesson]["Lessons_ID"]?>" <?php if(count($lessonLessons)>0&&$lessons[$lesson]["Lessons_ID"]==$lessonLessons[0]){echo "selected";}?>><?php echo $lessons[$lesson]["Lessons_Name"]?></option>
                                  <?php } ?>
                                </select>
                                <button type="button" class="lessonBlock__button lessonBlock__button_addLesson <?php if(count($lessonLessons)==0||(count($lessonLessons)>0&&$lessonLessons[1]==0)){echo "lessonBlock__button_active";}?>">Додати предмет</button>
                              </div>
                              <div class="lessonBlock__selectTeachers lessonBlock__selectTeachers_active">
                                <select name="Teacher:<?php echo $_GET["day"].":".$l?>:1:1" class="setting__input setting__input_active">
                                  <option value="0">Виберіть вчителя</option>
                                  <?php for ($teacher=0; $teacher < count($teachers); $teacher++) { ?>
                                    <option value="<?php echo $teachers[$teacher]["Teachers_ID"]?>" <?php if(count($lessonTeachers)>0&&$teachers[$teacher]["Teachers_ID"]==$lessonTeachers[0]){echo "selected";}?>><?php echo $teachers[$teacher]["Teachers_Name"]?></option>
                                  <?php } ?>
                                </select>
                                <select name="Teacher:<?php echo $_GET["day"].":".$l?>:1:2" class="setting__input setting__input_second <?php if(count($lessonTeachers)>0&&$lessonTeachers[1]>0){echo "setting__input_active";}?>">
                                  <option value="0">Виберіть вчителя</option>
                                  <?php for ($teacher=0; $teacher < count($teachers); $teacher++) { ?>
                                    <option value="<?php echo $teachers[$teacher]["Teachers_ID"]?>" <?php if(count($lessonTeachers)>0&&$teachers[$teacher]["Teachers_ID"]==$lessonTeachers[1]){echo "selected";}?>><?php echo $teachers[$teacher]["Teachers_Name"]?></option>
                                  <?php } ?>
                                </select>
                                <button type="button" class="lessonBlock__button lessonBlock__button_addTeacher <?php if(count($lessonTeachers)==0||(count($lessonTeachers)>0&&$lessonTeachers[1]==0)){echo "lessonBlock__button_active";}?>">Додати вчителя</button>
                              </div>
                            </div>
                            <div class="lessonBlock__lessonSelectBlock <?php if(count($lessonLessons)>0&&$lessonLessons[1]>0){echo "lessonBlock__lessonSelectBlock_active";}?>">
                              <div class="lessonBlock__selectLessons">
                                <select name="Lesson:<?php echo $_GET["day"].":".$l?>:2" class="setting__input setting__input_active">
                                  <option value="0">Виберіть предмет</option>
                                  <?php for ($lesson=0; $lesson < count($lessons); $lesson++) { ?>
                                    <option value="<?php echo $lessons[$lesson]["Lessons_ID"]?>" <?php if(count($lessonLessons)>0&&$lessons[$lesson]["Lessons_ID"]==$lessonLessons[1]){echo "selected";}?>><?php echo $lessons[$lesson]["Lessons_Name"]?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="lessonBlock__selectTeachers lessonBlock__selectTeachers_active">
                                <div class="selectLine"></div>
                                <select name="Teacher:<?php echo $_GET["day"].":".$l?>:2:1" class="setting__input setting__input_active">
                                  <option value="0">Виберіть вчителя</option>
                                  <?php for ($teacher=0; $teacher < count($teachers); $teacher++) { ?>
                                    <option value="<?php echo $teachers[$teacher]["Teachers_ID"]?>" <?php if(count($lessonTeachers)>0&&$teachers[$teacher]["Teachers_ID"]==$lessonTeachers[2]){echo "selected";}?>><?php echo $teachers[$teacher]["Teachers_Name"]?></option>
                                  <?php } ?>
                                </select>
                                <select name="Teacher:<?php echo $_GET["day"].":".$l?>:2:2" class="setting__input setting__input_second <?php if(count($lessonTeachers)>0&&$lessonTeachers[3]>0){echo "setting__input_active";}?>">
                                  <option value="0">Виберіть вчителя</option>
                                  <?php for ($teacher=0; $teacher < count($teachers); $teacher++) { ?>
                                    <option value="<?php echo $teachers[$teacher]["Teachers_ID"]?>" <?php if(count($lessonTeachers)>0&&$teachers[$teacher]["Teachers_ID"]==$lessonTeachers[3]){echo "selected";}?>><?php echo $teachers[$teacher]["Teachers_Name"]?></option>
                                  <?php } ?>
                                </select>
                                <button type="button" class="lessonBlock__button lessonBlock__button_addTeacher <?php if(count($lessonTeachers)==0||(count($lessonTeachers)>0&&$lessonTeachers[3]==0)){echo "lessonBlock__button_active";}?>">Додати вчителя</button>
                              </div>
                            </div>
                          </div>
                        </div>
                  <?php 
                      } 
                  ?>
                  </div>
                  <div class="settings__setting setting">
                  <div class="setting__buttons">
                      <button class="setting__submitBtn button" type="submit">Зберегти зміни</button>
                    </div>
                  </div>
                </form>
                <?php } ?>
              </div>
            </div>
            <div class="section__imageBlock imageBlock imageBlock_scheduleLessonsClass">
              <img class="imageBlock__image" src="/img/config/admin/calendar.webp" alt="Роклад уроків"/>
            </div>
          </div>
        </div>
      </main>
    </main>

    <script src="/projectBlocks/admin/js/admin.js"></script>

  </body>
</html>