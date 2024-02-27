// productShow.js

document.addEventListener("DOMContentLoaded", function () {
    // Ensure the DOM is fully loaded before executing the script

    // Get all thumbnail images
    var thumbnailImages = document.querySelectorAll(".img-selector-container img");

    // Get the main image container
    var mainImageContainer = document.querySelector(".main-img-container img");

    // Add click event listeners to each thumbnail
    thumbnailImages.forEach(function (thumbnail) {
        thumbnail.addEventListener("click", function () {
            // Change the source of the main image to the clicked thumbnail's source
            mainImageContainer.src = thumbnail.src;
        });
    });
});
