/* ===== ADMIN ORDERS INDEX JAVASCRIPT ===== */

// Biến toàn cục
let selectedOrders = new Set();
let allOrders = [];
let filteredOrders = [];

// Khởi tạo khi DOM đã sẵn sàng
document.addEventListener("DOMContentLoaded", function () {
    initOrdersPage();
    initFilters();
    initBulkActions();
    initTableInteractions();
    initExportActions();
    initPagination();
    initStatsAnimation();
    loadOrdersData();
});

// ===== KHỞI TẠO TRANG ORDERS =====
function initOrdersPage() {
    console.log("Orders page initialized");

    // Khởi tạo tooltips cho các nút
    initTooltips();

    // Khởi tạo refresh button
    const refreshBtn = document.querySelector('[onclick="refreshOrders()"]');
    if (refreshBtn) {
        refreshBtn.addEventListener("click", function (e) {
            e.preventDefault();
            refreshOrders();
        });
    }
}

// Khởi tạo tooltips
function initTooltips() {
    const tooltipElements = document.querySelectorAll("[title]");
    tooltipElements.forEach((element) => {
        // Tạo hiệu ứng hover đơn giản
        element.addEventListener("mouseenter", function () {
            this.style.position = "relative";
        });
    });
}

// ===== BỘ LỌC VÀ TÌM KIẾM =====
function initFilters() {
    const searchInput = document.getElementById("searchOrders");
    const filterSelects = document.querySelectorAll(".filters-grid select");
    const advancedToggle = document.querySelector(".filter-toggle");

    // Tìm kiếm real-time
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener("input", function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(this.value);
            }, 300);
        });

        // Hiệu ứng focus
        searchInput.addEventListener("focus", function () {
            this.parentElement.style.transform = "scale(1.02)";
        });

        searchInput.addEventListener("blur", function () {
            this.parentElement.style.transform = "scale(1)";
        });
    }

    // Lắng nghe thay đổi bộ lọc
    filterSelects.forEach((select) => {
        select.addEventListener("change", applyFilters);
    });

    // Toggle advanced filters
    if (advancedToggle) {
        advancedToggle.addEventListener("click", toggleAdvancedFilters);
    }
}

// Thực hiện tìm kiếm
function performSearch(searchTerm) {
    const rows = document.querySelectorAll(".orders-table tbody tr");
    const term = searchTerm.toLowerCase();

    rows.forEach((row) => {
        const text = row.textContent.toLowerCase();
        const shouldShow = term === "" || text.includes(term);

        if (shouldShow) {
            row.style.display = "";
            row.style.animation = "fadeInUp 0.3s ease";
        } else {
            row.style.display = "none";
        }
    });

    updateTableInfo();
}

// Toggle advanced filters
function toggleAdvancedFilters() {
    const advancedFilters = document.getElementById("advancedFilters");
    const toggleIcon = document.getElementById("advancedToggleIcon");
    const toggle = document.querySelector(".filter-toggle");

    if (advancedFilters.classList.contains("show")) {
        advancedFilters.classList.remove("show");
        toggleIcon.style.transform = "rotate(0deg)";
        toggle.classList.remove("expanded");
    } else {
        advancedFilters.classList.add("show");
        toggleIcon.style.transform = "rotate(180deg)";
        toggle.classList.add("expanded");
    }
}

// Áp dụng bộ lọc
function applyFilters() {
    const statusFilter = document.getElementById("statusFilter")?.value;
    const paymentFilter = document.getElementById("paymentFilter")?.value;
    const dateRange = document.getElementById("dateRange")?.value;
    const amountRange = document.getElementById("amountRange")?.value;
    const sortBy = document.getElementById("sortBy")?.value;

    console.log("Applying filters:", {
        status: statusFilter,
        payment: paymentFilter,
        date: dateRange,
        amount: amountRange,
        sort: sortBy,
    });

    // Hiển thị loading indicator
    showLoadingState();

    // Simulate API call
    setTimeout(() => {
        hideLoadingState();
        updateTableInfo();
    }, 500);
}

// Xóa bộ lọc
function clearFilters() {
    document.querySelectorAll(".filters-grid select").forEach((select) => {
        select.value = "";
    });

    document.getElementById("searchOrders").value = "";

    // Reset table
    document.querySelectorAll(".orders-table tbody tr").forEach((row) => {
        row.style.display = "";
    });

    updateTableInfo();
}

