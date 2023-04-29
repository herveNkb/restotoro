// Selects all elements with class image-home-container
// and stores them in the imageContainers constant.
const imageContainers = document.querySelectorAll('.image-home-container');

// We iterate over each element of the constant image Containers
// with forEach and stores them in the constant container..
imageContainers.forEach(container => {
    // Retrieves the element with the class image-title-container
    // and stores it in the titleContainer constant.
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
