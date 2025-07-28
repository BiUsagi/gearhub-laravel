/* ===== ADMIN DASHBOARD JAVASCRIPT ===== */

// Biến toàn cục
let themeToggle, html, themeIcon;
let sidebarToggle, sidebar, mainContent;

// Khởi tạo khi DOM đã sẵn sàng
document.addEventListener("DOMContentLoaded", function () {
    // Theme Toggle
    initThemeToggle();

    // Sidebar Toggle
    initSidebarToggle();

    // Search Functionality
    initSearchFunctionality();

    // Animations
    initAnimations();

    // Navigation
    initNavigation();

    // Sidebar Search
    initSidebarSearch();

    // Dropdowns
    initDropdowns();

    // Notification Badge Animation
    initNotificationBadge();

    // Counter Animations
    initCounterAnimations();

    // Menu Theme Icon
    updateMenuThemeIcon(localStorage.getItem("theme") || "dark");
});

// ===== THEME TOGGLE - CHUYỂN ĐỔI THEME =====

// Chuyển đổi theme
function initThemeToggle() {
    themeToggle = document.getElementById("themeToggle");
    html = document.documentElement;
    themeIcon = themeToggle.querySelector("i");

    // Tải theme đã lưu
    const savedTheme = localStorage.getItem("theme") || "dark";
    html.setAttribute("data-bs-theme", savedTheme);
    updateThemeIcon(savedTheme);

    // Click theme toggle
    themeToggle.addEventListener("click", () => {
        const currentTheme = html.getAttribute("data-bs-theme");
        const newTheme = currentTheme === "dark" ? "light" : "dark";

        html.setAttribute("data-bs-theme", newTheme);
        localStorage.setItem("theme", newTheme);
        updateThemeIcon(newTheme);
        updateMenuThemeIcon(newTheme);
    });
}

// Cập nhật icon theme
function updateThemeIcon(theme) {
    if (theme === "dark") {
        themeIcon.className = "bi bi-sun-fill";
    } else {
        themeIcon.className = "bi bi-moon-fill";
    }
}

// Cập nhật icon theme trong menu người dùng
function updateMenuThemeIcon(theme) {
    const menuThemeToggle = document.getElementById("themeToggleMenu");
    if (menuThemeToggle) {
        const menuIcon = menuThemeToggle.querySelector("i");
        const menuText = menuThemeToggle.querySelector("span");
        if (theme === "dark") {
            menuIcon.className = "bi bi-sun";
            menuText.textContent = "Chế độ sáng";
        } else {
            menuIcon.className = "bi bi-moon";
            menuText.textContent = "Chế độ tối";
        }
    }
}

// ===== SIDEBAR TOGGLE - CHUYỂN ĐỔI SIDEBAR =====

// Chức năng toggle sidebar
function initSidebarToggle() {
    sidebarToggle = document.getElementById("sidebarToggle");
    sidebar = document.getElementById("sidebar");
    mainContent = document.getElementById("main-content");

    // Click toggle sidebar
    sidebarToggle.addEventListener("click", () => {
        if (window.innerWidth <= 768) {
            // Mobile: Show/hide sidebar
            sidebar.classList.toggle("show");
        } else {
            // Desktop: Collapse/expand sidebar
            sidebar.classList.toggle("collapsed");
            mainContent.classList.toggle("expanded");
        }
    });

    // Đóng sidebar khi click bên ngoài trên mobile
    document.addEventListener("click", (e) => {
        if (window.innerWidth <= 768) {
            if (
                !sidebar.contains(e.target) &&
                !sidebarToggle.contains(e.target)
            ) {
                sidebar.classList.remove("show");
            }
        }
    });

    // Xử lý responsive khi thay đổi kích thước màn hình
    window.addEventListener("resize", () => {
        if (window.innerWidth > 768) {
            sidebar.classList.remove("show");
        } else {
            sidebar.classList.remove("collapsed");
            mainContent.classList.remove("expanded");
        }
    });
}

// ===== SEARCH FUNCTIONALITY - CHỨC NĂNG TÌM KIẾM =====

// Khởi tạo chức năng tìm kiếm
function initSearchFunctionality() {
    const searchInput = document.querySelector(".search-input");

    if (searchInput) {
        // Hiệu ứng focus search box
        searchInput.addEventListener("focus", () => {
            searchInput.parentElement.style.transform = "scale(1.02)";
        });

        // Hiệu ứng blur search box
        searchInput.addEventListener("blur", () => {
            searchInput.parentElement.style.transform = "scale(1)";
        });
    }
}

