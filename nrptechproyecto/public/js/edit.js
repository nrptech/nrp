"use strict"

let currentUserEditing = null;

function edit(elementId) {
    let toEdit = "edit" + elementId;
    let toShow = "view" + elementId;
    console.log(toEdit);

    if (currentUserEditing) {
        let previousView = "view" + currentUserEditing;
        let previousEdit = "edit" + currentUserEditing;
        
        let previousElementToShow = document.getElementById(previousView);
        let previousElementToEdit = document.getElementById(previousEdit);
        
        previousElementToShow.removeAttribute("hidden");
        previousElementToEdit.setAttribute("hidden", "hidden");
    }

    let elementToShow = document.getElementById(toShow);
    let elementToEdit = document.getElementById(toEdit);

    elementToEdit.removeAttribute("hidden");
    elementToShow.setAttribute("hidden", "hidden");

    currentUserEditing = elementId;
}