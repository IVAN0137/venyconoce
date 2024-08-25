document.getElementById('login-form').addEventListener('submit', function(event) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    // Basic client-side validation
    if (username.trim() === '' || password.trim() === '') {
        alert('Please fill in both fields.');
        event.preventDefault(); // Prevent form submission
    }
});
