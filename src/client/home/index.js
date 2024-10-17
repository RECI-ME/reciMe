let dom_objs = {};

window.onload = function() {
    dom_objs.banner_profile = document.querySelector("div#banner div#profile");
    dom_objs.dashboard_blanket = document.querySelector("div#dashboard_blanket");
    dom_objs.dashboard = document.querySelector("div#dashboard");

    // Toggle dashboard menu visibility
    dom_objs.banner_profile.addEventListener("click", function() {
        dom_objs.dashboard.classList.toggle("hide");
        dom_objs.dashboard_blanket.classList.toggle("hide");
    });

    dom_objs.dashboard_blanket.addEventListener("click", function() {
        dom_objs.dashboard.classList.toggle("hide");
        dom_objs.dashboard_blanket.classList.toggle("hide");
    });

    // Add event listeners to review buttons
    const reviewButtons = document.querySelectorAll('.review-button');
    reviewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const recipeId = this.getAttribute('data-recipe-id');
            fetchReviews(recipeId);
        });
    });
};

// Function to fetch reviews dynamically
function fetchReviews(recipeId) {
    fetch(`reviews.php?recipe_id=${recipeId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }
            const reviewsContainer = document.getElementById('reviews-container');
            reviewsContainer.innerHTML = ''; // Clear previous reviews
            if (data.reviews && data.reviews.length > 0) {
                data.reviews.forEach(review => {
                    reviewsContainer.innerHTML += `<p><strong>${review.username}</strong>: ${review.review_text}</p>`;
                });
            } else {
                reviewsContainer.innerHTML = '<p>No reviews for this recipe.</p>';
            }
            // Show the modal
            const modal = document.getElementById('reviewModal');
            modal.classList.remove('hide');
            modal.classList.add('show');
        })
        .catch(error => {
            console.error('Error fetching reviews:', error);
            alert('Could not fetch reviews: ' + error.message);
        });
}

// Function to close the review modal 
// function closeModal() {
//     const modal = document.getElementById('reviewModal');
//     modal.classList.remove('show');
//     modal.classList.add('hide');
// }

// // Function to delete a recipe
// function deleteRecipe(recipeId) {
//     if (confirm('Are you sure you want to delete this recipe?')) {
//         fetch('delete.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded',
//             },
//             body: `recipe_id=${recipeId}`
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 alert('Recipe deleted successfully');
//                 window.location.reload(); // Reload the page to reflect changes
//             } else {
//                 alert('Error deleting recipe');
//             }
//         })
//         .catch(error => {
//             console.error('Error deleting recipe:', error);
//             alert('Could not delete the recipe. Please try again later.');
//         });
//     }
// }