// ===== BULK ACTIONS =====
function initBulkActions() {
    const selectAllCheckbox = document.getElementById("selectAll");
    const itemCheckboxes = document.querySelectorAll(".item-checkbox");

    // Select all functionality
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener("change", function () {
            const checked = this.checked;
            itemCheckboxes.forEach((checkbox) => {
                checkbox.checked = checked;
                handleCheckboxChange(checkbox, checked);
            });
            updateBulkActions();
        });
    }

    // Individual checkbox handling
    itemCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            handleCheckboxChange(this, this.checked);
            updateSelectAllState();
            updateBulkActions();
        });
    });
}

function handleCheckboxChange(checkbox, checked) {
    const orderId = checkbox.value;
    const row = checkbox.closest("tr");

    if (checked) {
        selectedOrders.add(orderId);
        row.style.background = "rgba(99, 102, 241, 0.05)";
        row.style.transform = "scale(1.01)";
    } else {
        selectedOrders.delete(orderId);
        row.style.background = "";
        row.style.transform = "";
    }
}

function updateSelectAllState() {
    const selectAllCheckbox = document.getElementById("selectAll");
    const itemCheckboxes = document.querySelectorAll(".item-checkbox");
    const checkedBoxes = document.querySelectorAll(".item-checkbox:checked");

    if (checkedBoxes.length === 0) {
        selectAllCheckbox.indeterminate = false;
        selectAllCheckbox.checked = false;
    } else if (checkedBoxes.length === itemCheckboxes.length) {
        selectAllCheckbox.indeterminate = false;
        selectAllCheckbox.checked = true;
    } else {
        selectAllCheckbox.indeterminate = true;
    }
}

function updateBulkActions() {
    const bulkActions = document.getElementById("bulkActions");
    const selectedCount = document.getElementById("selectedCount");

    if (selectedOrders.size > 0) {
        bulkActions.classList.add("show");
        selectedCount.textContent = selectedOrders.size;
    } else {
        bulkActions.classList.remove("show");
    }
}

function applyBulkAction() {
    const action = document.getElementById("bulkAction")?.value;

    if (!action || selectedOrders.size === 0) {
        alert("Vui lòng chọn hành động và ít nhất một đơn hàng!");
        return;
    }

    const orderIds = Array.from(selectedOrders);
    console.log(`Applying ${action} to orders:`, orderIds);

    // Hiển thị loading
    showLoadingState();

    // Simulate API call
    setTimeout(() => {
        hideLoadingState();
        alert(`Đã áp dụng "${action}" cho ${orderIds.length} đơn hàng!`);

        // Reset selections
        selectedOrders.clear();
        updateBulkActions();
        document.querySelectorAll(".item-checkbox").forEach((cb) => {
            cb.checked = false;
        });
        document.getElementById("selectAll").checked = false;
    }, 1000);
}

// ===== TABLE INTERACTIONS =====
function initTableInteractions() {
    // Row hover effects
    const tableRows = document.querySelectorAll(".orders-table tbody tr");
    tableRows.forEach((row) => {
        row.addEventListener("mouseenter", function () {
            if (!this.querySelector(".item-checkbox").checked) {
                this.style.transform = "translateX(4px)";
            }
        });

        row.addEventListener("mouseleave", function () {
            if (!this.querySelector(".item-checkbox").checked) {
                this.style.transform = "";
            }
        });
    });
}

// ===== ORDER ACTIONS =====
function viewOrder(orderId) {
    console.log("View order:", orderId);
    showLoadingModal("Đang tải chi tiết đơn hàng...");

    setTimeout(() => {
        hideLoadingModal();
        alert(`Xem chi tiết đơn hàng #${orderId}`);
    }, 800);
}

function confirmOrder(orderId) {
    if (confirm("Bạn có chắc chắn muốn xác nhận đơn hàng này?")) {
        console.log("Confirm order:", orderId);
        updateOrderStatus(orderId, "confirmed");
    }
}

function editOrder(orderId) {
    console.log("Edit order:", orderId);
    alert(`Chỉnh sửa đơn hàng #${orderId}`);
}

