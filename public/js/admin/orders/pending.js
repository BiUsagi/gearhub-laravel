/* ===== PENDING ORDERS PAGE JAVASCRIPT ===== */

document.addEventListener("DOMContentLoaded", function () {
    // ===== ELEMENTS =====
    const selectAllCheckbox = document.getElementById("selectAllPending");
    const orderCheckboxes = document.querySelectorAll(".order-checkbox");
    const selectedCountDisplay = document.getElementById(
        "selectedCountDisplay"
    );
    const bulkActionsContainer = document.getElementById(
        "bulkActionsContainer"
    );
    const refreshBtn = document.getElementById("refreshBtn");
    const loadMoreBtn = document.getElementById("loadMoreBtn");
    const sortOrder = document.getElementById("sortOrder");

    // Modal elements
    const bulkActionModal = document.getElementById("bulkActionModal");
    const selectedOrdersCount = document.getElementById("selectedOrdersCount");
    const executeBulkAction = document.getElementById("executeBulkAction");

    // Action buttons
    const confirmButtons = document.querySelectorAll(".confirm-btn");
    const cancelButtons = document.querySelectorAll(".cancel-btn");
    const bulkConfirmBtn = document.getElementById("bulkConfirmBtn");
    const bulkCancelBtn = document.getElementById("bulkCancelBtn");
    const bulkPrintBtn = document.getElementById("bulkPrintBtn");

    // ===== SELECTION MANAGEMENT =====
    let selectedOrders = new Set();

    function updateSelectionUI() {
        const selectedCount = selectedOrders.size;
        selectedCountDisplay.textContent = selectedCount;
        selectedOrdersCount.textContent = selectedCount;

        // Show/hide bulk actions
        if (selectedCount > 0) {
            bulkActionsContainer.style.display = "flex";
        } else {
            bulkActionsContainer.style.display = "none";
        }

        // Update select all checkbox
        if (selectedCount === 0) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = false;
        } else if (selectedCount === orderCheckboxes.length) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = true;
        } else {
            selectAllCheckbox.indeterminate = true;
            selectAllCheckbox.checked = false;
        }
    }

    // Select all functionality
    selectAllCheckbox.addEventListener("change", function () {
        const isChecked = this.checked;
        orderCheckboxes.forEach((checkbox) => {
            checkbox.checked = isChecked;
            const orderId = checkbox.value;
            if (isChecked) {
                selectedOrders.add(orderId);
            } else {
                selectedOrders.delete(orderId);
            }
        });
        updateSelectionUI();
    });

    // Individual checkbox selection
    orderCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const orderId = this.value;
            if (this.checked) {
                selectedOrders.add(orderId);
            } else {
                selectedOrders.delete(orderId);
            }
            updateSelectionUI();
        });
    });

    // ===== INDIVIDUAL ORDER ACTIONS =====

    // Confirm individual order
    confirmButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const orderCard = this.closest(".order-card");
            const orderId = orderCard.dataset.orderId;
            confirmOrder(orderId, orderCard);
        });
    });

    // Cancel individual order
    cancelButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const orderCard = this.closest(".order-card");
            const orderId = orderCard.dataset.orderId;
            showCancelConfirmation(orderId, orderCard);
        });
    });

    function confirmOrder(orderId, orderCard) {
        // Add loading state
        orderCard.classList.add("loading");

        // Simulate API call
        setTimeout(() => {
            // Remove from pending list with animation
            orderCard.style.transform = "translateX(100%)";
            orderCard.style.opacity = "0";

            setTimeout(() => {
                orderCard.remove();
                updateStats();
                showNotification(
                    "Đơn hàng #" + orderId + " đã được xác nhận thành công!",
                    "success"
                );
            }, 300);
        }, 1000);
    }

    function showCancelConfirmation(orderId, orderCard) {
        if (confirm("Bạn có chắc chắn muốn hủy đơn hàng #" + orderId + "?")) {
            cancelOrder(orderId, orderCard);
        }
    }

    function cancelOrder(orderId, orderCard) {
        // Add loading state
        orderCard.classList.add("loading");

        // Simulate API call
        setTimeout(() => {
            // Remove from pending list with animation
            orderCard.style.transform = "translateX(-100%)";
            orderCard.style.opacity = "0";

            setTimeout(() => {
                orderCard.remove();
                updateStats();
                showNotification(
                    "Đơn hàng #" + orderId + " đã được hủy!",
                    "warning"
                );
            }, 300);
        }, 1000);
    }

    // ===== BULK ACTIONS =====

    bulkConfirmBtn.addEventListener("click", function () {
        if (selectedOrders.size === 0) {
            showNotification("Vui lòng chọn ít nhất một đơn hàng!", "warning");
            return;
        }

        if (confirm(`Xác nhận ${selectedOrders.size} đơn hàng đã chọn?`)) {
            executeBulkConfirm();
        }
    });

    bulkCancelBtn.addEventListener("click", function () {
        if (selectedOrders.size === 0) {
            showNotification("Vui lòng chọn ít nhất một đơn hàng!", "warning");
            return;
        }

        if (confirm(`Hủy ${selectedOrders.size} đơn hàng đã chọn?`)) {
            executeBulkCancel();
        }
    });

    bulkPrintBtn.addEventListener("click", function () {
        if (selectedOrders.size === 0) {
            showNotification("Vui lòng chọn ít nhất một đơn hàng!", "warning");
            return;
        }

        executeBulkPrint();
    });

    function executeBulkConfirm() {
        const orderCards = Array.from(selectedOrders).map((orderId) =>
            document.querySelector(`.order-card[data-order-id="${orderId}"]`)
        );

        orderCards.forEach((card) => card.classList.add("loading"));

        setTimeout(() => {
            orderCards.forEach((card) => {
                card.style.transform = "translateX(100%)";
                card.style.opacity = "0";
            });

            setTimeout(() => {
                orderCards.forEach((card) => card.remove());
                selectedOrders.clear();
                updateSelectionUI();
                updateStats();
                showNotification(
                    `Đã xác nhận ${orderCards.length} đơn hàng thành công!`,
                    "success"
                );
            }, 300);
        }, 1500);
    }

    function executeBulkCancel() {
        const orderCards = Array.from(selectedOrders).map((orderId) =>
            document.querySelector(`.order-card[data-order-id="${orderId}"]`)
        );

        orderCards.forEach((card) => card.classList.add("loading"));

        setTimeout(() => {
            orderCards.forEach((card) => {
                card.style.transform = "translateX(-100%)";
                card.style.opacity = "0";
            });

            setTimeout(() => {
                orderCards.forEach((card) => card.remove());
                selectedOrders.clear();
                updateSelectionUI();
                updateStats();
                showNotification(
                    `Đã hủy ${orderCards.length} đơn hàng!`,
                    "warning"
                );
            }, 300);
        }, 1500);
    }

    function executeBulkPrint() {
        showNotification(
            `Đang chuẩn bị in ${selectedOrders.size} đơn hàng...`,
            "info"
        );

        // Simulate print preparation
        setTimeout(() => {
            // Open print dialog or download PDF
            showNotification("File PDF đã được tạo và tải xuống!", "success");
        }, 2000);
    }

    // ===== MODAL BULK ACTION =====
    executeBulkAction.addEventListener("click", function () {
        const selectedAction = document.querySelector(
            'input[name="bulkAction"]:checked'
        );

        if (!selectedAction) {
            showNotification(
                "Vui lòng chọn hành động cần thực hiện!",
                "warning"
            );
            return;
        }

        const action = selectedAction.value;
        const modal = bootstrap.Modal.getInstance(bulkActionModal);
        modal.hide();

        switch (action) {
            case "confirm":
                executeBulkConfirm();
                break;
            case "cancel":
                if (confirm(`Hủy ${selectedOrders.size} đơn hàng đã chọn?`)) {
                    executeBulkCancel();
                }
                break;
            case "print":
                executeBulkPrint();
                break;
        }
    });

    // ===== STATS UPDATE =====
    function updateStats() {
        const currentTotalPending =
            document.querySelectorAll(".order-card").length;
        document.getElementById("totalPending").textContent =
            currentTotalPending;

        // Update other stats based on remaining orders
        const urgentOrders =
            document.querySelectorAll(".order-card.urgent").length;
        const todayOrders = document.querySelectorAll(".order-card").length; // Simplified
        const highValueOrders = document.querySelectorAll(
            ".order-card.high-value"
        ).length;

        document.getElementById("urgentCount").textContent = urgentOrders;
        document.getElementById("todayCount").textContent = Math.max(
            0,
            todayOrders
        );
        document.getElementById("highValueCount").textContent = highValueOrders;
    }

    // ===== REFRESH FUNCTIONALITY =====
    refreshBtn.addEventListener("click", function () {
        refreshBtn.disabled = true;
        refreshBtn.innerHTML =
            '<i class="bi bi-arrow-clockwise me-2"></i>Đang tải...';

        // Simulate refresh
        setTimeout(() => {
            location.reload();
        }, 1000);
    });

    // ===== LOAD MORE =====
    loadMoreBtn.addEventListener("click", function () {
        loadMoreBtn.disabled = true;
        loadMoreBtn.innerHTML =
            '<i class="bi bi-arrow-clockwise me-2"></i>Đang tải...';

        // Simulate loading more orders
        setTimeout(() => {
            // Add new order cards (simplified)
            showNotification("Đã tải thêm đơn hàng!", "info");
            loadMoreBtn.disabled = false;
            loadMoreBtn.innerHTML =
                '<i class="bi bi-arrow-down me-2"></i>Tải thêm đơn hàng';
        }, 1500);
    });

    // ===== SORTING =====
    sortOrder.addEventListener("change", function () {
        const order = this.value;
        const ordersGrid = document.getElementById("pendingOrdersGrid");
        const orderCards = Array.from(ordersGrid.children);

        // Add loading effect
        ordersGrid.style.opacity = "0.5";

        setTimeout(() => {
            // Sort cards based on selected order (simplified)
            switch (order) {
                case "newest":
                case "oldest":
                case "amount_desc":
                case "urgent":
                    // Simulate sorting
                    orderCards.forEach((card) => {
                        card.style.transform = "scale(0.95)";
                    });

                    setTimeout(() => {
                        orderCards.forEach((card) => {
                            card.style.transform = "scale(1)";
                        });
                        ordersGrid.style.opacity = "1";
                        showNotification("Đã sắp xếp lại danh sách!", "info");
                    }, 300);
                    break;
            }
        }, 500);
    });

    // ===== NOTIFICATION SYSTEM =====
    function showNotification(message, type = "info") {
        // Create notification element
        const notification = document.createElement("div");
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;

        notification.innerHTML = `
            ${message}
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

    // ===== REAL-TIME UPDATES =====
    function startRealTimeUpdates() {
        // Simulate real-time updates every 30 seconds
        setInterval(() => {
            // Update time ago displays
            updateTimeAgo();

            // Check for new pending orders
            if (Math.random() > 0.7) {
                // 30% chance
                showNotification("Có đơn hàng mới cần xử lý!", "warning");
                // Update badge count
                updateBadgeCount();
            }
        }, 30000);
    }

    function updateTimeAgo() {
        const timeElements = document.querySelectorAll(".time-ago");
        timeElements.forEach((element) => {
            // Update time display (simplified)
            const currentText = element.textContent;
            if (currentText.includes("phút")) {
                const minutes = parseInt(currentText);
                if (minutes < 60) {
                    element.textContent = `${minutes + 1} phút trước`;
                }
            }
        });
    }

    function updateBadgeCount() {
        const badge = document.querySelector(
            '.nav-link[href*="pending"] .badge'
        );
        if (badge) {
            const currentCount = parseInt(badge.textContent);
            badge.textContent = currentCount + 1;
        }
    }

    // ===== KEYBOARD SHORTCUTS =====
    document.addEventListener("keydown", function (e) {
        // Ctrl/Cmd + A: Select all
        if (
            (e.ctrlKey || e.metaKey) &&
            e.key === "a" &&
            !e.target.matches("input, textarea")
        ) {
            e.preventDefault();
            selectAllCheckbox.checked = true;
            selectAllCheckbox.dispatchEvent(new Event("change"));
        }

        // Escape: Clear selection
        if (e.key === "Escape") {
            selectedOrders.clear();
            orderCheckboxes.forEach((cb) => (cb.checked = false));
            updateSelectionUI();
        }

        // F5: Refresh
        if (e.key === "F5") {
            e.preventDefault();
            refreshBtn.click();
        }
    });

    // ===== INITIALIZATION =====

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll("[title]")
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Start real-time updates
    startRealTimeUpdates();

    // Initial stats update
    updateStats();

    console.log("✅ Pending Orders page initialized successfully");
});
