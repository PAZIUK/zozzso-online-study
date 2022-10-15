"use strict"

const loginInput = document.querySelector(".login .login__input")
loginInput.addEventListener("input",function(){
  if (this.value.length > 5) {
    this.value = this.value.substr(0, 5);
  }
})

function checkPassword(event){
  event.preventDefault();
  console.log(loginInput.value)
}