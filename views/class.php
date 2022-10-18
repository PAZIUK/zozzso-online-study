<?php 
  if(isset($_POST["code"])){
    if(CODES::isCodeBelongsAdmin($_POST["code"])){
      $_SESSION["isAdmin"] = true;
      REDIRECT::toAdminPage();
    }
    REDIRECT::toPageViaLink("index.php?action=class&code=".$_POST["code"]);
  }
  if(!isset($_GET["code"])||(isset($_GET["code"])&&count(CODES::isCodeExist($_GET["code"]))==0)||(isset($_GET["code"])&&CODES::isCodeBelongsAdmin($_GET["code"]))){  
    REDIRECT::toErrorPage();
  }
  if((isset($_GET["code"])&&!isset($_GET["view"]))||(isset($_GET["view"])&&$_GET["view"]!="navigation"&&$_GET["view"]!="day")||(isset($_GET["day"])&&intval($_GET["day"])>5)||(isset($_GET["view"])&&$_GET["view"]=="day"&&!isset($_GET["day"]))){
    REDIRECT::toPageViaLink("index.php?action=class&code=".$_GET["code"]."&view=navigation");
  }
?>
      <title><?php echo CONFIG::getTitle()?> - <?php echo CODES::getNameByCode($_GET["code"])?></title>

      <link rel="stylesheet" href="../../css/nav.css">
      <link rel="stylesheet" href="../../css/class.css">
    </head>
  <body>
  <a href=<?php echo "index.php?action=class&code=".$_GET["code"]."&view=day&day=1" ?>>First</a>
    <div class="days">
      <button id="day1">ПОНЕДІЛОК</button>
      <button id="day2">ВІВТОРОК</button>
      <button id="day3">СЕРЕДА</button>
      <button id="day4">ЧЕТВЕР</button>
      <button id="day5">П'ЯТНИЦЯ</button>
    </div>
    
    <div class="time">
      <div class="whatDay"></div>
      <div class="whatTime"><p class="h"></p>:<p class="m"></p>:<p class="s"></p></div> 
    </div>

    <header class="classInfo">
      <div class="name"></div>
      <img src="https://img.icons8.com/ios-filled/50/000000/long-arrow-left.png"/>    
    </header>

    <section class="btns day1">

      <div class="lesson" lessonName="УКРАЇНСЬКА МОВА"                            teachers="14"></div>
      <div class="lesson" lessonName="УКРАЇНСЬКА ЛІТЕРАТУРА"                      teachers="14"></div>
      <div class="lesson" lessonName="МАТЕМАТИКА"                                 teachers="29"></div>
      <div class="lesson" lessonName="ФІЗИЧНА КУЛЬТУРА"                           teachers="7"></div>
      <div class="lesson" lessonName="АНГЛІЙСЬКА МОВА"                            teachers="20"></div>
      <div class="lesson" lessonName="ФІНАНСОВО ГРАМОТНИЙ СПОЖИВАЧ"               teachers="22"></div>

    </section>

    <section class="btns day2">
      
      <div class="lesson" lessonName="ІСТОРІЯ УКРАЇНИ"                            teachers="38"></div>
      <div class="lesson" lessonName="УКРАЇНСЬКА МОВА"                            teachers="14"></div>
      <div class="lesson" lessonName="ЗАРУБІЖНА ЛІТЕРАТУРА"                       teachers="17"></div>
      <div class="lesson" lessonName="ГЕОГРАФІЯ"                                  teachers="18"></div>
      <div class="lesson" lessonName="АНГЛІЙСЬКА МОВА"                            teachers="20"></div>
      <div class="lesson" lessonName="ІНФОРМАТИКА"                                teachers="8"></div>
      <div class="lesson" lessonName="НІМЕЦЬКА МОВА"                              teachers="21"></div>

    </section>

    <section class="btns day3">

      <div class="lesson" lessonName="МУЗИЧНЕ МИСТЕЦТВО"                          teachers="11"></div>
      <div class="lesson" lessonName="УКРАЇНСЬКА МОВА"                            teachers="14"></div>
      <div class="lesson" lessonName="ОСНОВИ ЗДОРОВ'Я"                            teachers="26"></div>
      <div class="lesson" lessonName="БІОЛОГІЯ"                                   teachers="24"></div>
      <div class="lesson" lessonName="МАТЕМАТИКА"                                 teachers="29"></div>
      <div class="lesson" lessonName="ФІЗИЧНА КУЛЬТУРА"                           teachers="7"></div>
      <div class="lesson" lessonName="ОБРАЗОТВОРЧЕ МИСТЕЦТВО"                     teachers="5"></div>

    </section>

    <section class="btns day4">

      <div class="lesson" lessonName="ГЕОГРАФІЯ"                                  teachers="18"></div>
      <div class="lesson" lessonName="МАТЕМАТИКА"                                 teachers="29"></div>
      <div class="lesson" lessonName="ФІЗИЧНА КУЛЬТУРА"                           teachers="7"></div>
      <div class="lesson" lessonName="ВСЕСВІТНЯ ІСТОРІЯ"                          teachers="38"></div>
      <div class="lesson" lessonName="УКРАЇНСЬКА МОВА"                            teachers="14"></div>
      <div class="lesson" lessonName="УКРАЇНСЬКА ЛІТЕРАТУРА"                      teachers="14"></div>
      <div class="lesson" lessonName="НІМЕЦЬКА МОВА / ОСНОВИ ХРИСТИЯНСЬКОЇ ЕТИКИ" teachers="21,31"></div>

    </section>

    <section class="btns day5">

      <div class="lesson" lessonName="БІОЛОГІЯ"                                   teachers="24"></div>
      <div class="lesson" lessonName="АНГЛІЙСЬКА МОВА"                            teachers="20"></div>
      <div class="lesson" lessonName="ТРУДОВЕ НАВЧАННЯ"                           teachers="36,30"></div>
      <div class="lesson" lessonName="ТРУДОВЕ НАВЧАННЯ"                           teachers="36,30"></div>
      <div class="lesson" lessonName="МАТЕМАТИКА"                                 teachers="29"></div>
      <div class="lesson" lessonName="ЗАРУБІЖНА ЛІТЕРАТУРА"                       teachers="17"></div>

    </section>

    <script src="../../js/nav.js" async></script>
    <script src="../../js/teachers.js"></script>
    <script type="module" src="../../js/class.js"></script>

  </body>
</html>