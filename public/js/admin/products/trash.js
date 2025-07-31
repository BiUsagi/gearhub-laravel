document.addEventListener("DOMContentLoaded", function () {
    // Initialize modals
    const restoreModal = new bootstrap.Modal(
        document.getElementById("restoreModal")
    );
    const deleteModal = new bootstrap.Modal(
        document.getElementById("deleteModal")
    );
    const emptyTrashModal = new bootstrap.Modal(
        document.getElementById("emptyTrashModal")
    );
    const bulkActionsModal = new bootstrap.Modal(
        document.getElementById("bulkActionsModal")
    );

    // Variables to store current action data
    let currentProductId = null;

    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById("selectAll");
    const productCheckboxes = document.querySelectorAll(
        'tbody input[type="checkbox"]'
    );

    selectAllCheckbox.addEventListener("change", function () {
        productCheckboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    // Individual checkbox change
    productCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const checkedBoxes = document.querySelectorAll(
                'tbody input[type="checkbox"]:checked'
            );
            selectAllCheckbox.checked =
                checkedBoxes.length === productCheckboxes.length;
            selectAllCheckbox.indeterminate =
                checkedBoxes.length > 0 &&
                checkedBoxes.length < productCheckboxes.length;
        });
    });

    // Confirmation checkbox for delete
    const confirmDeleteCheck = document.getElementById("confirmDeleteCheck");
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

    confirmDeleteCheck.addEventListener("change", function () {
        confirmDeleteBtn.disabled = !this.checked;
    });

    // Confirmation checkbox for empty trash
    const confirmEmptyCheck = document.getElementById("confirmEmptyCheck");
    const confirmEmptyBtn = document.getElementById("confirmEmptyBtn");

    confirmEmptyCheck.addEventListener("change", function () {
        confirmEmptyBtn.disabled = !this.checked;
    });

    // Reset modal states when closed
    document
        .getElementById("deleteModal")
        .addEventListener("hidden.bs.modal", function () {
            confirmDeleteCheck.checked = false;
            confirmDeleteBtn.disabled = true;
        });

    document
        .getElementById("emptyTrashModal")
        .addEventListener("hidden.bs.modal", function () {
            confirmEmptyCheck.checked = false;
            confirmEmptyBtn.disabled = true;
        });
});

// Product data for modals
const productData = {
    1: {
        name: "iPhone 15 Pro Max",
        sku: "IP15PM-001",
        image: "https://via.placeholder.com/60x60/6c757d/ffffff?text=IMG",
    },
    2: {
        name: "MacBook Pro M3",
        sku: "MBP-M3-001",
        image: "https://via.placeholder.com/60x60/6c757d/ffffff?text=IMG",
    },
    3: {
        name: "AirPods Pro 2",
        sku: "APP2-001",
        image: "https://via.placeholder.com/60x60/6c757d/ffffff?text=IMG",
    },
    4: {
        name: "Samsung Galaxy Tab S9",
        sku: "SGT-S9-001",
        image: "https://via.placeholder.com/60x60/6c757d/ffffff?text=IMG",
    },
    5: {
        name: "Dell XPS 13",
        sku: "DXP-13-001",
        image: "https://via.placeholder.com/60x60/6c757d/ffffff?text=IMG",
    },
};

// Show restore modal
function restoreProduct(productId) {
    currentProductId = productId;
    const product = productData[productId];

    document.getElementById("restoreProductName").textContent = product.name;
    document.getElementById("restoreProductSKU").textContent = product.sku;
    document.getElementById("restoreProductImage").src = product.image;

    const restoreModal = new bootstrap.Modal(
        document.getElementById("restoreModal")
    );
    restoreModal.show();
}

// Show permanent delete modal
function permanentDeleteProduct(productId) {
    currentProductId = productId;
    const product = productData[productId];

    document.getElementById("deleteProductName").textContent = product.name;
    document.getElementById("deleteProductSKU").textContent = product.sku;
    document.getElementById("deleteProductImage").src = product.image;

    const deleteModal = new bootstrap.Modal(
        document.getElementById("deleteModal")
    );
    deleteModal.show();
}

// Show empty trash modal
function showEmptyTrashModal() {
    const emptyTrashModal = new bootstrap.Modal(
        document.getElementById("emptyTrashModal")
    );
    emptyTrashModal.show();
}

// Show bulk actions modal
function showBulkActionsModal() {
    const checkedBoxes = document.querySelectorAll(
        'tbody input[type="checkbox"]:checked'
    );
    if (checkedBoxes.length === 0) {
        showNotification("Vui lòng chọn ít nhất một sản phẩm", "warning");
        return;
    }

    const bulkActionsModal = new bootstrap.Modal(
        document.getElementById("bulkActionsModal")
    );
    bulkActionsModal.show();
}

