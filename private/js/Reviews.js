document.addEventListener('DOMContentLoaded', function() {
    $.ajax({
        url: '../private/controller/reviews.php',
        method: 'GET',
        success: function(data) {
            const reviewsContainer = document.getElementById('reviewsContainer');
            const reviews = data; // Assuming data is a JSON string

            reviews.forEach(review => {
                const reviewDiv = document.createElement('div');
                reviewDiv.classList.add('review');

                const nameElement = document.createElement('h3');
                nameElement.textContent = "Name: " + review.name;

                const messageElement = document.createElement('p');
                messageElement.textContent = "Message: " + review.message;

                const timeElement = document.createElement('span');
                timeElement.textContent = "Date time: " + review.timedate;

                reviewDiv.appendChild(nameElement);
                reviewDiv.appendChild(messageElement);
                reviewDiv.appendChild(timeElement);
                reviewsContainer.appendChild(reviewDiv);
            });
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});