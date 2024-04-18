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
$('.like-icon').on('click', function (event) {
    // Ensure the event is triggered by the .like-icon div or its children
    if (!$(event.target).closest('.like-icon').length) {
        return; // Ignore clicks on other elements
    }

    const $icon = $(this).find('i');
    const $text = $(this).find('p');
    const recipeId = $(this).data('recipe-id');
    const isFavorite = $(this).hasClass('clicked');

    // Toggle the 'clicked' class on the like-icon
    // $(this).toggleClass('clicked');

    // Toggle visibility of the text
    $text.toggle();

    // Toggle between solid and outline heart icons
    if ($icon.hasClass('bx-bookmark-heart')) {
        $icon.removeClass('bx-bookmark-heart').addClass('bxs-bookmark-heart');
    } else {
        $icon.removeClass('bxs-bookmark-heart').addClass('bx-bookmark-heart');
    }

    // Ensure style is applied before AJAX request
    // Trigger re-render or refresh
    $text.css('opacity', '0').css('opacity', '1');

    // Endpoint based on whether the recipe is being added or removed from favorites
    const endpoint = isFavorite ? '/remove-from-favorites/' : '/add-to-favorites/';

    // AJAX-query
    $.ajax({
        url: endpoint + recipeId,
        type: isFavorite ? 'DELETE' : 'POST',
        success: (response) => {
            if (response.success) {
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