// ===== ANIMATIONS =====

// Animations cho các thành phần
function initAnimations() {
    // Cấu hình Intersection Observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    // Observer cho fade-in-up animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }, index * 100);
            }
        });
    }, observerOptions);

    // Áp dụng animation cho tất cả phần tử fade-in-up
    document.querySelectorAll(".fade-in-up").forEach((el, index) => {
        el.style.opacity = "0";
        el.style.transform = "translateY(30px)";
        el.style.transition = "all 0.6s ease";
        setTimeout(() => observer.observe(el), index * 50);
    });
}

// ===== NAVIGATION =====

// Khởi tạo hệ thống điều hướng
function initNavigation() {
    // Xử lý các link điều hướng chính
    document.querySelectorAll(".nav-link").forEach((link) => {
        link.addEventListener("click", (e) => {
            // Chỉ preventDefault cho các link có submenu
            if (link.classList.contains("has-submenu")) {
                e.preventDefault();

                const submenuId = link.getAttribute("data-submenu");
                const submenu = document.getElementById(submenuId);

                if (submenu.classList.contains("expanded")) {
                    // Đóng submenu
                    submenu.classList.remove("expanded");
                    link.classList.remove("expanded");
                } else {
                    // Đóng tất cả submenu khác
                    document
                        .querySelectorAll(".submenu.expanded")
                        .forEach((openSubmenu) => {
                            openSubmenu.classList.remove("expanded");
                        });
                    document
                        .querySelectorAll(".nav-link.expanded")
                        .forEach((expandedLink) => {
                            expandedLink.classList.remove("expanded");
                        });

                    // Mở submenu hiện tại
                    submenu.classList.add("expanded");
                    link.classList.add("expanded");
                }
            } else {
                // Cho phép navigation bình thường cho các link không có submenu
                // Chỉ cần xử lý active state
                document
                    .querySelectorAll(".nav-link")
                    .forEach((l) => l.classList.remove("active"));
                link.classList.add("active");
                // Không preventDefault - cho phép link hoạt động bình thường
            }
        });
    });

    // Xử lý các mục submenu
    document.querySelectorAll(".submenu .nav-link").forEach((link) => {
        link.addEventListener("click", (e) => {
            // Chỉ preventDefault nếu link là "#" hoặc không có href thực
            if (
                link.getAttribute("href") === "#" ||
                !link.getAttribute("href")
            ) {
                e.preventDefault();
            }
            e.stopPropagation();

            // Xóa active class khỏi tất cả submenu links
            document
                .querySelectorAll(".submenu .nav-link")
                .forEach((l) => l.classList.remove("active"));

            // Thêm active class cho link được click
            link.classList.add("active");
        });
    });
}

// ===== SIDEBAR SEARCH - TÌM KIẾM SIDEBAR =====

// Khởi tạo chức năng tìm kiếm trong sidebar
function initSidebarSearch() {
    const searchInput = document.querySelector(".sidebar-search-input");
    const navItems = document.querySelectorAll(".nav-item");
    const navSections = document.querySelectorAll(".nav-section");

    if (searchInput) {
        searchInput.addEventListener("input", (e) => {
            const searchTerm = e.target.value.toLowerCase().trim();

            if (searchTerm === "") {
                // Hiển thị tất cả mục
                navItems.forEach((item) => {
                    item.style.display = "";
                });
                navSections.forEach((section) => {
                    section.style.display = "";
                });
            } else {
                // Lọc các mục
                navSections.forEach((section) => {
                    let hasVisibleItems = false;
                    const items = section.querySelectorAll(".nav-item");

                    items.forEach((item) => {
                        const text = item.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            item.style.display = "";
                            hasVisibleItems = true;
                        } else {
                            item.style.display = "none";
                        }
                    });

                    // Hiển thị/ẩn section dựa vào có mục nào hiển thị không
                    section.style.display = hasVisibleItems ? "" : "none";
                });
            }
        });
    }
}

// ===== DROPDOWNS =====

