"use strict"

// Declaration
const navigationBtn = document.querySelector(".leftMenu .navigationBtns .navigationBtns__title");
const leftMenu = document.querySelector(".leftMenu")
const main = document.querySelector(".main")
const buttonOpenLeftMenu = document.querySelector(".infoBlock__buttonOpenLeftMenu")
const addBtn = document.querySelectorAll(".infoBlock .setting__buttons .setting__addBtn")
const addBlocks = document.querySelectorAll(".infoBlock .infoBlock__settings .settings__setting.addInputBlock")
const form = document.querySelectorAll(".infoBlock .infoBlock__settings")
let lastBlockInForm = document.querySelectorAll(".infoBlock .infoBlock__settings .settings__setting")
lastBlockInForm = lastBlockInForm[lastBlockInForm.length - 1]
let formInputs = document.querySelectorAll(".infoBlock .infoBlock__settings .settings__setting input")
let numberInputs = document.querySelectorAll(".infoBlock .infoBlock__settings .settings__setting input.setting__input_numbers")
const selectsInScheduleLessons = document.querySelectorAll(".infoBlock .lessonBlock .lessonBlock__lessonSelectBlock_active .lessonBlock__selectLessons select")
const addTeacherBtnsInScheduleLessons = document.querySelectorAll(".infoBlock .lessonBlock .lessonBlock__button_addTeacher")
const addLessonBtnsInScheduleLessons = document.querySelectorAll(".infoBlock .lessonBlock .lessonBlock__button_addLesson")

// Manipulations with left navigation
navigationBtn.addEventListener("click",openTheNavigation)
buttonOpenLeftMenu.addEventListener("click",openTheNavigation)
window.addEventListener("click",function(e){checkClickArea(e)})

// Check height of elements
window.addEventListener("DOMContentLoaded",checkLeftNavHeight)
window.addEventListener("resize",checkLeftNavHeight)

// Add add block
addBtn.forEach(btn=>{
  btn.addEventListener("click",function(){
    addBlocks.forEach(block=>{
      block.classList.toggle("addInputBlock_active")
      block.querySelectorAll("input").forEach(input=>{
        input.value = "";
      })
    })
    btn.classList.toggle("setting__addBtn_active")

    removeFormInputWhenAddBlockIsClosed(document.querySelector(`form.settings__setting.setting.setting_visible input[name="AddTN"]`))
    removeFormInputWhenAddBlockIsClosed(document.querySelector(`form.settings__setting.setting.setting_visible input[name="AddTL"]`))
    removeFormInputWhenAddBlockIsClosed(document.querySelector(`form.settings__setting.setting.setting_visible input[name="AddLesson"]`))
  })
})

// Save changes at teachers block
formInputs.forEach(input=>{
  input.addEventListener("input",function(){
    let inputsInsideSaveChangesForm = document.querySelector(`form.settings__setting.setting.setting_visible input[name="${input.getAttribute('name')}"]`)
    if(!inputsInsideSaveChangesForm){
      let newSaveChangesInput = null;
      newSaveChangesInput = document.createElement("input")
      newSaveChangesInput.setAttribute('type','hidden')
      newSaveChangesInput.setAttribute('name',`${input.getAttribute("name")}`)
      newSaveChangesInput.setAttribute('value',`${input.value}`)
      document.querySelector("form.settings__setting.setting.setting_visible").appendChild(newSaveChangesInput);
    } else {
      if(input.value == input.getAttribute("value")){
        inputsInsideSaveChangesForm.remove();
      } else {
        inputsInsideSaveChangesForm.setAttribute('name',`${input.getAttribute("name")}`)
        inputsInsideSaveChangesForm.setAttribute('value',`${input.value}`)
      }
      
    }
  })
})

// Number validation for number inputs
numberInputs.forEach(input=>{
  input.addEventListener("input",function(){
    this.value = inputValidator(this.value)
  })
})

// Manipulations with blocks in schedule lesons block
addTeacherBtnsInScheduleLessons.forEach(btn=>{
  btn.addEventListener("click",function(){
    this.classList.remove("lessonBlock__button_active")
    this.parentElement.querySelectorAll(".setting__input")[1].classList.add("setting__input_active")
  })
})

addLessonBtnsInScheduleLessons.forEach(btn=>{
  btn.addEventListener("click",function(){
    this.classList.remove("lessonBlock__button_active")
    this.parentElement.parentElement.parentElement.querySelectorAll(".lessonBlock__lessonSelectBlock")[1].classList.add("lessonBlock__lessonSelectBlock_active")
  })
})

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

function removeFormInputWhenAddBlockIsClosed(form){
  if(form){ form.remove() }
}

function inputValidator(text){
  let letters = text.split("")
  let newText = ""

  for (let i = 0; i < letters.length; i++) {
    if(!isNaN(+letters[i])){ newText+= letters[i]}
  }

  return newText
}
