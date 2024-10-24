let dom_objs = {};
let isLoggedIn = false; 
window.onload = function() {
    dom_objs.banner_profile = document.querySelector("div#banner div#profile");
    dom_objs.dashboard_blanket = document.querySelector("div#dashboard_blanket");
    dom_objs.dashboard = document.querySelector("div#dashboard");
    dom_objs.loginButton = document.querySelector("#loginButton");

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
