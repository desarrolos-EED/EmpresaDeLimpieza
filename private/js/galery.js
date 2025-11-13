window.addEventListener('load', function() {
 
    $.ajax({
        url: '../private/controller/galery.php',
        method: 'GET',
        success: function(data) {
            const reviewsContainer = document.getElementById('gallery');
            const reviews = data; // Assuming data is a JSON string

            reviews.forEach(review => {
                const reviewDiv = document.createElement('div');
                reviewDiv.classList.add('gallery-item');

                const nameElement = document.createElement('img');
                nameElement.src = review.path_img;
                nameElement.alt = review.comments;

                const caption = document.createElement('div');
                caption.classList.add('caption');
                caption.textContent = review.comments;

                reviewDiv.appendChild(nameElement);
                reviewDiv.appendChild(caption);
                reviewsContainer.appendChild(reviewDiv);
            });
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});

$(document).ready(function() {
    $(document).on('click', '.gallery-item img', function() {
        $('#modalImg').attr('src', $(this).attr('src'));
        $('#modalCaption').text($(this).siblings('.caption').text());
        $('#imageModal').css('display', 'flex');
    });
    $('#closeModal').on('click', function() {
        $('#imageModal').hide();
    });
    $('#imageModal').on('click', function(e) {
        if (e.target === this) {
            $('#imageModal').hide();
        }
    });
});
