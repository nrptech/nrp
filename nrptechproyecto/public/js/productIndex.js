"use strict"

let productContainer = document.querySelectorAll(".productContainer");

function showImages() {
    for (let i = 1; i <= productContainer.length; i++) {
        console.log("guga" + i)
        console.log('#img' + i + "-0")
        document.querySelector('#img' + i + "-0").removeAttribute("hidden", "");
    }

}

$(document).ready(function () {

    $("#category").change(function () {
        var selectedCategory = $(this).val();
        if (selectedCategory!=0) {
            console.log(selectedCategory)
            $(".product").hide();
            $("." + selectedCategory).show();
        } else {
            $(".product").show();
        }

    });
});

console.log(productContainer.length);

showImages();

