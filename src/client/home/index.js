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
