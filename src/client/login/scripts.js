function showErrorMessage(formType, message) {
    var errorElement = document.getElementById(formType + '-error-message');
    errorElement.textContent = message;
    errorElement.classList.remove('hidden');
    errorElement.style.color = '#db4a2b'; 
    errorElement.style.animation = 'fadeIn 0.5s'; 
}

function clearErrorMessage(formType) {
    var errorElement = document.getElementById(formType + '-error-message');
    errorElement.textContent = '';
    errorElement.classList.add('hidden');
}

document.getElementById('login-form-element').addEventListener('submit', function(event) {
    event.preventDefault();
    clearErrorMessage('login');

    var formData = new FormData(this);

    if (!formData.get('username') || !formData.get('password')) {
        showErrorMessage('login', 'Please fill in all fields.');
        return;
    }

    fetch('../login/backend/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            showErrorMessage('login', data.error);
        } else {
            window.location.href = 'home.php';
        }
    })
    .catch(() => {
        showErrorMessage('login', 'An error occurred. Please try again.');
    });
});

document.getElementById('signup-form-element').addEventListener('submit', function(event) {
    event.preventDefault();
    clearErrorMessage('signup');

    var formData = new FormData(this);

    if (!formData.get('email') || !formData.get('username') || !formData.get('password') || !formData.get('confirm_password')) {
        showErrorMessage('signup', 'Please fill in all fields.');
        return;
    }

    if (formData.get('password') !== formData.get('confirm_password')) {
        showErrorMessage('signup', 'Passwords do not match.');
        return;
    }

    fetch('../login/backend/signup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            showErrorMessage('signup', data.error);
        } else {
            window.location.href = 'home.php';
        }
    })
    .catch(() => {
        showErrorMessage('signup', 'An error occurred. Please try again.');
    });
});

document.getElementById('switch-to-signup').addEventListener('click', function() {
    document.getElementById('signup-form').classList.remove('hidden');
    document.getElementById('login-form').classList.add('hidden');
    document.getElementById('forgot-password-form').classList.add('hidden');
    document.getElementById('welcome-text').textContent = "Create Your ReciMe Account!";
});

document.getElementById('switch-to-login').addEventListener('click', function() {
    document.getElementById('signup-form').classList.add('hidden');
    document.getElementById('login-form').classList.remove('hidden');
    document.getElementById('forgot-password-form').classList.add('hidden');
    document.getElementById('welcome-text').textContent = "Welcome Back to ReciMe!";
});

document.getElementById('forgot-password-link').addEventListener('click', function() {
    document.getElementById('signup-form').classList.add('hidden');
    document.getElementById('login-form').classList.add('hidden');
    document.getElementById('forgot-password-form').classList.remove('hidden');
    document.getElementById('welcome-text').textContent = "Reset Your Password";
});

document.getElementById('back-to-login').addEventListener('click', function() {
    document.getElementById('signup-form').classList.add('hidden');
    document.getElementById('login-form').classList.remove('hidden');
    document.getElementById('forgot-password-form').classList.add('hidden');
    document.getElementById('welcome-text').textContent = "Welcome Back to ReciMe!";
});

document.getElementById('toggle-password').addEventListener('click', function() {
    var passwordField = document.getElementById('password-login');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        this.classList.remove('closed-eye');
        this.classList.add('open-eye');
    } else {
        passwordField.type = 'password';
        this.classList.remove('open-eye');
        this.classList.add('closed-eye');
    }
});

document.getElementById('toggle-password-signup').addEventListener('click', function() {
    var passwordField = document.getElementById('password-signup');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        this.classList.remove('closed-eye');
        this.classList.add('open-eye');
    } else {
        passwordField.type = 'password';
        this.classList.remove('open-eye');
        this.classList.add('closed-eye');
    }
});

document.getElementById('toggle-confirm-password-signup').addEventListener('click', function() {
    var passwordField = document.getElementById('confirm-password-signup');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        this.classList.remove('closed-eye');
        this.classList.add('open-eye');
    } else {
        passwordField.type = 'password';
        this.classList.remove('open-eye');
        this.classList.add('closed-eye');
    }
});
