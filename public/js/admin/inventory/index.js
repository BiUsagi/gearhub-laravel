document.addEventListener("DOMContentLoaded", function () {
    // Update quantity function
    const quantityInputs = document.querySelectorAll(".quantity-input");

    quantityInputs.forEach((input) => {
        input.addEventListener("change", function () {
            const row = this.closest("tr");
            const quantity = parseInt(this.value);
            const statusCell = row.querySelector(".stock-level");

            // Update status based on quantity
            if (quantity === 0) {
                statusCell.className = "stock-level out";
                statusCell.textContent = "Hết hàng";
            } else if (quantity <= 5) {
                statusCell.className = "stock-level low";
                statusCell.textContent = "Sắp hết";
            } else if (quantity <= 15) {
                statusCell.className = "stock-level medium";
                statusCell.textContent = "Ít hàng";
            } else {
                statusCell.className = "stock-level high";
                statusCell.textContent = "Còn hàng";
            }

            // Show update notification
            showNotification("Đã cập nhật số lượng tồn kho!", "success");
        });
    });

    // Action button handlers
    document.querySelectorAll(".btn-primary").forEach((btn) => {
        if (btn.querySelector(".bi-pencil")) {
            btn.addEventListener("click", function () {
                showNotification("Chỉnh sửa thông tin sản phẩm", "info");
            });
        }
    });

    // Product Settings Modal Functions
    window.showProductSettingsModal = function (
        sku,
        name,
        currentStock,
        minStock,
        imageSrc
    ) {
        // Fill modal data
        document.getElementById("modalProductName").textContent = name;
        document.getElementById("modalProductSKU").textContent = `SKU: ${sku}`;
        document.getElementById("modalCurrentStock").textContent =
            currentStock + " chiếc";
        document.getElementById("modalMinStock").textContent =
            minStock + " chiếc";
        document.getElementById("currentQuantity").value = currentStock;
        document.getElementById("minQuantity").value = minStock;

        // Set product image
        const modalImage = document.getElementById("modalProductImage");
        if (imageSrc) {
            modalImage.src = imageSrc;
            modalImage.style.display = "block";
            modalImage.nextElementSibling.style.display = "none";
        } else {
            modalImage.style.display = "none";
            modalImage.nextElementSibling.style.display = "flex";
        }

        // Clear input fields
        document.getElementById("addQuantity").value = "";
        document.getElementById("removeQuantity").value = "";

        // Store current data
        window.currentProductData = {
            sku: sku,
            name: name,
            currentStock: parseInt(currentStock),
            minStock: parseInt(minStock),
        };

        // Show modal
        const modal = new bootstrap.Modal(
            document.getElementById("productSettingsModal")
        );
        modal.show();
    };

    // Quick add functions
    window.quickAdd = function (amount) {
        const currentQty =
            parseInt(document.getElementById("currentQuantity").value) || 0;
        const newQty = currentQty + amount;
        document.getElementById("currentQuantity").value = newQty;
        document.getElementById("modalCurrentStock").textContent =
            newQty + " chiếc";
        showNotification(`Đã thêm ${amount} sản phẩm vào kho`, "success");
    };

    window.addStock = function () {
        const addAmount =
            parseInt(document.getElementById("addQuantity").value) || 0;
        if (addAmount <= 0) {
            showNotification("Vui lòng nhập số lượng hợp lệ", "warning");
            return;
        }
        const currentQty =
            parseInt(document.getElementById("currentQuantity").value) || 0;
        const newQty = currentQty + addAmount;
        document.getElementById("currentQuantity").value = newQty;
        document.getElementById("modalCurrentStock").textContent =
            newQty + " chiếc";
        document.getElementById("addQuantity").value = "";
        showNotification(
            `Đã nhập thêm ${addAmount} sản phẩm vào kho`,
            "success"
        );
    };

    window.removeStock = function () {
        const removeAmount =
            parseInt(document.getElementById("removeQuantity").value) || 0;
        const currentQty =
            parseInt(document.getElementById("currentQuantity").value) || 0;

        if (removeAmount <= 0) {
            showNotification("Vui lòng nhập số lượng hợp lệ", "warning");
            return;
        }

        if (removeAmount > currentQty) {
            showNotification(
                "Không thể xuất nhiều hơn số lượng hiện có",
                "warning"
            );
            return;
        }

        const newQty = currentQty - removeAmount;
        document.getElementById("currentQuantity").value = newQty;
        document.getElementById("modalCurrentStock").textContent =
            newQty + " chiếc";
        document.getElementById("removeQuantity").value = "";
        showNotification(
            `Đã xuất ${removeAmount} sản phẩm khỏi kho`,
            "success"
        );
    };

    window.setMinStock = function () {
        const currentQty =
            parseInt(document.getElementById("currentQuantity").value) || 0;
        document.getElementById("minQuantity").value = currentQty;
        document.getElementById("modalMinStock").textContent =
            currentQty + " chiếc";
        showNotification("Đã đặt mức tối thiểu bằng số lượng hiện tại", "info");
    };

    window.zeroStock = function () {
        if (confirm("Bạn có chắc chắn muốn đặt số lượng về 0?")) {
            document.getElementById("currentQuantity").value = 0;
            document.getElementById("modalCurrentStock").textContent =
                "0 chiếc";
            showNotification("Đã đặt số lượng tồn kho về 0", "warning");
        }
    };

    window.saveSettings = function () {
        const newQty =
            parseInt(document.getElementById("currentQuantity").value) || 0;
        const newMinQty =
            parseInt(document.getElementById("minQuantity").value) || 0;
        const productData = window.currentProductData;

        // Update the table row
        const rows = document.querySelectorAll("tbody tr");
        rows.forEach((row) => {
            const skuCell = row.querySelector("td:nth-child(2) strong");
            if (skuCell && skuCell.textContent === productData.sku) {
                // Update quantity input
                const qtyInput = row.querySelector(".quantity-input");
                qtyInput.value = newQty;

                // Update min stock display
                const minStockSpan = row.querySelector(".min-stock");
                minStockSpan.textContent = newMinQty;

                // Update status
                const statusSpan = row.querySelector(".stock-level");
                if (newQty === 0) {
                    statusSpan.className = "stock-level out";
                    statusSpan.textContent = "Hết hàng";
                } else if (newQty <= newMinQty) {
                    statusSpan.className = "stock-level low";
                    statusSpan.textContent = "Sắp hết";
                } else if (newQty <= newMinQty * 2) {
                    statusSpan.className = "stock-level medium";
                    statusSpan.textContent = "Ít hàng";
                } else {
                    statusSpan.className = "stock-level high";
                    statusSpan.textContent = "Còn hàng";
                }
            }
        });

        // Close modal
        const modal = bootstrap.Modal.getInstance(
            document.getElementById("productSettingsModal")
        );
        modal.hide();

        showNotification("Đã lưu cài đặt sản phẩm thành công!", "success");
    };

    // Tab styling
    document.querySelectorAll("#settingsTabs .nav-link").forEach((tab) => {
        tab.addEventListener("click", function () {
            // Remove active styles from all tabs
            document
                .querySelectorAll("#settingsTabs .nav-link")
                .forEach((t) => {
                    t.style.color = "var(--text-secondary)";
                    t.style.borderBottom = "none";
                });

            // Add active style to clicked tab
            this.style.color = "var(--primary-color)";
            this.style.borderBottom = "3px solid var(--primary-color)";
        });
    });

    document.querySelectorAll(".btn-success").forEach((btn) => {
        btn.addEventListener("click", function () {
            showNotification("Nhập thêm kho cho sản phẩm", "success");
        });
    });

    document.querySelectorAll(".btn-warning").forEach((btn) => {
        btn.addEventListener("click", function () {
            showNotification("Cảnh báo: Sản phẩm sắp hết hàng!", "warning");
        });
    });

    // Filter handlers
    document
        .querySelector(".btn-primary")
        .addEventListener("click", function () {
            if (this.querySelector(".bi-search")) {
                showNotification("Đang tìm kiếm...", "info");
            }
        });

    document
        .querySelector(".btn-outline")
        .addEventListener("click", function () {
            if (this.querySelector(".bi-arrow-clockwise")) {
                // Reset all filters
                document
                    .querySelectorAll(".form-select, .form-control")
                    .forEach((element) => {
                        element.value = "";
                    });
                showNotification("Đã đặt lại tất cả bộ lọc", "info");
            }
        });

    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement("div");
        notification.className = "notification-toast";
        notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    min-width: 320px;
                    max-width: 400px;
                    padding: 1rem 1.25rem;
                    border-radius: 12px;
                    border: 1px solid;
                    font-size: 0.875rem;
                    font-weight: 500;
                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                    backdrop-filter: blur(10px);
                    transform: translateX(100%);
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                `;

        // Set colors based on type
        if (type === "success") {
            notification.style.background = "var(--bg-primary)";
            notification.style.borderColor = "#10b981";
            notification.style.color = "var(--text-primary)";
        } else if (type === "warning") {
            notification.style.background = "var(--bg-primary)";
            notification.style.borderColor = "#f59e0b";
            notification.style.color = "var(--text-primary)";
        } else {
            notification.style.background = "var(--bg-primary)";
            notification.style.borderColor = "#3b82f6";
            notification.style.color = "var(--text-primary)";
        }

        notification.innerHTML = `
                    <div style="
                        width: 32px;
                        height: 32px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-size: 1rem;
                        background: ${
                            type === "success"
                                ? "linear-gradient(135deg, #10b981, #059669)"
                                : type === "warning"
                                ? "linear-gradient(135deg, #f59e0b, #d97706)"
                                : "linear-gradient(135deg, #3b82f6, #2563eb)"
                        }
                    ">
                        <i class="bi bi-${
                            type === "success"
                                ? "check-circle-fill"
                                : type === "warning"
                                ? "exclamation-triangle-fill"
                                : "info-circle-fill"
                        }"></i>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 600; margin-bottom: 0.25rem; color: var(--text-primary);">
                            ${
                                type === "success"
                                    ? "Thành công!"
                                    : type === "warning"
                                    ? "Cảnh báo!"
                                    : "Thông báo"
                            }
                        </div>
                        <div style="color: var(--text-secondary); font-size: 0.8rem;">
                            ${message}
                        </div>
                    </div>
                    <button onclick="this.parentElement.remove()" style="
                        background: none;
                        border: none;
                        color: var(--text-secondary);
                        cursor: pointer;
                        font-size: 1.2rem;
                        padding: 0;
                        width: 24px;
                        height: 24px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        transition: all 0.2s ease;
                    " onmouseover="this.style.background='var(--bg-secondary)'; this.style.color='var(--text-primary)'" 
                       onmouseout="this.style.background='none'; this.style.color='var(--text-secondary)'">
                        <i class="bi bi-x"></i>
                    </button>
                `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = "translateX(0)";
        }, 100);

        // Auto remove after 4 seconds
        setTimeout(() => {
            notification.style.transform = "translateX(100%)";
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 300);
        }, 4000);
    }
});
