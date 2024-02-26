"use strict"

let currentUserEditing = null;

function editUser(userId) {
    let toEdit = "edit" + userId;
    let toShow = "view" + userId;
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

    currentUserEditing = userId;
}