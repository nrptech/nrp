"use strict"

function show(element){
    element.setAttribute("hidden", "");
    element.nextElementSibling.removeAttribute("hidden");

}

function hide(element){
    let container = element.parentNode.parentNode;
    container.setAttribute("hidden", "");
    container.previousElementSibling.removeAttribute("hidden")
}