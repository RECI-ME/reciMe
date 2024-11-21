let dom_objs = {};
let isLoggedIn = false; 
window.onload = function() {
    dom_objs.banner_profile = document.querySelector("div#banner div#profile");
    dom_objs.dashboard_blanket = document.querySelector("div#dashboard_blanket");
    dom_objs.dashboard = document.querySelector("div#dashboard");
    dom_objs.loginButton = document.querySelector("#loginButton");

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
    fetch(`../../../server/reviews.php?recipe_id=${recipeId}`)
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

    dom_objs.banner_profile.addEventListener("click", toggleDashboard);
    dom_objs.dashboard_blanket.addEventListener("click", toggleDashboard);

    dom_objs.loginButton.addEventListener("mouseover", () => animateButton(true));
    dom_objs.loginButton.addEventListener("mouseout", () => animateButton(false));

    const likeButtons = document.querySelectorAll('.reactions button');
    likeButtons.forEach((button) => {
        const likeImage = button.querySelector('img');
        if (likeImage.alt === "Like Icon") {
            const defaultLikeImage = '../../../assets/like_icon.png';
            const activeLikeImage = '../../../assets/liked.png';

            button.addEventListener('click', () => {
                if (likeImage.src.includes('like_icon.png')) {
                    likeImage.src = activeLikeImage;
                } else {
                    likeImage.src = defaultLikeImage;
                }
            });
        }
    });

    checkLoginStatus();

    const cookiesAccepted = localStorage.getItem("cookiesAccepted");
    if (isLoggedIn && !cookiesAccepted) {
        document.getElementById("cookieConsent").style.display = "block";
    }

    document.getElementById("acceptCookies").addEventListener("click", function() {
        localStorage.setItem("cookiesAccepted", "true");
        document.getElementById("cookieConsent").style.display = "none";
    });
  
      const profile = document.getElementById("profile");
    const dashboard = document.getElementById("dashboard");
    const dashboardBlanket = document.getElementById("dashboard_blanket");

    // Toggle dashboard visibility
    profile.addEventListener("click", function() {
        const isHidden = dashboard.classList.contains("hide");
        dashboard.classList.toggle("hide", !isHidden);
        dashboardBlanket.classList.toggle("hide", !isHidden);
    });

    // Close the dashboard if the user clicks outside of it
    dashboardBlanket.addEventListener("click", function() {
        dashboard.classList.add("hide");
        dashboardBlanket.classList.add("hide");
    });

    // Handle the search toggle
    const searchToggle = document.getElementById("search_toggle");
    const searchArea = document.getElementById("search_area");
    const searchInput = document.getElementById("search_input");

    // Add event listener for search toggle
    searchToggle.addEventListener("click", function(event) {
        searchToggle.classList.toggle("active");
        event.stopPropagation(); // Prevent click from propagating
    });

    // Prevent closing when clicking inside the search area
    searchArea.addEventListener("click", function(event) {
        event.stopPropagation(); // Stop the click from closing the search area
    });

    // Close the search area when clicking outside
    document.addEventListener("click", function() {
        if (searchToggle.classList.contains("active")) {
            searchToggle.classList.remove("active");
        }
    });

    // Redirect to search results page on pressing Enter
    searchInput.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent default action
            const query = searchInput.value.trim();
            if (query) {
                // Redirect to search results page with query as a URL parameter
                window.location.href = `../searchresults/search_results.html?query=${encodeURIComponent(query)}`;
            }
        }
    });
}

function checkLoginStatus() {
    
    if (document.cookie.includes("username")) {
        isLoggedIn = true; 
    }
}

function toggleDashboard() {
    dom_objs.dashboard.classList.toggle("hide");
    dom_objs.dashboard_blanket.classList.toggle("hide");
}

function animateButton(isHovering) {
    if (isHovering) {
        dom_objs.loginButton.style.transform = "scale(1.1)";
    } else {
        dom_objs.loginButton.style.transform = "scale(1)";
    }

}

// Get the "My Location" button element
const locationButton = document.getElementById("my_location_button");

// Add hover effect (optional)
locationButton.addEventListener("mouseenter", () => {
    locationButton.style.transform = "scale(1.1)";
});

locationButton.addEventListener("mouseleave", () => {
    locationButton.style.transform = "scale(1)";
});

// Add click animation (optional)
locationButton.addEventListener("click", () => {
    // Animation for click (e.g., shrink and grow effect)
    locationButton.style.transform = "scale(0.95)";

    // Reset after animation
    setTimeout(() => {
        locationButton.style.transform = "scale(1)";
    }, 150); // Reset after 150ms
});
