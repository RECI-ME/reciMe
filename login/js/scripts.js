document.getElementById('switch-to-signup').addEventListener('click', function() {

    document.getElementById('signup-form').classList.remove('hidden');
    document.getElementById('login-form').classList.add('hidden');
    
    document.getElementById('welcome-text').textContent = "Create Your ReciMe Account!";
});

document.getElementById('switch-to-login').addEventListener('click', function() {
    document.getElementById('signup-form').classList.add('hidden');
    document.getElementById('login-form').classList.remove('hidden');
    
    document.getElementById('welcome-text').textContent = "Welcome Back to ReciMe!";
});

document.getElementById('toggle-password').addEventListener('click', function() {
    togglePasswordVisibility('password-login', this);
});

document.getElementById('toggle-password-signup').addEventListener('click', function() {
    togglePasswordVisibility('password-signup', this);
});

document.getElementById('toggle-confirm-password-signup').addEventListener('click', function() {
    togglePasswordVisibility('confirm-password-signup', this);
});

function togglePasswordVisibility(passwordFieldId, iconElement) {
    var passwordField = document.getElementById(passwordFieldId);

    if (passwordField.type === "password") {
        passwordField.type = "text";
        iconElement.classList.remove('closed-eye');
        iconElement.classList.add('open-eye');
    } else {
        passwordField.type = "password";
        iconElement.classList.remove('open-eye');
        iconElement.classList.add('closed-eye');
    }
}
