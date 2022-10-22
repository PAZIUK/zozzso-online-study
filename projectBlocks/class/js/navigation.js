"use strict"

// Watch
let whatTimeBlock = document.querySelector(".time")
function timeFormatter(date){
  const daysNames = {"Monday":"ПОНЕДІЛОК","Tuesday":"ВІВТОРОК","Wednesday":"СЕРЕДА","Thursday":"ЧЕТВЕР","Friday":"П'ЯТНИЦЯ","Saturday":"СУБОТА","Sunday":"НЕДІЛЯ"}
  const nowTime = date.toLocaleString('en-UK', {timeZone: 'Europe/Kiev', dateStyle: 'full', timeStyle: 'full'})
  let enDay = nowTime.split(",")[0]
  if(Object.keys(daysNames).includes(enDay)){
    whatTimeBlock.querySelector(".time__whatDay").textContent = Object.values(daysNames)[Object.keys(daysNames).indexOf(enDay)]
  }
  whatTimeBlock.querySelector(".time__whatTime p.h").textContent = nowTime.split(",")[1].split(" ")[5].split(":")[0]
  whatTimeBlock.querySelector(".time__whatTime p.m").textContent = nowTime.split(",")[1].split(" ")[5].split(":")[1]
  whatTimeBlock.querySelector(".time__whatTime p.s").textContent = nowTime.split(",")[1].split(" ")[5].split(":")[2]
}

setInterval(()=>{
  const date = new Date();
  timeFormatter(date)
},1000)