document.getElementById('loginForm').addEventListener('submit', function(event) {
    const emailOrContact = document.getElementById('nameOrContact').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('login-error-message');

    errorMessage.textContent = '';

    const savedEmail = localStorage.getItem('userEmail');
    const savedContact = localStorage.getItem('userContact');
    const savedPassword = localStorage.getItem('userPassword');

    /*if ((emailOrContact === savedEmail || emailOrContact === savedContact) && password === savedPassword) {
        alert('Login successful! Redirecting to the homepage.');
        window.location.href = 'homepage.html';
    } else {
        event.preventDefault();
        errorMessage.textContent = 'Invalid Username/contact number or password.';
    }*/
});