// Confirm restore
function confirmRestore() {
    // Simulate API call
    setTimeout(() => {
        showNotification(
            `Đã khôi phục sản phẩm ${productData[currentProductId].name} thành công!`,
            "success"
        );

        // Remove row from table
        const row = document
            .querySelector(`input[value="${currentProductId}"]`)
            .closest("tr");
        row.style.opacity = "0.5";
        setTimeout(() => row.remove(), 300);

        // Close modal
        const restoreModal = bootstrap.Modal.getInstance(
            document.getElementById("restoreModal")
        );
        restoreModal.hide();

        // Update stats
        updateStats();
    }, 500);
}

// Confirm delete
function confirmDelete() {
    // Simulate API call
    setTimeout(() => {
        showNotification(
            `Đã xóa vĩnh viễn sản phẩm ${productData[currentProductId].name}!`,
            "success"
        );

        // Remove row from table
        const row = document
            .querySelector(`input[value="${currentProductId}"]`)
            .closest("tr");
        row.style.opacity = "0.5";
        setTimeout(() => row.remove(), 300);

        // Close modal
        const deleteModal = bootstrap.Modal.getInstance(
            document.getElementById("deleteModal")
        );
        deleteModal.hide();

        // Update stats
        updateStats();
    }, 500);
}

// Confirm empty trash
function confirmEmptyTrash() {
    // Simulate API call
    setTimeout(() => {
        showNotification("Đã làm trống thùng rác thành công!", "success");

        // Remove all rows
        const tbody = document.querySelector("tbody");
        tbody.innerHTML =
            '<tr><td colspan="9" class="text-center py-5" style="color: var(--text-secondary);">Thùng rác trống</td></tr>';

        // Close modal
        const emptyTrashModal = bootstrap.Modal.getInstance(
            document.getElementById("emptyTrashModal")
        );
        emptyTrashModal.hide();

        // Update stats to zero
        document.querySelectorAll(".stat-value").forEach((stat) => {
            stat.textContent = "0";
        });
    }, 500);
}

// Bulk restore
function bulkRestore() {
    const checkedBoxes = document.querySelectorAll(
        'tbody input[type="checkbox"]:checked'
    );
    const count = checkedBoxes.length;

    if (count === 0) {
        showNotification("Vui lòng chọn ít nhất một sản phẩm", "warning");
        return;
    }

    // Simulate API call
    setTimeout(() => {
        showNotification(
            `Đã khôi phục ${count} sản phẩm thành công!`,
            "success"
        );

        // Remove selected rows
        checkedBoxes.forEach((checkbox) => {
            const row = checkbox.closest("tr");
            row.style.opacity = "0.5";
            setTimeout(() => row.remove(), 300);
        });

        // Close modal
        const bulkActionsModal = bootstrap.Modal.getInstance(
            document.getElementById("bulkActionsModal")
        );
        bulkActionsModal.hide();

        // Update stats
        updateStats();
    }, 500);
}

// Bulk delete
function bulkDelete() {
    const checkedBoxes = document.querySelectorAll(
        'tbody input[type="checkbox"]:checked'
    );
    const count = checkedBoxes.length;

    if (count === 0) {
        showNotification("Vui lòng chọn ít nhất một sản phẩm", "warning");
        return;
    }

    if (
        !confirm(
            `Bạn có chắc chắn muốn xóa vĩnh viễn ${count} sản phẩm đã chọn? Hành động này không thể hoàn tác!`
        )
    ) {
        return;
    }

    // Simulate API call
    setTimeout(() => {
        showNotification(`Đã xóa vĩnh viễn ${count} sản phẩm!`, "success");

        // Remove selected rows
        checkedBoxes.forEach((checkbox) => {
            const row = checkbox.closest("tr");
            row.style.opacity = "0.5";
            setTimeout(() => row.remove(), 300);
        });

        // Close modal
        const bulkActionsModal = bootstrap.Modal.getInstance(
            document.getElementById("bulkActionsModal")
        );
        bulkActionsModal.hide();

        // Update stats
        updateStats();
    }, 500);
}

// Update statistics
function updateStats() {
    const remainingRows = document.querySelectorAll("tbody tr").length;
    document.querySelector(".stat-value").textContent = Math.max(
        0,
        remainingRows
    );
}

// Notification function
function showNotification(message, type = "info") {
    // Create notification element
    const notification = document.createElement("div");
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 400px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: none;
        animation: slideInRight 0.3s ease-out;
    `;

    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="bi bi-${
                type === "success"
                    ? "check-circle"
                    : type === "warning"
                    ? "exclamation-triangle"
                    : "info-circle"
            } me-2"></i>
            ${message}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Add slideInRight animation
const style = document.createElement("style");
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
`;
document.head.appendChild(style);
