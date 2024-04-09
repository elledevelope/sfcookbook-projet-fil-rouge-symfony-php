//  ------------------------ Toggle Menu :

const burgerIcon = document.querySelector('.burger');
const closeIcon = document.querySelector('.close-x');
const menu = document.querySelector('.nav-links');


// click event burger icon      
burgerIcon.addEventListener('click', () => {
    menu.style.display = 'block';
});

// click event close-x icon
closeIcon.addEventListener('click', () => {
    menu.style.display = 'none';
});



// --------------- Add / Remove favorite recipe:
$('.like-icon').click(function () {
    const $icon = $(this).find('i');
    const $text = $(this).find('p');
    const recipeId = $(this).data('recipe-id');
    const isFavorite = $(this).hasClass('clicked');

    // Toggle visibility of the text
    $text.toggle();

    // Endpoint based on whether the recipe is being added or removed from favorites
    const endpoint = isFavorite ? '/remove-from-favorites/' : '/add-to-favorites/';

    // AJAX-query
    $.ajax({
        url: endpoint + recipeId,
        type: isFavorite ? 'DELETE' : 'POST',
        success: (response) => {
            if (response.success) {
                // Toggle the 'clicked' class on the like-icon
                $(this).toggleClass('clicked');

                // Explicitly add or remove classes to ensure correct icon is displayed
                if (isFavorite) {
                    $icon.removeClass('bx-bookmark-heart').addClass('bxs-bookmark-heart');
                } else {
                    $icon.removeClass('bxs-bookmark-heart').addClass('bx-bookmark-heart');
                }

                if (isFavorite) {
                    // alert('Recipe removed from favorites!');
                } else {
                    // alert('Recipe added to favorites!');
                }
            } else {
                alert('Error occurred while processing your request!');
            }
        },
        error: () => {
            alert('Error occurred while processing your request!');
        }
    });
});
