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

function addPayMethod(element){
    element.nextElementSibling.toggleAttribute("hidden")
}

function edit(){
    let view = document.getElementById("view");
    let edit = document.getElementById("edit");

    edit.removeAttribute("hidden");
    view.setAttribute("hidden","");
}

function view(){
    let view = document.getElementById("view");
    let edit = document.getElementById("edit");

    view.removeAttribute("hidden");
    edit.setAttribute("hidden","");
}