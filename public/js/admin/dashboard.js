/**
 * Admin Dashboard JavaScript
 * Modern UI interactions and functionality
 */

class AdminDashboard {
    constructor() {
        this.init();
    }

    init() {
        this.initEventListeners();
        this.initTooltips();
        this.initSearch();
        this.initTheme();
        this.hideLoadingOverlay();
        this.initCharts();
    }

    initEventListeners() {
        // Modern Sidebar functionality
        function initializeSidebar() {
            const sidebar = document.querySelector(".modern-sidebar");
            const collapseBtn = document.querySelector(".collapse-btn");
            const sidebarOverlay = document.querySelector(".sidebar-overlay");
            const mainContent = document.querySelector(".main-content");

            // Collapse/Expand functionality
            if (collapseBtn && sidebar) {
                collapseBtn.addEventListener("click", () => {
                    sidebar.classList.toggle("collapsed");

                    // Update main content margin
                    if (sidebar.classList.contains("collapsed")) {
                        mainContent.style.marginLeft =
                            "var(--sidebar-collapsed-width)";
                    } else {
                        mainContent.style.marginLeft = "var(--sidebar-width)";
                    }

                    // Save state to localStorage
                    localStorage.setItem(
                        "sidebar-collapsed",
                        sidebar.classList.contains("collapsed")
                    );
                });
            }

            // Mobile sidebar toggle
            const mobileToggle = document.querySelector(
                ".mobile-sidebar-toggle"
            );
            if (mobileToggle && sidebar && sidebarOverlay) {
                mobileToggle.addEventListener("click", () => {
                    sidebar.classList.toggle("show");
                    sidebarOverlay.classList.toggle("show");
                    document.body.style.overflow = sidebar.classList.contains(
                        "show"
                    )
                        ? "hidden"
                        : "";
                });

                // Close sidebar when clicking overlay
                sidebarOverlay.addEventListener("click", () => {
                    sidebar.classList.remove("show");
                    sidebarOverlay.classList.remove("show");
                    document.body.style.overflow = "";
                });
            }

            // Restore sidebar state
            const isCollapsed =
                localStorage.getItem("sidebar-collapsed") === "true";
            if (isCollapsed && sidebar) {
                sidebar.classList.add("collapsed");
                if (mainContent) {
                    mainContent.style.marginLeft =
                        "var(--sidebar-collapsed-width)";
                }
            }

            // Submenu functionality
            const hasSubmenuItems = document.querySelectorAll(
                ".has-submenu .nav-link"
            );
            hasSubmenuItems.forEach((item) => {
                item.addEventListener("click", (e) => {
                    e.preventDefault();

                    const navItem = item.closest(".nav-item");
                    const submenu = navItem.querySelector(".submenu");
                    const arrow = item.querySelector(".nav-arrow");

                    if (submenu) {
                        // Close other submenus
                        hasSubmenuItems.forEach((otherItem) => {
                            if (otherItem !== item) {
                                const otherNavItem =
                                    otherItem.closest(".nav-item");
                                const otherSubmenu =
                                    otherNavItem.querySelector(".submenu");
                                const otherArrow =
                                    otherItem.querySelector(".nav-arrow");

                                if (otherSubmenu) {
                                    otherSubmenu.classList.remove("active");
                                    otherArrow.classList.remove("rotated");
                                }
                            }
                        });

                        // Toggle current submenu
                        submenu.classList.toggle("active");
                        arrow.classList.toggle("rotated");
                    }
                });
            });

            // Handle nav link active states
            const navLinks = document.querySelectorAll(
                ".nav-link:not(.has-submenu .nav-link)"
            );
            navLinks.forEach((link) => {
                link.addEventListener("click", (e) => {
                    // Remove active class from all links
                    navLinks.forEach((l) => l.classList.remove("active"));
                    // Add active class to clicked link
                    link.classList.add("active");
                });
            });

            // Highlight current page
            const currentPath = window.location.pathname;
            navLinks.forEach((link) => {
                const href = link.getAttribute("href");
                if (
                    href &&
                    (currentPath === href ||
                        currentPath.includes(href.replace("/", "")))
                ) {
                    link.classList.add("active");
                }
            });

            // Auto-collapse on mobile when window resizes
            window.addEventListener("resize", () => {
                if (window.innerWidth <= 992 && sidebar && sidebarOverlay) {
                    sidebar.classList.remove("show");
                    sidebarOverlay.classList.remove("show");
                    document.body.style.overflow = "";
                }
            });
        } // Fullscreen toggle
        const fullscreenToggle = document.getElementById("fullscreenToggle");
        if (fullscreenToggle) {
            fullscreenToggle.addEventListener(
                "click",
                this.toggleFullscreen.bind(this)
            );
        }

        // Theme toggle
        const themeToggle = document.getElementById("themeToggle");
        if (themeToggle) {
            themeToggle.addEventListener("click", this.toggleTheme.bind(this));
        }

        // Search functionality
        this.initSearchEvents();

        // Notification actions
        this.initNotificationEvents();

        // Auto-hide alerts
        this.initAlertAutoHide();
    }

