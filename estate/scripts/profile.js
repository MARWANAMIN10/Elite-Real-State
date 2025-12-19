document.addEventListener('DOMContentLoaded', function () {
    const username = localStorage.getItem('username');
    const email = localStorage.getItem('email');
    const phone = localStorage.getItem('phone');

    if (username) {
        document.getElementById('profile-username').innerHTML =
            `<strong>Username:</strong> ${username}`;
    }

    if (email) {
        document.getElementById('profile-email').innerHTML =
            `<strong>Email:</strong> ${email}`;
    }

    if (phone) {
        document.getElementById('profile-phone').innerHTML =
            `<strong>Phone:</strong> ${phone}`;
    }    
});
