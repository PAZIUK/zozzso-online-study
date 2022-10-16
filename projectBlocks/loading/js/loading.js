"use strict"
const loadingLines = document.querySelectorAll(".hello__loading.loading .loading__lines .loading__line")
if(loadingLines){
    let i = 0
    loading()
    let int = setInterval(loading,250)
    function loading(){
        if(loadingLines[i]){
            loadingLines[i].classList.add("loading__line_active")
            i++
        } else {
            clearInterval(int)
        }
    }
}

const loading = document.querySelector(".hello")
if(loading){
    document.querySelector(".background").classList.add("background_active")
    setTimeout(()=>{
        let i = 100
        let int = setInterval(()=>{
            i--;
            loading.style.opacity = i/100
            if(i==0){
                loading.style.display = "none"
                clearInterval(int);
            }
        },5)
    },3000)
}
