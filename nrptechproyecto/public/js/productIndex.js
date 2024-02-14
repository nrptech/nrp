"use strict"

let productContainer = document.querySelectorAll(".productContainer");

let leftArrow = document.querySelectorAll(".leftArrow");
let rightArrow = document.querySelectorAll(".rightArrow");

let currentImg = 0;
// function changeImg(productId, direction) {
//     let images = document.querySelectorAll('.product' + productId);

//     document.querySelector("#img"+productId+"-"+currentImg).toggleAttribute("hidden","")

//     currentImg += direction;
    

//     if(currentImg>images.length){
//         currentImg=0;
//     }else if (currentImg<0){
//         currentImg=images.length;
//     }

//     document.querySelector("#img"+productId+"-"+currentImg).toggleAttribute("hidden","")

// }

function showImages() {
    for (let i = 1; i <= productContainer.length; i++) {
        console.log("guga"+ i)
        console.log('#img' + i + "-0")
        document.querySelector('#img' + i + "-0").removeAttribute("hidden", "");
    }

}

console.log( productContainer.length);

showImages();

