// Properties Page Scripts

document.addEventListener('DOMContentLoaded', function() {

    // Display username if needed
    const username = localStorage.getItem('username');
    if (username) {
        // Optional: Display username somewhere on the page
        const userElement = document.querySelector('#user-display');
        if (userElement) {
            userElement.textContent = `Welcome, ${username}`;
        }
    }

    // Add scroll animations for properties
    function revealProperties() {
        const properties = document.querySelectorAll(".property");
        
        properties.forEach((property, index) => {
            const windowHeight = window.innerHeight;
            const elementTop = property.getBoundingClientRect().top;
            
            if (elementTop < windowHeight - 50) {
                setTimeout(() => {
                    property.classList.add("show");
                }, index * 200);
            }
        });
    }

    // Initial reveal - wait a bit longer for page to fully load
    setTimeout(revealProperties, 300);

    // Add scroll event listener with debouncing
    let scrollTimeout;
    window.addEventListener("scroll", function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(revealProperties, 50);
    });

    // Handle logout - wait for element to exist
    function setupLogout() {
        const logoutBtn = document.getElementById('nav-logout');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                localStorage.removeItem('isLoggedIn');
                localStorage.removeItem('username');
                localStorage.removeItem('email');
            });
        } else {
            // Retry after a short delay if element doesn't exist yet
            setTimeout(setupLogout, 100);
        }
    }
    
    setupLogout();

    // ADD CSS FOR ANIMATIONS
    const style = document.createElement('style');
    style.textContent = `
        .property {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .property.show {
            opacity: 1;
            transform: translateY(0);
        }
    `;
    document.head.appendChild(style);
});