// Intersection Observer for fade-in animations
const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            }
        });
    },
    {
        threshold: 0.1,
    }
);

document.querySelectorAll(".fade-in").forEach((el) => observer.observe(el));

// Navbar scroll effect
const navbar = document.querySelector(".gh-navbar");
let lastScrollTop = 0;

function updateNavbar() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > 40) {
        navbar.classList.remove("gh-initial");
        navbar.classList.add("gh-scrolled");
    } else {
        navbar.classList.add("gh-initial");
        navbar.classList.remove("gh-scrolled");
    }

    lastScrollTop = scrollTop;
}

// Initial state
navbar.classList.add("gh-initial");
updateNavbar();
window.addEventListener("scroll", updateNavbar);

// Shopping cart functionality
const cartButtons = document.querySelectorAll(".btn-cart, .btn-primary");
cartButtons.forEach((button) => {
    button.addEventListener("click", function () {
        // Cart functionality here
    });
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
            });
        }
    });
});

// Promo banner slider
let currentPromo = 0;
const promoItems = document.querySelectorAll(".promo-item");

function showNextPromo() {
    promoItems[currentPromo].classList.remove("active");
    currentPromo = (currentPromo + 1) % promoItems.length;
    promoItems[currentPromo].classList.add("active");
}

// Initial state
promoItems[0].classList.add("active");
setInterval(showNextPromo, 3000);

// Close mobile menu when clicking outside
document.addEventListener("click", function (e) {
    const navbar = document.querySelector(".gh-navbar");
    const navbarToggler = navbar.querySelector(".navbar-toggler");
    const navbarCollapse = navbar.querySelector(".navbar-collapse");

    if (
        !navbar.contains(e.target) &&
        window.getComputedStyle(navbarToggler).display !== "none"
    ) {
        navbarCollapse.classList.remove("show");
    }
});

// Close mobile menu when clicking nav links
document.querySelectorAll(".gh-nav-link").forEach((link) => {
    link.addEventListener("click", () => {
        const navbarCollapse = document.querySelector(".navbar-collapse");
        if (navbarCollapse.classList.contains("show")) {
            navbarCollapse.classList.remove("show");
        }
    });
});

// Animation cho số đếm
window.onload = function () {
    // Animation cho số đếm
    function animateCount() {
        const counters = document.querySelectorAll('.stat-number');

        counters.forEach(counter => {
            const target = parseFloat(counter.getAttribute('data-count'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target + (target === 99.5 ? '%' : target === 50000 ? '+' : '');
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current) + (target === 99.5 ? '%' : target === 50000 ? '+' : '');
                }
            }, 16);
        });
    }

    // Intersection Observer để trigger animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCount();
                observer.unobserve(entry.target);
            }
        });
    });

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        observer.observe(statsSection);
    }
};