    initTooltips() {
        // Initialize Bootstrap tooltips
        const tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    initSearch() {
        const searchInput = document.querySelector(".search-input");
        const searchClear = document.querySelector(".search-clear");

        if (searchInput && searchClear) {
            searchInput.addEventListener("input", (e) => {
                if (e.target.value.length > 0) {
                    searchClear.style.display = "flex";
                } else {
                    searchClear.style.display = "none";
                }
            });

            searchClear.addEventListener("click", () => {
                searchInput.value = "";
                searchClear.style.display = "none";
                searchInput.focus();
            });
        }
    }

    initSearchEvents() {
        const searchInput = document.querySelector(".search-input");
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener("input", (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.performSearch(e.target.value);
                }, 300);
            });

            // Search keyboard shortcuts
            document.addEventListener("keydown", (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key === "k") {
                    e.preventDefault();
                    searchInput.focus();
                }
                if (
                    e.key === "Escape" &&
                    document.activeElement === searchInput
                ) {
                    searchInput.blur();
                }
            });
        }
    }

    performSearch(query) {
        if (query.length < 2) return;

        // Add your search logic here
        console.log("Searching for:", query);

        // Example: Show search results dropdown
        this.showSearchResults([
            {
                title: "Sản phẩm: " + query,
                url: "/admin/products?search=" + query,
            },
            {
                title: "Đơn hàng: #" + query,
                url: "/admin/orders?search=" + query,
            },
            {
                title: "Khách hàng: " + query,
                url: "/admin/customers?search=" + query,
            },
        ]);
    }

    showSearchResults(results) {
        // Implementation for search results dropdown
        console.log("Search results:", results);
    }

    initTheme() {
        const savedTheme = localStorage.getItem("admin-theme");
        if (savedTheme) {
            document.body.classList.toggle("dark-mode", savedTheme === "dark");
            this.updateThemeIcon();
        }
    }

    toggleTheme() {
        document.body.classList.toggle("dark-mode");
        const isDark = document.body.classList.contains("dark-mode");
        localStorage.setItem("admin-theme", isDark ? "dark" : "light");
        this.updateThemeIcon();
    }

    updateThemeIcon() {
        const themeToggle = document.getElementById("themeToggle");
        if (themeToggle) {
            const icon = themeToggle.querySelector("i");
            const isDark = document.body.classList.contains("dark-mode");
            icon.className = isDark ? "bi bi-moon" : "bi bi-sun";
        }
    }

    toggleFullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch((err) => {
                console.log(
                    `Error attempting to enable full-screen mode: ${err.message}`
                );
            });
        } else {
            document.exitFullscreen();
        }
    }

    updateSidebarState() {
        const sidebar = document.getElementById("sidebar");
        const isCollapsed = sidebar.classList.contains("collapsed");
        localStorage.setItem("sidebar-collapsed", isCollapsed);
    }

    initNotificationEvents() {
        // Mark notifications as read
        const notificationItems = document.querySelectorAll(
            ".notification-item.unread"
        );
        notificationItems.forEach((item) => {
            item.addEventListener("click", () => {
                item.classList.remove("unread");
                this.updateNotificationCount();
            });
        });

        // Clear all notifications
        const clearAllBtn = document.querySelector(".btn-clear-all");
        if (clearAllBtn) {
            clearAllBtn.addEventListener("click", () => {
                notificationItems.forEach((item) => {
                    item.classList.remove("unread");
                });
                this.updateNotificationCount();
            });
        }
    }

    updateNotificationCount() {
        const unreadCount = document.querySelectorAll(
            ".notification-item.unread"
        ).length;
        const badge = document.querySelector(
            ".quick-action-btn .notification-badge"
        );
        if (badge) {
            if (unreadCount > 0) {
                badge.textContent = unreadCount;
                badge.style.display = "flex";
            } else {
                badge.style.display = "none";
            }
        }
    }

    initAlertAutoHide() {
        const alerts = document.querySelectorAll(".alert");
        alerts.forEach((alert) => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    }

    hideLoadingOverlay() {
        const overlay = document.getElementById("loading-overlay");
        if (overlay) {
            setTimeout(() => {
                overlay.classList.add("hidden");
            }, 500);
        }
    }

    initCharts() {
        // Initialize Chart.js defaults
        if (typeof Chart !== "undefined") {
            Chart.defaults.font.family = "Plus Jakarta Sans";
            Chart.defaults.font.size = 12;
            Chart.defaults.color = "#6b7280";
            Chart.defaults.borderColor = "rgba(0,0,0,0.1)";
        }
    }

    // Utility functions
    formatCurrency(amount) {
        return new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
        }).format(amount);
    }

    formatNumber(num) {
        return new Intl.NumberFormat("vi-VN").format(num);
    }

    showToast(message, type = "success") {
        const toast = document.createElement("div");
        toast.className = `toast align-items-center text-white bg-${type} border-0`;
        toast.setAttribute("role", "alert");
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        // Add to toast container or create one
        let toastContainer = document.querySelector(".toast-container");
        if (!toastContainer) {
            toastContainer = document.createElement("div");
            toastContainer.className =
                "toast-container position-fixed top-0 end-0 p-3";
            document.body.appendChild(toastContainer);
        }

        toastContainer.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();

        // Remove toast element after it's hidden
        toast.addEventListener("hidden.bs.toast", () => {
            toast.remove();
        });
    }

    // Data refresh functionality
    refreshData() {
        this.showToast("Đang cập nhật dữ liệu...", "info");

        // Add your data refresh logic here
        fetch("/admin/api/dashboard-data")
            .then((response) => response.json())
            .then((data) => {
                this.updateDashboardData(data);
                this.showToast("Dữ liệu đã được cập nhật!", "success");
            })
            .catch((error) => {
                console.error("Error refreshing data:", error);
                this.showToast("Lỗi khi cập nhật dữ liệu!", "danger");
            });
    }

    updateDashboardData(data) {
        // Update metric cards
        if (data.metrics) {
            Object.keys(data.metrics).forEach((key) => {
                const element = document.querySelector(
                    `[data-metric="${key}"]`
                );
                if (element) {
                    element.textContent = this.formatNumber(data.metrics[key]);
                }
            });
        }

        // Update charts
        if (data.chartData) {
            this.updateCharts(data.chartData);
        }
    }

    updateCharts(chartData) {
        // Update existing charts with new data
        if (window.dashboardCharts) {
            Object.keys(chartData).forEach((chartId) => {
                const chart = window.dashboardCharts[chartId];
                if (chart && chartData[chartId]) {
                    chart.data = chartData[chartId];
                    chart.update("active");
                }
            });
        }
    }

    // Responsive utilities
    isMobile() {
        return window.innerWidth <= 768;
    }

    isTablet() {
        return window.innerWidth <= 1024 && window.innerWidth > 768;
    }

    // Animation utilities
    animateValue(element, start, end, duration = 1000) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min(
                (timestamp - startTimestamp) / duration,
                1
            );
            const currentValue = Math.floor(progress * (end - start) + start);
            element.textContent = this.formatNumber(currentValue);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Export functionality
    exportData(type, format = "excel") {
        this.showToast("Đang xuất dữ liệu...", "info");

        const url = `/admin/export/${type}?format=${format}`;
        window.open(url, "_blank");
    }

    // Print functionality
    printReport() {
        window.print();
    }
}