function cancelOrder(orderId) {
    if (confirm("Bạn có chắc chắn muốn hủy đơn hàng này?")) {
        console.log("Cancel order:", orderId);
        updateOrderStatus(orderId, "cancelled");
    }
}

function prepareShipping(orderId) {
    console.log("Prepare shipping for order:", orderId);
    updateOrderStatus(orderId, "shipping");
}

function trackShipping(orderId) {
    console.log("Track shipping for order:", orderId);
    alert(`Theo dõi vận chuyển đơn hàng #${orderId}`);
}

function completeDelivery(orderId) {
    if (confirm("Xác nhận đơn hàng đã được giao thành công?")) {
        console.log("Complete delivery for order:", orderId);
        updateOrderStatus(orderId, "delivered");
    }
}

function reportIssue(orderId) {
    console.log("Report issue for order:", orderId);
    alert(`Báo cáo sự cố cho đơn hàng #${orderId}`);
}

function printInvoice(orderId) {
    console.log("Print invoice for order:", orderId);
    showLoadingModal("Đang chuẩn bị hóa đơn...");

    setTimeout(() => {
        hideLoadingModal();
        alert(`In hóa đơn cho đơn hàng #${orderId}`);
    }, 1000);
}

function requestReview(orderId) {
    console.log("Request review for order:", orderId);
    alert(`Gửi yêu cầu đánh giá cho đơn hàng #${orderId}`);
}

function processReturn(orderId) {
    if (confirm("Bạn có chắc chắn muốn xử lý hoàn trả cho đơn hàng này?")) {
        console.log("Process return for order:", orderId);
        alert(`Xử lý hoàn trả cho đơn hàng #${orderId}`);
    }
}

function viewCancelReason(orderId) {
    console.log("View cancel reason for order:", orderId);
    alert(`Lý do hủy đơn hàng #${orderId}: Khách hàng thay đổi ý định`);
}

function recreateOrder(orderId) {
    if (confirm("Bạn có muốn tạo lại đơn hàng này?")) {
        console.log("Recreate order:", orderId);
        alert(`Tạo lại đơn hàng từ #${orderId}`);
    }
}

function contactCustomer(orderId) {
    console.log("Contact customer for order:", orderId);
    alert(`Liên hệ khách hàng cho đơn hàng #${orderId}`);
}

// Cập nhật trạng thái đơn hàng
function updateOrderStatus(orderId, newStatus) {
    showLoadingState();

    setTimeout(() => {
        hideLoadingState();

        // Tìm và cập nhật status badge
        const row = document
            .querySelector(`input[value="${orderId}"]`)
            ?.closest("tr");
        if (row) {
            const statusBadge = row.querySelector(".status-badge");
            if (statusBadge) {
                updateStatusBadge(statusBadge, newStatus);
            }
        }

        alert(
            `Đã cập nhật trạng thái đơn hàng #${orderId} thành "${newStatus}"`
        );
    }, 800);
}

function updateStatusBadge(badge, status) {
    // Remove old classes
    badge.className = "status-badge";

    // Add new class and content
    switch (status) {
        case "confirmed":
            badge.classList.add("processing");
            badge.innerHTML = '<i class="bi bi-gear"></i> Đã xác nhận';
            break;
        case "shipping":
            badge.classList.add("shipped");
            badge.innerHTML = '<i class="bi bi-truck"></i> Đang giao hàng';
            break;
        case "delivered":
            badge.classList.add("delivered");
            badge.innerHTML = '<i class="bi bi-check-circle"></i> Đã giao';
            break;
        case "cancelled":
            badge.classList.add("cancelled");
            badge.innerHTML = '<i class="bi bi-x-circle"></i> Đã hủy';
            break;
    }

    // Animation effect
    badge.style.animation = "pulse 0.5s ease";
}

// ===== EXPORT ACTIONS =====
function initExportActions() {
    const exportButtons = document.querySelectorAll(".export-btn");
    exportButtons.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const format = this.classList.contains("excel")
                ? "excel"
                : this.classList.contains("pdf")
                ? "pdf"
                : "csv";
            exportOrders(format);
        });
    });
}

