/* ===== ADMIN ORDERS INVOICES JS ===== */

document.addEventListener("DOMContentLoaded", function () {
    initializeInvoicesPage();
});

function initializeInvoicesPage() {
    // Initialize checkbox handlers
    initializeCheckboxes();

    // Initialize search
    initializeSearch();

    // Initialize tooltips
    initializeTooltips();

    // Initialize modals
    initializeModals();

    // Auto-refresh data
    setInterval(refreshStats, 30000); // Refresh every 30 seconds
}

// ===== CHECKBOX HANDLING =====
function initializeCheckboxes() {
    const selectAllCheckbox = document.getElementById("selectAll");
    const rowCheckboxes = document.querySelectorAll(
        'tbody input[type="checkbox"]'
    );
    const bulkActions = document.querySelector(".bulk-actions");

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener("change", function () {
            rowCheckboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
            toggleBulkActions();
        });
    }

    rowCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            updateSelectAllState();
            toggleBulkActions();
        });
    });

    function updateSelectAllState() {
        const checkedCount = document.querySelectorAll(
            'tbody input[type="checkbox"]:checked'
        ).length;
        const totalCount = rowCheckboxes.length;

        if (selectAllCheckbox) {
            selectAllCheckbox.checked = checkedCount === totalCount;
            selectAllCheckbox.indeterminate =
                checkedCount > 0 && checkedCount < totalCount;
        }
    }

    function toggleBulkActions() {
        const checkedCount = document.querySelectorAll(
            'tbody input[type="checkbox"]:checked'
        ).length;
        if (bulkActions) {
            bulkActions.style.display = checkedCount > 0 ? "flex" : "none";
        }
    }
}

// ===== SEARCH FUNCTIONALITY =====
function initializeSearch() {
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                searchInvoices();
            }
        });
    }
}

function searchInvoices() {
    const searchValue = document.getElementById("searchInput").value;
    console.log("Searching for:", searchValue);

    if (searchValue.trim()) {
        // Show loading state
        const searchBtn = document.querySelector(".input-group .btn-primary");
        const originalText = searchBtn.innerHTML;
        searchBtn.innerHTML =
            '<i class="bi bi-hourglass-split me-1"></i>Đang tìm...';
        searchBtn.disabled = true;

        // Simulate API call
        setTimeout(() => {
            searchBtn.innerHTML = originalText;
            searchBtn.disabled = false;

            // Show success message
            showToast(
                "Tìm thấy " + Math.floor(Math.random() * 10 + 1) + " hóa đơn!",
                "success"
            );

            // Filter table rows (simulate)
            filterTableRows(searchValue);
        }, 1500);
    }
}

function filterTableRows(searchValue) {
    const tableBody = document.querySelector("tbody");
    const rows = tableBody.querySelectorAll("tr");

    rows.forEach((row) => {
        const text = row.textContent.toLowerCase();
        const shouldShow = text.includes(searchValue.toLowerCase());
        row.style.display = shouldShow ? "" : "none";
    });
}

// ===== FILTER FUNCTIONS =====
function filterByStatus(status) {
    console.log("Filtering by status:", status);

    const tableBody = document.querySelector("tbody");
    const rows = tableBody.querySelectorAll("tr");

    rows.forEach((row) => {
        if (status === "") {
            row.style.display = "";
        } else {
            const statusBadge = row.querySelector(".status-badge");
            if (statusBadge) {
                const hasStatus = statusBadge.classList.contains(status);
                row.style.display = hasStatus ? "" : "none";
            }
        }
    });

    showToast(`Lọc theo trạng thái: ${getStatusText(status)}`, "info");
}

function getStatusText(status) {
    const statusMap = {
        paid: "Đã thanh toán",
        pending: "Chờ thanh toán",
        overdue: "Quá hạn",
        cancelled: "Đã hủy",
        "": "Tất cả",
    };
    return statusMap[status] || "Không xác định";
}

// ===== INVOICE ACTIONS =====
function viewInvoice(invoiceId) {
    console.log("Viewing invoice:", invoiceId);

    // Update modal title
    const modalTitle = document.querySelector(
        "#invoiceDetailModal .modal-title"
    );
    if (modalTitle) {
        modalTitle.innerHTML = `<i class="bi bi-receipt-cutoff me-2"></i>Chi tiết hóa đơn #${invoiceId}`;
    }

    // Show modal
    const modal = new bootstrap.Modal(
        document.getElementById("invoiceDetailModal")
    );
    modal.show();

    // Load invoice details
    loadInvoiceDetails(invoiceId);
}