// Real-time updates
class RealTimeUpdates {
    constructor() {
        this.connection = null;
        this.reconnectAttempts = 0;
        this.maxReconnectAttempts = 5;
        this.reconnectInterval = 5000;
    }

    connect() {
        // WebSocket connection for real-time updates
        if ("WebSocket" in window) {
            try {
                this.connection = new WebSocket(
                    `ws://${window.location.host}/admin/ws`
                );
                this.setupEventHandlers();
            } catch (error) {
                console.log("WebSocket connection failed:", error);
            }
        }
    }

    setupEventHandlers() {
        if (!this.connection) return;

        this.connection.onopen = () => {
            console.log("Real-time connection established");
            this.reconnectAttempts = 0;
        };

        this.connection.onmessage = (event) => {
            const data = JSON.parse(event.data);
            this.handleRealTimeUpdate(data);
        };

        this.connection.onclose = () => {
            console.log("Real-time connection closed");
            this.attemptReconnect();
        };

        this.connection.onerror = (error) => {
            console.error("WebSocket error:", error);
        };
    }

    handleRealTimeUpdate(data) {
        switch (data.type) {
            case "new_order":
                this.handleNewOrder(data.payload);
                break;
            case "metric_update":
                this.handleMetricUpdate(data.payload);
                break;
            case "notification":
                this.handleNewNotification(data.payload);
                break;
            default:
                console.log("Unknown update type:", data.type);
        }
    }

