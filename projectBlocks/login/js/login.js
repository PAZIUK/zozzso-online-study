"use strict"

const loginInput = document.querySelector(".login .login__input")
const loginError = document.querySelector(".login .login__error")
const loginClassName = document.querySelector(".login .login__className")

loginInput.addEventListener("input",function(){
  this.value = inputValidator(this.value)
  if (this.value.length > 5)  { this.value = this.value.slice(0, 5) }
  if (this.value.length < 5)  { loginClassName.classList.remove("login__className_active") }
  if (this.value.length == 5) { passwordIsExist() }
})

window.addEventListener("DOMContentLoaded",checkSavedPassword)

function inputValidator(text){
  let letters = text.split("")
  let newText = ""

  for (let i = 0; i < letters.length; i++) {
    if(!isNaN(+letters[i])){ newText+= letters[i]}
  }

  return newText
}

function checkPassword(event){
  if(loginInput.value.length<5 || !loginClassName.classList.contains("login__className_active")){
    event.preventDefault();
    passwordError();
  } else {
    localStorage.setItem("zozzso-online-study_codes_code",loginInput.value)
  }
}

function passwordIsExist(){
  $.ajax({
    url: '/projectBlocks/login/php/login.php', 
    method: 'get',
    dataType: 'text',
    data: {code: loginInput.value},
    success: function(data){
      if(data){showClassName(data)}
    }
  });
}

function checkSavedPassword(){
  let savedCode = localStorage.getItem("zozzso-online-study_codes_code")
  if(savedCode){ 
    loginInput.value = savedCode 
    passwordIsExist()
  }
}

function passwordError(){
  loginClassName.classList.remove("login__className_active")
  loginError.classList.add("login__error_active")
  setTimeout(()=>{loginError.classList.remove("login__error_active")},3000)
}

function showClassName(name){
  loginClassName.textContent = name
  loginClassName.classList.add("login__className_active")
}