"use strict"

let productContainer = document.querySelectorAll(".productContainer");

let leftArrow = document.querySelectorAll(".leftArrow");
let rightArrow = document.querySelectorAll(".rightArrow");

let currentImg = 0;
function changeImg(productId, direction) {
    let images = document.querySelectorAll('.product' + productId);

    document.querySelector("#img"+productId+"-"+currentImg).toggleAttribute("hidden","")
    
    currentImg += direction;
    

    if(currentImg>images.length){
        currentImg=0;
    }else if (currentImg<0){
        currentImg=images.length;
    }

    document.querySelector("#img"+productId+"-"+currentImg).toggleAttribute("hidden","")

}

function showImages() {
    for (let i = 1; i <= productContainer.length; i++) {
        document.querySelector('#img' + i + "-0").removeAttribute("hidden", "");
    }

}

showImages();
