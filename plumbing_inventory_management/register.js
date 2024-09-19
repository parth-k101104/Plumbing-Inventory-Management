document.getElementById('registerForm').addEventListener('submit', function(event) {
    const email = document.getElementById('email').value;
    const contact = document.getElementById('contact').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const errorMessage = document.getElementById('register-error-message');

    
    errorMessage.textContent = '';

    if (!email || !contact || !password || !confirmPassword) {
        event.preventDefault();
        errorMessage.textContent = 'All fields are required.';
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        event.preventDefault();
        errorMessage.textContent = 'Please enter a valid email address.';
        return;
    }

    const contactRegex = /^\d{10}$/;
    if (!contactRegex.test(contact)) {
        event.preventDefault();
        errorMessage.textContent = 'Please enter a valid 10-digit contact number.';
        return;
    }

    if (password !== confirmPassword) {
        event.preventDefault();
        errorMessage.textContent = 'Passwords do not match.';
        return;
    }

    localStorage.setItem('userEmail', email);
    localStorage.setItem('userContact', contact);
    localStorage.setItem('userPassword', password);

    alert('Registration successful! Redirecting to login page.');
    window.location.href = 'login.html';
});