// Khởi tạo chức năng dropdown
function initDropdowns() {
    // Lấy các phần tử dropdown
    const notificationBtn = document.getElementById("notificationBtn");
    const notificationDropdown = document.getElementById(
        "notificationDropdown"
    );
    const userProfileBtn = document.getElementById("userProfileBtn");
    const userDropdown = document.getElementById("userDropdown");

    // Thiết lập dropdown thông báo
    if (notificationBtn && notificationDropdown) {
        const notificationContainer = notificationDropdown.parentElement;

        notificationBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            // Đóng user dropdown
            if (userDropdown) {
                userDropdown.parentElement.classList.remove("show");
            }

            // Toggle notification dropdown
            notificationContainer.classList.toggle("show");
        });

        // Xử lý click trên dropdown items
        notificationDropdown.addEventListener("click", function (e) {
            e.stopPropagation();
        });

        // Xử lý click trên notification items
        const notificationItems =
            notificationDropdown.querySelectorAll(".dropdown-item");
        notificationItems.forEach((item) => {
            item.addEventListener("click", function () {
                setTimeout(() => {
                    notificationContainer.classList.remove("show");
                }, 100);
            });
        });
    }

    // Thiết lập dropdown người dùng
    if (userProfileBtn && userDropdown) {
        const userContainer = userDropdown.parentElement;

        userProfileBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            // Đóng notification dropdown
            if (notificationDropdown) {
                notificationDropdown.parentElement.classList.remove("show");
            }

            // Toggle user dropdown
            userContainer.classList.toggle("show");
        });

        // Xử lý click trên dropdown items
        userDropdown.addEventListener("click", function (e) {
            e.stopPropagation();
        });

        // Xử lý các mục trong user dropdown
        const userItems = userDropdown.querySelectorAll(".dropdown-item");
        userItems.forEach((item) => {
            item.addEventListener("click", function (e) {
                // Xử lý đăng xuất
                if (item.classList.contains("logout-item")) {
                    alert("Đăng xuất...");
                }
                // Xử lý chuyển đổi theme
                else if (item.classList.contains("theme-toggle-menu")) {
                    e.preventDefault();
                    const currentTheme = html.getAttribute("data-bs-theme");
                    const newTheme = currentTheme === "dark" ? "light" : "dark";
                    html.setAttribute("data-bs-theme", newTheme);
                    localStorage.setItem("theme", newTheme);
                    updateThemeIcon(newTheme);
                    updateMenuThemeIcon(newTheme);
                }

                setTimeout(() => {
                    userContainer.classList.remove("show");
                }, 100);
            });
        });
    }

    // Đóng dropdowns khi click bên ngoài
    document.addEventListener("click", function () {
        if (notificationDropdown) {
            notificationDropdown.parentElement.classList.remove("show");
        }
        if (userDropdown) {
            userDropdown.parentElement.classList.remove("show");
        }
    });
}

// ===== NOTIFICATION BADGE - HUY HIỆU THÔNG BÁO =====

// Khởi tạo animation cho notification badge
function initNotificationBadge() {
    const notificationBadge = document.querySelector(".notification-badge");

    if (notificationBadge) {
        // Tạo animation pulse
        setInterval(() => {
            notificationBadge.style.animation = "none";
            setTimeout(() => {
                notificationBadge.style.animation = "pulse 2s infinite";
            }, 10);
        }, 3000);

        // Thêm CSS animation pulse
        const style = document.createElement("style");
        style.textContent = `
            @keyframes pulse {
                0% { transform: scale(1); opacity: 1; }
                50% { transform: scale(1.2); opacity: 0.7; }
                100% { transform: scale(1); opacity: 1; }
            }
        `;
        document.head.appendChild(style);
    }
}

// ===== COUNTER ANIMATIONS - HIỆU ỨNG ĐẾM SỐ =====

// Khởi tạo animation đếm số cho stats
function initCounterAnimations() {
    const statValues = document.querySelectorAll(".stat-value");

    // Observer cho counter animation
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const text = entry.target.textContent;
                const number = parseInt(text.replace(/[^\d]/g, ""));
                if (number) {
                    entry.target.textContent = "0";
                    animateCounter(entry.target, number);
                    statObserver.unobserve(entry.target);
                }
            }
        });
    });

    statValues.forEach((value) => statObserver.observe(value));
}

// Animation đếm số
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);

    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = formatNumber(target);
            clearInterval(timer);
        } else {
            element.textContent = formatNumber(Math.floor(start));
        }
    }, 16);
}

// Format số hiển thị
function formatNumber(num) {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + "M";
    } else if (num >= 1000) {
        return (num / 1000).toFixed(1) + "k";
    }
    return num.toString();
}
