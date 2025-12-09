window.addEventListener('load', function() {
 
    $.ajax({
        url: '../private/controller/galery.php',
        method: 'GET',
        success: function(data) {
            const reviewsContainer = document.getElementById('gallery');
            const galerys = data.datos; // Parse JSON data
            galerys.forEach(galery => {
                const reviewDiv = document.createElement('div');
                reviewDiv.classList.add('gallery-item');

                const nameElement = document.createElement('img');
                nameElement.src = galery.path_img;
                nameElement.alt = galery.comments;

                const caption = document.createElement('div');
                caption.classList.add('caption');
                caption.textContent = galery.comments;

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
