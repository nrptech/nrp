"use strict"

function editUser(userId){
    let toEdit ="edit" + userId
    let toShow = "view" + userId
    console.log(toEdit)

    let elementToShow = document.getElementById(toShow);
    let elementToEdit = document.getElementById(toEdit);

    elementToEdit.removeAttribute("hidden");
    elementToShow.setAttribute("hidden","hidden");
}