"use strict"

let backButton = document.querySelector(".classInfo img");
backButton.addEventListener("click", function () {
  let arrayOfLinks = window.location.pathname.split("/");
  localStorage.setItem('classCode', arrayOfLinks[arrayOfLinks.length - 2]);
  window.location.href = "nav.html"
})
let time = 0;
let intLessons = setInterval(() => {
  addHeightProperty();
  time += 100;
}, 100)
let lessonBtns = document.querySelectorAll('button.lessonBtn');
window.onresize = () => {
  addHeightProperty();
  lessonBtns.forEach(item => {
    anim(item.parentElement, item.parentElement.parentElement, 2)
    setTimeout(item.parentElement.classList.remove('active'), 1000)
    item.parentElement.querySelector('img').classList.remove('active')
    item.parentElement.parentElement.querySelector('.teachers').classList.remove('active')
  })
}
lessonBtns.forEach(item => {
  item.addEventListener('click', function () {
    anim(this.parentElement, this.parentElement.parentElement, 1)
    setTimeout(this.parentElement.classList.toggle('active'), 1000)
    this.parentElement.querySelector('img').classList.toggle('active')
    this.parentElement.parentElement.querySelector('.teachers').classList.toggle('active')
  });
})
let lessonImgs = document.querySelectorAll('.btn img.btnImg');
lessonImgs.forEach(item => {
  item.addEventListener('click', function () {
    anim(this.parentElement, this.parentElement.parentElement, 1)
    setTimeout(this.parentElement.classList.toggle('active'), 1000)
    this.parentElement.querySelector('img').classList.toggle('active')
    this.parentElement.parentElement.querySelector('.teachers').classList.toggle('active')
  });
})

//check 1 or a lot teachers in one block
let teachers = document.querySelectorAll('.teachers');
teachers.forEach(item => {
  if (item.children.length == 1) {
    item.style.gridеemplateсolumns = "repeat(1,1fr)";
    item.style.gridGap = ".3rem";
  }
})

//animation
function anim(btn, block, num) {
  if (num && num == 1) {
    if (btn.classList.contains("active")) {
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
      let descHeight = block.querySelector(".teachers").offsetHeight;
      let btnHeight = block.querySelector(".btn").offsetHeight;
      let fullHeight = btnHeight + descHeight;
      let nowHeight = block.offsetHeight;
      let int = setInterval(() => {
        nowHeight += 5;
        block.style.height = nowHeight + "px";
        if (fullHeight <= nowHeight) {
          clearInterval(int);
        }
      }, 1)
      block.style.height = block.querySelector(".btn").offsetHeight + 8 + "px";
    }
  } else if (num && num == 2) {
    if (btn.classList.contains("active")) {
      let btnHeight = block.querySelector(".btn").offsetHeight + 8;
      let nowHeight = block.offsetHeight;
      let int = setInterval(() => {
        nowHeight -= 5;
        block.style.height = nowHeight + "px";
        if (btnHeight >= nowHeight) {
          clearInterval(int);
        }
      }, 1)
    }
  }
}

function addHeightProperty() {
  let lessons = document.querySelectorAll(".lesson");
  lessons.forEach(item => {
    let blockHeight = item.querySelector(".btn").offsetHeight + 8;
    item.style.height = blockHeight + "px";
    item.setAttribute("myHeight", blockHeight);
    if (item.querySelector(".btn").offsetHeight != 0 && time >= 1000) {
      clearInterval(intLessons)
    }
    let marginForImg = (item.querySelector(".btn").offsetHeight - 4) / 2;
    item.querySelector(".btn img.btnImg").style.top = marginForImg + "px";
  })
}

import schedule from './schedule.js';

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

function findLesson(){
  let lessonNumber = 0;
  for (let i = 0; i < Object.keys(schedule).length; i++) {
    let start = Object.values(schedule)[i][0].join("");
    let end = Object.values(schedule)[i][1].join("");
    let date = new Date();
    let hours = date.getHours();
    let minutes = date.getMinutes();
    let seconds = date.getSeconds();
    if(checkTime(start, end, hours, minutes, seconds)){
      lessonNumber = Object.keys(schedule)[i];
    }
  }
  return lessonNumber;
}

function showWhatLesson(){
  if(new Date().getDay() == getDayNumber()){
    let lessonNumber = findLesson()+""
    let lessonButtons = document.querySelectorAll(".btns .lesson .btn .lessonNumber")
    lessonButtons.forEach(item=>{
      if(item.textContent.split(".")[0]==lessonNumber){
        item.parentElement.classList.add('showLesson')
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
  let day = document.querySelector(".classInfo .name").textContent;
  for (let i = 0; i < Object.keys(days).length; i++) {
    if(Object.values(days)[i]==day){
      dayNumber = Object.keys(days)[i]
    }
  }
  return dayNumber;
}

setTimeout(showWhatLesson, 2900)
