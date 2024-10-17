document.addEventListener('DOMContentLoaded', function() {
    const userIcon = document.getElementById('user-icon');
    const dashboardMenu = document.getElementById('dashboard-menu');
    const overlay = document.getElementById('overlay');

    userIcon.addEventListener('click', function() {
        // Toggle dashboard menu visibility
        dashboardMenu.classList.toggle('hidden');
        overlay.classList.toggle('hidden'); // Show overlay
    });

    overlay.addEventListener('click', function() {
        // Hide menu and overlay when clicking outside
        dashboardMenu.classList.add('hidden');
        overlay.classList.add('hidden');
    });

    // Function to update the fork emoji display based on the slider value
    const filterRating = document.getElementById('filter-rating');
    const forkEmojiDisplay = document.getElementById('fork-emoji-display');

    filterRating.addEventListener('input', function() {
        const rating = Math.round(filterRating.value); // Round to nearest whole number
        const forks = '🍴'.repeat(rating); // Generate fork emojis
        forkEmojiDisplay.textContent = forks; // Display fork emojis
    });
});
