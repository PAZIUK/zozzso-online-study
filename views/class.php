<?php 
  if(isset($_POST["code"])){
    if(CODES::isCodeBelongsAdmin($_POST["code"])){
      $_SESSION["isAdmin"] = true;
      REDIRECT::toAdminPage();
    }
    REDIRECT::toPageViaLink("/view/class/".$_POST["code"]);
  }
  if(!isset($_GET["code"])||(isset($_GET["code"])&&count(CODES::isCodeExist($_GET["code"]))==0)||(isset($_GET["code"])&&CODES::isCodeBelongsAdmin($_GET["code"]))){  
    REDIRECT::toErrorPage();
  }
  if((isset($_GET["code"])&&!isset($_GET["view"]))||(isset($_GET["view"])&&$_GET["view"]!="navigation"&&$_GET["view"]!="day")||(isset($_GET["day"])&&intval($_GET["day"])>5)||(isset($_GET["view"])&&$_GET["view"]=="day"&&!isset($_GET["day"]))){
    REDIRECT::toPageViaLink("/view/class/".$_GET["code"]."/navigation");
  }
?>
      <title><?php echo $siteName?> - <?php echo CODES::getNameByCode($_GET["code"])?></title>

      <link rel="stylesheet" href="/css/class.css">
    </head>
  <body>

  <?php if(isset($_GET["view"])&&$_GET["view"]=="navigation"){ ?> 

    <a class="returnBack returnBack_active" href="/">
			<img src="/img/config/arrow-left.png" class="returnBack__img">
		</a>

    <section class="daysButtons">
      <a class="daysButtons__link" href="/view/class/<?php echo $_GET["code"]?>/day/1">ПОНЕДІЛОК</a>
      <a class="daysButtons__link" href="/view/class/<?php echo $_GET["code"]?>/day/2">ВІВТОРОК</a>
      <a class="daysButtons__link" href="/view/class/<?php echo $_GET["code"]?>/day/3">СЕРЕДА</a>
      <a class="daysButtons__link" href="/view/class/<?php echo $_GET["code"]?>/day/4">ЧЕТВЕР</a>
      <a class="daysButtons__link" href="/view/class/<?php echo $_GET["code"]?>/day/5">П'ЯТНИЦЯ</a>
    </section>
    
    <div class="time">
      <div class="time__whatDay">День</div>
      <div class="time__whatTime"><p class="h">00</p>:<p class="m">00</p>:<p class="s">00</p></div> 
    </div>

    <div class="background background_active"></div>

    <script src="/projectBlocks/class/js/navigation.js"></script>

  <?php } else if(isset($_GET["view"])&&$_GET["view"]=="day"){ ?>

    <header class="classInfo">
      <div class="classInfo__name"><?php echo CONFIG::getDayName(intval($_GET["day"]))?></div>
      <a href="/view/class/<?php echo $_GET["code"]?>/navigation"><img class="classInfo__img" src="/img/config/arrow-left.png" alt="Назад"/></a>    
    </header>

    <section class="dayButtons">

      <?php 
        $lessonsInfo = LESSONS::getLessonsViaCodeAndDay($_GET["code"],$_GET["day"]);
        if (count($lessonsInfo)>0){
          for ($i=0; $i < count($lessonsInfo[0]); $i++) { 
            $lessonName = "";
            $lessonIDs = explode(",",$lessonsInfo[0][$i]["ScheduleLessons_LessonID"]);
            for ($ind=0; $ind < count($lessonIDs); $ind++) {
              for ($index=0; $index < count($lessonsInfo[2]); $index++) { 
                if($lessonsInfo[2][$index]["Lessons_ID"]==intval($lessonIDs[$ind])){
                  if($ind>0){
                    $lessonName .= " / ".$lessonsInfo[2][$index]["Lessons_Name"];
                  } else {
                    $lessonName .= $lessonsInfo[2][$index]["Lessons_Name"];
                  }
                }
              }
            }
            ?>
            <div class="dayButtons__lesson lesson" myheight="53">
              <div class="lesson__btnBlock">
                <button class="lesson__btn">
                  <div class="lesson__name"><?php echo $lessonName?></div>
                  <div class="lesson__number"><?php echo $lessonsInfo[0][$i]["ScheduleLessons_LessonNumber"]?>.</div>
                  <img class="lesson__img" src="/img/config/plus.png" alt=""/>
                </button>
              </div>
              <div class="lesson__teachers teachers">
              <?php 
                $teachers = explode(",",$lessonsInfo[0][$i]["ScheduleLessons_TeacherID"]);
                $teacherName = "";
                $teacherLink = "";
                for ($I=0; $I < count($teachers); $I++) { 
                  for ($ind=0; $ind < count($lessonsInfo[1]); $ind++) {
                    for ($index=0; $index < count($lessonsInfo[1]); $index++) { 
                      if($teachers[$I]==$lessonsInfo[1][$index]["Teachers_ID"]){
                        $teacherName = $lessonsInfo[1][$index]["Teachers_Name"];
                        $teacherLink = $lessonsInfo[1][$index]["Teachers_Link"];
                      }
                    }
                  }
                  ?>
                  <div class="teachers__teacher teacher">
                    <div class="teacher__info">
                      <div class="teacher__desc"><?php echo $teacherName?></div>
                    </div>
                    <button class="teacher__button button button_link" link="<?php echo $teacherLink?>"><?php echo CONFIG::getBtnRedirectTo()?></button>
                  </div>
                <?php 
                } 
              ?>
              </div>
            </div>
            <?php
          }
        }
      ?>

    </section>

    <div class="background"></div>

    <script src="/projectBlocks/class/js/day.js"></script>

    <?php } ?>

  </body>
</html>