    handleNewOrder(order) {
        // Update order count
        const orderMetric = document.querySelector('[data-metric="orders"]');
        if (orderMetric) {
            const currentValue = parseInt(
                orderMetric.textContent.replace(/,/g, "")
            );
            adminDashboard.animateValue(
                orderMetric,
                currentValue,
                currentValue + 1
            );
        }

        // Show notification
        adminDashboard.showToast(
            `Đơn hàng mới #${order.id} từ ${order.customer_name}`,
            "success"
        );
    }

    handleMetricUpdate(metrics) {
        // Update dashboard metrics
        adminDashboard.updateDashboardData({ metrics });
    }

    handleNewNotification(notification) {
        // Add new notification to dropdown
        const notificationList = document.querySelector(".notification-list");
        if (notificationList) {
            const notificationHtml = `
                <div class="notification-item unread">
                    <div class="notification-icon">
                        <i class="${notification.icon}"></i>
                    </div>
                    <div class="notification-content">
                        <p class="notification-title">${notification.title}</p>
                        <p class="notification-time">Vừa xong</p>
                    </div>
                </div>
            `;
            notificationList.insertAdjacentHTML("afterbegin", notificationHtml);
        }

        // Update notification count
        adminDashboard.updateNotificationCount();
    }

    attemptReconnect() {
        if (this.reconnectAttempts < this.maxReconnectAttempts) {
            this.reconnectAttempts++;
            setTimeout(() => {
                console.log(
                    `Attempting to reconnect... (${this.reconnectAttempts}/${this.maxReconnectAttempts})`
                );
                this.connect();
            }, this.reconnectInterval);
        }
    }

    disconnect() {
        if (this.connection) {
            this.connection.close();
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Initialize dashboard
    window.adminDashboard = new AdminDashboard();

    // Initialize real-time updates
    window.realTimeUpdates = new RealTimeUpdates();
    window.realTimeUpdates.connect();

    // Restore sidebar state
    const sidebarCollapsed = localStorage.getItem("sidebar-collapsed");
    if (sidebarCollapsed === "true") {
        document.getElementById("sidebar")?.classList.add("collapsed");
    }

    // Handle page visibility change
    document.addEventListener("visibilitychange", function () {
        if (document.visibilityState === "visible") {
            // Refresh data when page becomes visible
            setTimeout(() => {
                adminDashboard.refreshData();
            }, 1000);
        }
    });

    // Handle window resize
    window.addEventListener("resize", function () {
        // Update charts on resize
        if (window.dashboardCharts) {
            Object.values(window.dashboardCharts).forEach((chart) => {
                if (chart && typeof chart.resize === "function") {
                    chart.resize();
                }
            });
        }
    });

    // Add keyboard shortcuts
    document.addEventListener("keydown", function (e) {
        // Ctrl+R: Refresh data
        if ((e.ctrlKey || e.metaKey) && e.key === "r" && e.shiftKey) {
            e.preventDefault();
            adminDashboard.refreshData();
        }

        // Ctrl+P: Print
        if ((e.ctrlKey || e.metaKey) && e.key === "p") {
            e.preventDefault();
            adminDashboard.printReport();
        }
    });
});

// Cleanup on page unload
window.addEventListener("beforeunload", function () {
    if (window.realTimeUpdates) {
        window.realTimeUpdates.disconnect();
    }
});

// Performance monitoring
if ("performance" in window) {
    window.addEventListener("load", function () {
        setTimeout(() => {
            const perfData = performance.timing;
            const loadTime = perfData.loadEventEnd - perfData.navigationStart;
            console.log(`Dashboard loaded in ${loadTime}ms`);

            // Report to analytics if needed
            if (loadTime > 3000) {
                console.warn("Dashboard load time is slow:", loadTime + "ms");
            }
        }, 0);
    });
}
