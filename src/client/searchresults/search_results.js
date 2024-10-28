document.addEventListener("DOMContentLoaded", function() {
    const profile = document.getElementById("profile");
    const dashboard = document.getElementById("dashboard");
    const dashboardBlanket = document.getElementById("dashboard_blanket");
    const filterRating = document.getElementById('filter-rating');
    const forkEmojiDisplay = document.getElementById('fork-emoji-display');
    const searchToggle = document.getElementById("search_toggle");
    const searchArea = document.getElementById("search_area");
    const searchInput = document.getElementById("search_input");
    const ratingCheckbox = document.getElementById('rating-checkbox'); // New checkbox element

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

    // Set initial fork emojis on page load
    const initialRating = Math.round(filterRating.value);
    forkEmojiDisplay.textContent = '🍴'.repeat(initialRating);

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
            const rating = filterRating.value; // Get the value of the slider
            const includeRating = ratingCheckbox.checked; // Check if the rating filter is active
            if (query) {
                // Redirect to search results page with query and rating as URL parameters
                const url = `../searchresults/search_results.html?query=${encodeURIComponent(query)}`;
                window.location.href = includeRating ? `${url}&rating=${rating}` : url; // Append rating if checkbox is checked
            }
        }
    });

    // Slider input event for rating
    filterRating.addEventListener('input', function() {
        // Update background gradient for slider
        const value = this.value; // Current value of the slider
        const max = this.max; // Maximum value of the slider
        const percentage = (value / max) * 100; // Calculate the percentage for the background fill

        // Adjust background gradient
        this.style.background = `linear-gradient(to right, #FFD700 0%, #FFD700 ${percentage}%, #ffffff ${percentage}%, #ffffff 100%)`;

        // Update fork emoji display based on the slider value
        const rating = Math.round(value); // Get the current slider value (rounded)
        const forks = '🍴'.repeat(rating); // Generate fork emojis based on rating value
        forkEmojiDisplay.textContent = forks; // Display fork emojis
    });
});
