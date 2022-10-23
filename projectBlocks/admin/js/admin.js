"use strict"

// Declaration
const navigationBtn = document.querySelector(".leftMenu .navigationBtns .navigationBtns__title");

const leftMenu = document.querySelector(".leftMenu")
const main = document.querySelector(".main")

// Manipulations with left navigation
navigationBtn.addEventListener("click",openTheNavigation)
window.addEventListener("click",function(e){checkClickArea(e)})

// Check height of left navigation
window.addEventListener("DOMContentLoaded",checkLeftNavHeight)
window.addEventListener("resize",checkLeftNavHeight)

// Functions
function openTheNavigation(){
  leftMenu.classList.toggle("leftMenu_open")
  main.classList.toggle("main_menuOpened")
}

function checkClickArea(e) {
  if(e.path[0].classList.contains("main_menuOpened")){
    leftMenu.classList.remove("leftMenu_open")
    main.classList.remove("main_menuOpened")
  }
}

function checkLeftNavHeight(){
  if(leftMenu.scrollHeight > leftMenu.offsetHeight){
    leftMenu.classList.add("leftMenu_scroll")
  } else {
    leftMenu.classList.remove("leftMenu_scroll")
  }
}
