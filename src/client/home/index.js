document.addEventListener("DOMContentLoaded", function() {
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
});
