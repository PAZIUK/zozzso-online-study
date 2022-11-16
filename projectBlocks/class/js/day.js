"use strict"

// Lessons buttons animation (from right to center)
document.addEventListener("DOMContentLoaded",showLessons)
function showLessons() {
  let btnsBlocks = document.querySelectorAll(".dayButtons .lesson");
  let i = 0;
  let int = setInterval(()=>{
    if(i<btnsBlocks.length){
      btnsBlocks[i].classList.add("lesson_active")
      i++
    } else {
      clearInterval(int)
    }
  },200)
}

let time = 0;
let intLessons = setInterval(() => {
  addHeightProperty();
  time += 100;
}, 100)

let lessonBtns = document.querySelectorAll('.dayButtons .lesson__btnBlock .lesson__btn');
window.onresize = () => {
  addHeightProperty();
  lessonBtns.forEach(item => {
    anim(item.parentElement, item.parentElement.parentElement, 2)
    setTimeout(item.parentElement.classList.remove('lesson__btnBlock_active'), 1000)
    item.parentElement.querySelector('.lesson__img').classList.remove('lesson__img_active')
    item.parentElement.parentElement.querySelector('.teachers').classList.remove('teachers_active')
  })
}
lessonBtns.forEach(item => {
  item.addEventListener('click', function () {
    anim(this.parentElement, this.parentElement.parentElement, 1)
    setTimeout(this.parentElement.classList.toggle('lesson__btnBlock_active'), 1000)
    this.parentElement.querySelector('.lesson__img').classList.toggle('lesson__img_active')
    this.parentElement.parentElement.querySelector('.teachers').classList.toggle('teachers_active')
  });
})

document.querySelectorAll('.dayButtons .teachers .teacher .teacher__button.button_link').forEach(item => {
  item.addEventListener('click', function () {
    window.open(this.getAttribute("link"));
  });
})

//animation
function anim(btn, block, num) {
  if (num && num == 1) {
    if (btn.classList.contains("lesson__btnBlock_active")) {
      //друге нажаття
      let blockHeight = block.getAttribute("myHeight");
      let nowHeight = block.offsetHeight;
      let int = setInterval(() => {
        nowHeight -= 5;
        block.style.height = nowHeight + "px";
        if (blockHeight == nowHeight) {
          clearInterval(int);
        } else if (blockHeight > nowHeight) {
          block.style.height = blockHeight + "px";
          clearInterval(int);
        }
      }, 1)
    } else {
      //перше нажаття
      let descHeight = block.querySelector(".teachers").offsetHeight - 5;
      let btnHeight = block.querySelector(".lesson__btnBlock").offsetHeight;
      let fullHeight = btnHeight + descHeight;
      let nowHeight = block.offsetHeight;
      let int = setInterval(() => {
        nowHeight += 5;
        block.style.height = nowHeight + "px";
        if (fullHeight <= nowHeight) {
          clearInterval(int);
        }
      }, 1)
      block.style.height = block.offsetHeight + 8 + "px";
    }
  } else if (num && num == 2) {
    if (btn.classList.contains("lesson__btnBlock_active")) {
      let blockHeight = block.getAttribute("myHeight");
      let nowHeight = block.offsetHeight;
      let int = setInterval(() => {
        nowHeight -= 5;
        block.style.height = nowHeight + "px";
        if (blockHeight == nowHeight) {
          clearInterval(int);
        } else if (blockHeight > nowHeight) {
          block.style.height = blockHeight + "px";
          clearInterval(int);
        }
      }, 1)
    }
  }
}

function addHeightProperty() {
  let lessons = document.querySelectorAll(".lesson");
  lessons.forEach(item => {
    let blockHeight = item.querySelector(".lesson__btnBlock").offsetHeight + 8;
    item.style.height = blockHeight + "px";
    item.setAttribute("myHeight", blockHeight);
    if (item.querySelector(".lesson__btnBlock").offsetHeight != 0 && time >= 1000) {
      clearInterval(intLessons)
    }
  })
}


function getSchedule(){
   $.ajax({
    url: '/projectBlocks/class/php/class.php',
    dataType: 'html',
    success: function(data){
      showWhatLesson(JSON.parse(data))

    }
  });
}

function checkTime (start, end, hours, minutes, seconds){
  let s = 60,
      d = ':',
      b = start.split(d);
      b = b[0]* s * s + b [1] * s + +b[2];
  let e = end.split(d);
      e = e[0]* s * s + e [1] * s + +e[2];
  let t = hours * s * s + minutes * s + seconds;

  return (t >= b && t <= e);
}

function findLesson(schedule){
  if(schedule){
    let lessonNumber = 0;
    for (let i = 0; i < Object.keys(schedule).length; i++) {
      let start = Object.values(schedule)[i][0];
      let end = Object.values(schedule)[i][1];
      let date = new Date();
      let hours = date.getHours();
      let minutes = date.getMinutes() + 3;
      let seconds = date.getSeconds();
      if(checkTime(start, end, hours, minutes, seconds)){
        lessonNumber = Object.keys(schedule)[i];
      }
    }
    return lessonNumber;
  } else {
    return "";
  }
}

function showWhatLesson(schedule){
  if(new Date().getDay() == getDayNumber()){
    let lessonNumber = findLesson(schedule)+""
    let lessonButtons = document.querySelectorAll(".dayButtons .lesson .lesson__btnBlock .lesson__btn .lesson__number")
    lessonButtons.forEach(item=>{
      if(item.textContent.split(".")[0]==lessonNumber){
        let int = setInterval(()=>{
          if(showLessonsTime>=2900){
            clearInterval(showLessonsInt);
            item.parentElement.classList.add('lesson__btn_showLesson')
            clearInterval(int);
          }
        },100)
      }
    }) 
  }
}

function getDayNumber(){
  let dayNumber = 0;
  let days = {
    1:"ПОНЕДІЛОК",
    2:"ВІВТОРОК",
    3:"СЕРЕДА",
    4:"ЧЕТВЕР",
    5:"П'ЯТНИЦЯ"
  }
  let day = document.querySelector(".classInfo .classInfo__name").textContent;
  for (let i = 0; i < Object.keys(days).length; i++) {
    if(Object.values(days)[i]==day){
      dayNumber = Object.keys(days)[i]
    }
  }
  return dayNumber;
}

let showLessonsTime = 0;
let showLessonsInt = setInterval(()=>{
  showLessonsTime += 100;
},100)

getSchedule();