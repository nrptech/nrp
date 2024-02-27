"use strict"

function apply(elementId) {
    let toEdit = "edit" + elementId;
    let toShow = "view" + elementId;
    let toApply = "apply";

    let inputId = document.querySelectorAll("#coupon_id");

    inputId.forEach(id=>{
        id.value=elementId;
    });

    let elementToShow = document.getElementById(toShow);
    let elementToEdit = document.getElementById(toEdit);
    let elementToApply = document.getElementById(toApply);

    let guga = document.querySelectorAll(".view");

    guga.forEach(g => {
        if (g.id === toShow) {
            g.removeAttribute("hidden");
        } else {
            g.setAttribute("hidden", "hidden");
        }
    });

    elementToApply.removeAttribute("hidden")

    elementToEdit.setAttribute("hidden", "hidden");
}

function showForm(element){
    element.nextElementSibling.toggleAttribute("hidden");
}