function exportOrders(format) {
    console.log("Export orders as:", format);

    showLoadingModal(`Đang xuất dữ liệu định dạng ${format.toUpperCase()}...`);

    setTimeout(() => {
        hideLoadingModal();
        alert(
            `Đã xuất ${
                selectedOrders.size || "tất cả"
            } đơn hàng định dạng ${format.toUpperCase()}`
        );
    }, 1500);
}

// ===== PAGINATION =====
function initPagination() {
    const pageButtons = document.querySelectorAll(".page-btn:not(:disabled)");
    pageButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            if (!this.classList.contains("active")) {
                document
                    .querySelector(".page-btn.active")
                    ?.classList.remove("active");
                this.classList.add("active");

                const page = this.textContent;
                loadPage(page);
            }
        });
    });
}

function loadPage(page) {
    console.log("Loading page:", page);
    showLoadingState();

    setTimeout(() => {
        hideLoadingState();
        updateTableInfo();
    }, 500);
}

// ===== STATS ANIMATION =====
function initStatsAnimation() {
    const statValues = document.querySelectorAll(".stat-value");

    // Observer for counter animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const text = element.textContent;
                const number = parseInt(text.replace(/[^\d]/g, ""));

                if (number && !element.dataset.animated) {
                    element.dataset.animated = "true";
                    animateCounter(element, number, text);
                    observer.unobserve(element);
                }
            }
        });
    });

    statValues.forEach((value) => observer.observe(value));
}

function animateCounter(element, target, originalText) {
    const duration = 2000;
    const increment = target / (duration / 16);
    let current = 0;

    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = originalText;
            clearInterval(timer);
        } else {
            const prefix = originalText.includes("₫") ? "₫" : "";
            const suffix = originalText.includes("%") ? "%" : "";
            element.textContent =
                prefix + Math.floor(current).toLocaleString() + suffix;
        }
    }, 16);
}

// ===== UTILITY FUNCTIONS =====
function refreshOrders() {
    console.log("Refreshing orders...");
    showLoadingState();

    setTimeout(() => {
        hideLoadingState();
        // Reset selections
        selectedOrders.clear();
        updateBulkActions();

        // Reset checkboxes
        document.querySelectorAll(".item-checkbox").forEach((cb) => {
            cb.checked = false;
        });
        document.getElementById("selectAll").checked = false;

        alert("Đã làm mới danh sách đơn hàng!");
    }, 1000);
}

function loadOrdersData() {
    // Simulate loading initial data
    console.log("Loading orders data...");
}

function updateTableInfo() {
    const visibleRows = document.querySelectorAll(
        '.orders-table tbody tr[style*="display: none"]'
    ).length;
    const totalRows = document.querySelectorAll(
        ".orders-table tbody tr"
    ).length;
    const showing = totalRows - visibleRows;

    const paginationInfo = document.querySelector(".pagination-info");
    if (paginationInfo) {
        paginationInfo.innerHTML = `Hiển thị <strong>1-${showing}</strong> trong tổng số <strong>${totalRows}</strong> đơn hàng`;
    }
}

function showLoadingState() {
    const tableContainer = document.querySelector(".orders-table-container");
    if (tableContainer) {
        tableContainer.style.opacity = "0.6";
        tableContainer.style.pointerEvents = "none";
    }
}

function hideLoadingState() {
    const tableContainer = document.querySelector(".orders-table-container");
    if (tableContainer) {
        tableContainer.style.opacity = "1";
        tableContainer.style.pointerEvents = "auto";
    }
}

function showLoadingModal(message) {
    // Create simple loading modal
    const modal = document.createElement("div");
    modal.id = "loadingModal";
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    `;

    modal.innerHTML = `
        <div style="background: var(--card-bg); padding: 24px; border-radius: 12px; text-align: center; border: 1px solid var(--border-color);">
            <div style="width: 40px; height: 40px; border: 3px solid var(--border-color); border-top: 3px solid var(--primary-color); border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 16px;"></div>
            <p style="color: var(--text-primary); margin: 0;">${message}</p>
        </div>
    `;

    // Add spin animation
    const style = document.createElement("style");
    style.textContent = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);

    document.body.appendChild(modal);
}

function hideLoadingModal() {
    const modal = document.getElementById("loadingModal");
    if (modal) {
        modal.remove();
    }
}
