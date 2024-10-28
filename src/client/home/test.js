let dom_objs = {};

window.onload = function() {
    dom_objs.banner_profile = document.querySelector("div#banner div#profile");
    dom_objs.dashboard_blanket = document.querySelector("div#dashboard_blanket");
    dom_objs.dashboard = document.querySelector("div#dashboard");

    dom_objs.banner_profile.addEventListener("click", function() {
        dom_objs.dashboard.classList.toggle("hide");
        dom_objs.dashboard_blanket.classList.toggle("hide");
    })

    dom_objs.dashboard_blanket.addEventListener("click", function() {
        dom_objs.dashboard.classList.toggle("hide");
        dom_objs.dashboard_blanket.classList.toggle("hide");
    })
}

window.onload = function() {
    // Existing onload functionality
    // ...

    // Toggle Search Bar
    dom_objs.search_toggle.addEventListener("click", function() {
        dom_objs.search_area.classList.toggle("hide");
        dom_objs.search_input.focus();
    });

    // Search on Enter Key
    dom_objs.search_input.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            performSearch(dom_objs.search_input.value);
        }
    });
}

// Perform Search Function (Sample Logic)
function performSearch(query) {
    console.log("Searching for: ", query);
    
    // Clear previous results
    dom_objs.search_filters.classList.remove("hide");

    // Add your filtering and result display logic here
}