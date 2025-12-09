document.addEventListener('DOMContentLoaded', function() {
    $.ajax({
        url: '../private/controller/reviews.php',
        method: 'GET',
        success: function(data) {
            const reviewsContainer = document.getElementById('reviewsContainer');
            reviewsContainer.innerHTML = ''; // Clear previous reviews
            
            const reviews = Object.values(data);
            
            reviews.forEach(review => {
                const reviewDiv = document.createElement('div');
                reviewDiv.classList.add('review');

                const nameElement = document.createElement('h3');
                nameElement.textContent = "Name: " + review.name;

                const messageElement = document.createElement('p');
                messageElement.textContent = "Message: " + review.message;

                const timeElement = document.createElement('span');
                const date = new Date(review.timedate);
                const formatted = date.toLocaleDateString('es-ES') + ' ' + date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
                timeElement.textContent = "Date time: " + formatted;

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