function loadInvoiceDetails(invoiceId) {
    const previewContainer = document.querySelector(".invoice-preview");

    // Show loading
    previewContainer.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Đang tải chi tiết hóa đơn...</p>
        </div>
    `;

    // Simulate loading
    setTimeout(() => {
        previewContainer.innerHTML = generateInvoiceHTML(invoiceId);
    }, 1500);
}

function generateInvoiceHTML(invoiceId) {
    return `
        <div class="invoice-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-3">GearHub Electronics</h3>
                    <p class="mb-1">123 Nguyễn Văn Cừ, Quận 1</p>
                    <p class="mb-1">TP. Hồ Chí Minh, Việt Nam</p>
                    <p class="mb-1">Điện thoại: (028) 1234-5678</p>
                    <p class="mb-3">Email: info@gearhub.vn</p>
                </div>
                <div class="col-md-6 text-end">
                    <h2 class="text-primary">HÓA ĐƠN</h2>
                    <p class="mb-1"><strong>Số hóa đơn:</strong> #${invoiceId}</p>
                    <p class="mb-1"><strong>Ngày tạo:</strong> 01/08/2025</p>
                    <p class="mb-1"><strong>Hạn thanh toán:</strong> 15/08/2025</p>
                    <p class="mb-3"><strong>Trạng thái:</strong> <span class="badge bg-success">Đã thanh toán</span></p>
                </div>
            </div>
        </div>
        
        <div class="invoice-details mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h5>Thông tin khách hàng:</h5>
                    <p class="mb-1"><strong>Nguyễn Văn A</strong></p>
                    <p class="mb-1">456 Lê Lợi, Quận 3</p>
                    <p class="mb-1">TP. Hồ Chí Minh</p>
                    <p class="mb-1">Điện thoại: 0123.456.789</p>
                    <p class="mb-3">Email: nguyenvana@email.com</p>
                </div>
                <div class="col-md-6">
                    <h5>Thông tin thanh toán:</h5>
                    <p class="mb-1"><strong>Phương thức:</strong> VNPay</p>
                    <p class="mb-1"><strong>Ngày thanh toán:</strong> 01/08/2025</p>
                    <p class="mb-1"><strong>Mã giao dịch:</strong> TXN123456789</p>
                </div>
            </div>
        </div>
        
        <div class="invoice-items mt-4">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>iPhone 15 Pro Max 256GB</td>
                        <td>1</td>
                        <td>28.990.000 ₫</td>
                        <td>28.990.000 ₫</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Case iPhone 15 Pro Max</td>
                        <td>1</td>
                        <td>500.000 ₫</td>
                        <td>500.000 ₫</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="invoice-total mt-4">
            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <table class="table">
                        <tr>
                            <td><strong>Tạm tính:</strong></td>
                            <td class="text-end">29.490.000 ₫</td>
                        </tr>
                        <tr>
                            <td><strong>Giảm giá:</strong></td>
                            <td class="text-end">-490.000 ₫</td>
                        </tr>
                        <tr>
                            <td><strong>VAT (10%):</strong></td>
                            <td class="text-end">2.900.000 ₫</td>
                        </tr>
                        <tr class="table-primary">
                            <td><strong>Tổng cộng:</strong></td>
                            <td class="text-end"><strong>31.900.000 ₫</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="invoice-footer mt-4">
            <p class="text-muted">
                <small>
                    Cảm ơn quý khách đã mua hàng tại GearHub Electronics. 
                    Mọi thắc mắc xin liên hệ hotline: (028) 1234-5678
                </small>
            </p>
        </div>
    `;
}

function printInvoice(invoiceId) {
    console.log("Printing invoice:", invoiceId);

    showToast("Đang chuẩn bị in hóa đơn...", "info");

    setTimeout(() => {
        // Open print dialog
        window.print();
        showToast("Hóa đơn đã được gửi đến máy in!", "success");
    }, 1000);
}

function emailInvoice(invoiceId) {
    console.log("Emailing invoice:", invoiceId);

    const email = prompt("Nhập địa chỉ email để gửi hóa đơn:");
    if (email) {
        showToast("Đang gửi hóa đơn đến " + email + "...", "info");

        setTimeout(() => {
            showToast("Hóa đơn đã được gửi thành công!", "success");
        }, 2000);
    }
}

function remindCustomer(invoiceId) {
    console.log("Reminding customer for invoice:", invoiceId);

    if (confirm("Gửi nhắc nhở thanh toán đến khách hàng?")) {
        showToast("Đang gửi nhắc nhở...", "info");

        setTimeout(() => {
            showToast("Đã gửi nhắc nhở thanh toán thành công!", "success");
        }, 1500);
    }
}

// ===== BULK ACTIONS =====
function exportInvoices() {
    console.log("Exporting invoices...");

    showToast("Đang xuất dữ liệu...", "info");

    setTimeout(() => {
        // Simulate file download
        const link = document.createElement("a");
        link.href = "data:text/plain;charset=utf-8,Sample Invoice Data";
        link.download =
            "invoices_" + new Date().toISOString().split("T")[0] + ".xlsx";
        link.click();

        showToast("Xuất dữ liệu thành công!", "success");
    }, 2000);
}

function createInvoice() {
    console.log("Creating new invoice...");

    showToast("Chuyển đến trang tạo hóa đơn...", "info");

    // Simulate navigation
    setTimeout(() => {
        // window.location.href = '/admin/invoices/create';
        showToast("Tính năng đang phát triển...", "warning");
    }, 1000);
}

// ===== UTILITY FUNCTIONS =====
function refreshTable() {
    console.log("Refreshing table...");

    const refreshBtn = document.querySelector('[onclick="refreshTable()"]');
    if (refreshBtn) {
        const originalHTML = refreshBtn.innerHTML;
        refreshBtn.innerHTML = '<i class="bi bi-hourglass-split"></i>';
        refreshBtn.disabled = true;

        setTimeout(() => {
            refreshBtn.innerHTML = originalHTML;
            refreshBtn.disabled = false;
            showToast("Dữ liệu đã được cập nhật!", "success");
        }, 1500);
    }
}

function refreshStats() {
    // Simulate stats refresh
    const statValues = document.querySelectorAll(".stat-value");
    statValues.forEach((stat) => {
        // Add subtle animation to indicate refresh
        stat.style.opacity = "0.7";
        setTimeout(() => {
            stat.style.opacity = "1";
        }, 300);
    });
}

// ===== INITIALIZATION HELPERS =====
function initializeTooltips() {
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll("[title]")
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

function initializeModals() {
    // Modal event listeners
    const invoiceModal = document.getElementById("invoiceDetailModal");
    if (invoiceModal) {
        invoiceModal.addEventListener("hidden.bs.modal", function () {
            // Reset modal content when closed
            const previewContainer = document.querySelector(".invoice-preview");
            if (previewContainer) {
                previewContainer.innerHTML = `
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Đang tải chi tiết hóa đơn...</p>
                    </div>
                `;
            }
        });
    }
}

// ===== TOAST NOTIFICATIONS =====
function showToast(message, type = "info") {
    const toastContainer =
        document.getElementById("toastContainer") || createToastContainer();

    const toast = document.createElement("div");
    toast.className = `toast align-items-center text-bg-${type} border-0`;
    toast.setAttribute("role", "alert");
    toast.setAttribute("aria-live", "assertive");
    toast.setAttribute("aria-atomic", "true");

    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;

    toastContainer.appendChild(toast);

    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();

    // Remove toast after it's hidden
    toast.addEventListener("hidden.bs.toast", () => {
        toast.remove();
    });
}

function createToastContainer() {
    const container = document.createElement("div");
    container.id = "toastContainer";
    container.className = "toast-container position-fixed bottom-0 end-0 p-3";
    container.style.zIndex = "1080";
    document.body.appendChild(container);
    return container;
}

// ===== KEYBOARD SHORTCUTS =====
document.addEventListener("keydown", function (e) {
    // Ctrl/Cmd + N = New Invoice
    if ((e.ctrlKey || e.metaKey) && e.key === "n") {
        e.preventDefault();
        createInvoice();
    }

    // Ctrl/Cmd + F = Focus Search
    if ((e.ctrlKey || e.metaKey) && e.key === "f") {
        e.preventDefault();
        const searchInput = document.getElementById("searchInput");
        if (searchInput) {
            searchInput.focus();
        }
    }

    // Ctrl/Cmd + P = Print
    if ((e.ctrlKey || e.metaKey) && e.key === "p") {
        e.preventDefault();
        const checkedInvoices = document.querySelectorAll(
            'tbody input[type="checkbox"]:checked'
        );
        if (checkedInvoices.length === 1) {
            const row = checkedInvoices[0].closest("tr");
            const invoiceId = row
                .querySelector(".invoice-code .fw-semibold")
                .textContent.replace("#", "");
            printInvoice(invoiceId);
        }
    }
});

// ===== EXPORT FOR GLOBAL ACCESS =====
window.invoiceActions = {
    searchInvoices,
    filterByStatus,
    viewInvoice,
    printInvoice,
    emailInvoice,
    remindCustomer,
    exportInvoices,
    createInvoice,
    refreshTable,
};
