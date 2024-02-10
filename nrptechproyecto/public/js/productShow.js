"use strict"

let images = document.querySelectorAll(".imgSelector img");

images.forEach(function(image) {
    image.addEventListener('click', function() {
       document.querySelector(".mainImg img").src=image.src;
    });
});