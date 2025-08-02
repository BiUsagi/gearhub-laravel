// Search functionality
function searchOrder() {
    const searchValue = document.getElementById("searchInput").value;
    console.log("Searching for:", searchValue);

    // Simulate search
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
            showToast("Tìm thấy đơn hàng!", "success");
        }, 1500);
    }
}

// Filter by status
function filterByStatus(status) {
    console.log("Filtering by status:", status);

    // Simulate filtering
    const tableBody = document.querySelector("tbody");
    const rows = tableBody.querySelectorAll("tr");

    rows.forEach((row) => {
        if (status === "" || row.textContent.toLowerCase().includes(status)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });

    showToast(`Lọc theo trạng thái: ${status || "Tất cả"}`, "info");
}

// Quick actions
function updateStatus() {
    showToast("Đang cập nhật trạng thái...", "info");
    setTimeout(() => {
        showToast("Cập nhật trạng thái thành công!", "success");
    }, 1000);
}

function contactCustomer() {
    showToast("Đang kết nối với khách hàng...", "info");
}

function printLabel() {
    showToast("Đang chuẩn bị in nhãn vận chuyển...", "info");
    setTimeout(() => {
        window.print();
    }, 500);
}

function confirmDelivery() {
    if (confirm("Xác nhận đơn hàng đã được giao thành công?")) {
        showToast("Đã xác nhận giao hàng thành công!", "success");
    }
}

function reportIssue() {
    const issue = prompt("Mô tả sự cố:");
    if (issue) {
        showToast("Đã ghi nhận sự cố. Cảm ơn bạn!", "warning");
    }
}

// Toast notification function
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

// Enter key search
document
    .getElementById("searchInput")
    .addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            searchOrder();
        }
    });

// Auto-refresh tracking status every 30 seconds
setInterval(() => {
    console.log("Auto-refreshing tracking status...");
    // In real app, this would make an API call to update status
}, 30000);

// Initialize tooltips
document.addEventListener("DOMContentLoaded", function () {
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll("[title]")
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
