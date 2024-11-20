document.addEventListener("DOMContentLoaded", function () {
    // Get the elements
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
    profile.addEventListener("click", function () {
        const isHidden = dashboard.classList.contains("hide");
        dashboard.classList.toggle("hide", !isHidden);
        dashboardBlanket.classList.toggle("hide", !isHidden);
    });

    // Close the dashboard if the user clicks outside of it
    dashboardBlanket.addEventListener("click", function () {
        dashboard.classList.add("hide");
        dashboardBlanket.classList.add("hide");
    });

    // Set initial fork emojis on page load
    const initialRating = Math.round(filterRating.value);
    forkEmojiDisplay.textContent = '🍴'.repeat(initialRating);

    // Add event listener for search toggle
    searchToggle.addEventListener("click", function (event) {
        searchToggle.classList.toggle("active");
        event.stopPropagation(); // Prevent click from propagating
    });

    // Prevent closing when clicking inside the search area
    searchArea.addEventListener("click", function (event) {
        event.stopPropagation(); // Stop the click from closing the search area
    });

    // Close the search area when clicking outside
    document.addEventListener("click", function () {
        if (searchToggle.classList.contains("active")) {
            searchToggle.classList.remove("active");
        }
    });

    // Redirect to search results page on pressing Enter
    searchInput.addEventListener("keydown", function (event) {
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
    filterRating.addEventListener('input', function () {
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

    // Get query parameters from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const query = urlParams.get('query') || '';
    const rating = urlParams.get('rating') || 1;
    const category = urlParams.get('category') || '';

    // Set the initial values for the search bar, category, and rating filter
    document.getElementById('search-bar').value = query;
    document.getElementById('filter-rating').value = rating;
    document.getElementById('filter-category').value = category;
    
    // Display the correct number of fork emojis based on the rating
    document.getElementById('fork-emoji-display').textContent = '🍴'.repeat(rating);
    document.getElementById('filter-rating').style.background = 'linear-gradient(to right, #f39c12 0%, #f39c12 ' + (rating * 20) + '%, #ecf0f1 ' + (rating * 20) + '%, #ecf0f1 100%)';

    // Simulate a search result set based on parameters
    const resultsContainer = document.getElementById('results-container');

    // Example of a mock result set
    const mockResults = [
        { name: 'Pizza', category: 'Italian', rating: 5 },
        { name: 'Sushi', category: 'Japanese', rating: 4 },
        { name: 'Burger', category: 'American', rating: 3 },
        { name: 'Pasta', category: 'Italian', rating: 5 },
        { name: 'Ramen', category: 'Japanese', rating: 4 },
    ];

    // Filter results based on query, rating, and category
    const filteredResults = mockResults.filter(result => {
        const matchesQuery = result.name.toLowerCase().includes(query.toLowerCase());
        const matchesRating = result.rating >= rating;
        const matchesCategory = category ? result.category === category : true;
        return matchesQuery && matchesRating && matchesCategory;
    });

    // Render filtered results
    filteredResults.forEach(result => {
        const resultElement = document.createElement('div');
        resultElement.classList.add('result-item');
        resultElement.innerHTML = `<strong>${result.name}</strong> - ${result.category} - Rating: ${'🍴'.repeat(result.rating)}`;
        resultsContainer.appendChild(resultElement);
    });

    // Handle the search form submission without page reload
    document.getElementById('apply-filters').addEventListener('click', function () {
        const newQuery = document.getElementById('search-bar').value;
        const newCategory = document.getElementById('filter-category').value;
        const newRating = document.getElementById('filter-rating').value;

        // Redirect to the new URL with updated parameters
        window.location.href = `search_results.php?query=${encodeURIComponent(newQuery)}&rating=${encodeURIComponent(newRating)}&category=${encodeURIComponent(newCategory)}`;
    });

});
