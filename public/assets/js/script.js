// LOCATION: "accueil" page
// Display of image titles on mouse over .
// Selects all elements with class image-home-container and stores them in the imageContainers constant.
const imageContainers = document.querySelectorAll('.image-home-container');

// Iterate over each element of the constant imageContainers with forEach and stores them in the constant container.
imageContainers.forEach(container => {
    // Retrieves the element with the class image-title-container and stores it in the titleContainer constant.
    const titleContainer = container.querySelector('.image-title-container');

    // Add the first event listener on the container element.
    container.addEventListener('mouseenter', () => {
        titleContainer.style.visibility = 'visible';
    });

    // Add the second event listener on the container element.
    container.addEventListener('mouseleave', () => {
        titleContainer.style.visibility = 'hidden';
    });
});


// LOCATION: "mon-compte/modifier" page
// Automatically resize "Allergies" textarea height based on its content for edit profile form
const textarea = document.querySelector('.auto-resize');

function autoResizeTextarea(element) {
    // Textarea height reset
    element.style.height = 'auto';
    // Calculation of textarea height based on its content
    element.style.height = element.scrollHeight + 'px';
}

textarea.addEventListener('input', function() {
    // Call of the function to adjust the height of the textarea on each input
    autoResizeTextarea(this); // "(this)" represents the current textarea element
});

// Initial function call to adjust textarea height on page load
autoResizeTextarea(textarea);p