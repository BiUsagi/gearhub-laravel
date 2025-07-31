document.addEventListener("DOMContentLoaded", function () {
    // Initialize drag and drop
    initializeDragAndDrop();

    // Search functionality
    const searchInput = document.getElementById("searchTree");
    searchInput.addEventListener("input", searchCategories);

    // Filter functionality
    const filterStatus = document.getElementById("filterStatus");
    filterStatus.addEventListener("change", filterCategories);

    // Sort functionality
    const sortBy = document.getElementById("sortBy");
    sortBy.addEventListener("change", sortCategories);
});

// Toggle tree node
function toggleTreeNode(element) {
    const treeNode = element.closest(".tree-node");
    const children = treeNode.querySelector(".tree-children");
    const icon = element.querySelector("i");

    if (children) {
        if (children.style.display === "none") {
            children.style.display = "block";
            icon.className = "bi bi-chevron-down";
        } else {
            children.style.display = "none";
            icon.className = "bi bi-chevron-right";
        }
    }
}

// Expand all categories
function expandAllCategories() {
    const allChildren = document.querySelectorAll(".tree-children");
    const allToggles = document.querySelectorAll(".tree-toggle i");

    allChildren.forEach((child) => {
        child.style.display = "block";
    });

    allToggles.forEach((icon) => {
        icon.className = "bi bi-chevron-down";
    });
}

// Collapse all categories
function collapseAllCategories() {
    const allChildren = document.querySelectorAll(".tree-children");
    const allToggles = document.querySelectorAll(".tree-toggle i");

    allChildren.forEach((child) => {
        child.style.display = "none";
    });

    allToggles.forEach((icon) => {
        icon.className = "bi bi-chevron-right";
    });
}

// Search categories
function searchCategories() {
    const searchTerm = document
        .getElementById("searchTree")
        .value.toLowerCase();
    const nodes = document.querySelectorAll(".tree-node");

    nodes.forEach((node) => {
        const categoryName = node
            .querySelector(".category-name")
            .textContent.toLowerCase();
        const categorySlug = node
            .querySelector(".category-slug")
            .textContent.toLowerCase();

        if (
            categoryName.includes(searchTerm) ||
            categorySlug.includes(searchTerm) ||
            searchTerm === ""
        ) {
            node.style.display = "block";
            // Show parent nodes if child matches
            let parent = node.parentElement.closest(".tree-node");
            while (parent) {
                parent.style.display = "block";
                parent = parent.parentElement.closest(".tree-node");
            }
        } else {
            node.style.display = "none";
        }
    });
}

// Filter categories by status
function filterCategories() {
    const filterValue = document.getElementById("filterStatus").value;
    const nodes = document.querySelectorAll(".tree-node");

    nodes.forEach((node) => {
        if (filterValue === "") {
            node.style.display = "block";
        } else {
            const isActive = node
                .querySelector(".status-badge")
                .classList.contains("active");
            const shouldShow =
                (filterValue === "active" && isActive) ||
                (filterValue === "inactive" && !isActive);

            node.style.display = shouldShow ? "block" : "none";
        }
    });
}

// Sort categories
function sortCategories() {
    const sortValue = document.getElementById("sortBy").value;
    // Implementation would depend on backend sorting
    console.log("Sorting by:", sortValue);
}

// Toggle tree mode (list/tree view)
function toggleTreeMode() {
    const tree = document.getElementById("categoryTree");
    const icon = document.getElementById("treeModeIcon");

    if (tree.classList.contains("list-mode")) {
        tree.classList.remove("list-mode");
        icon.className = "bi bi-list-ul";
    } else {
        tree.classList.add("list-mode");
        icon.className = "bi bi-diagram-3";
    }
}

// Refresh tree
function refreshTree() {
    // Show loading state
    const tree = document.getElementById("categoryTree");
    tree.style.opacity = "0.5";

    // Simulate refresh
    setTimeout(() => {
        tree.style.opacity = "1";
        showNotification("Cây danh mục đã được làm mới!", "success");
    }, 1000);
}

// Category actions
function editCategory(categoryId) {
    showNotification(`Chỉnh sửa danh mục ID: ${categoryId}`, "info");
    // Redirect to edit page
    window.location.href = `/admin/categories/${categoryId}/edit`;
}

function addSubCategory(parentId) {
    showNotification(`Thêm danh mục con cho ID: ${parentId}`, "info");
    // Redirect to create page with parent
    window.location.href = `/admin/categories/create?parent=${parentId}`;
}

function viewProducts(categoryId) {
    showNotification(`Xem sản phẩm của danh mục ID: ${categoryId}`, "info");
    // Redirect to products filtered by category
    window.location.href = `/admin/products?category=${categoryId}`;
}

function deleteCategory(categoryId) {
    if (
        confirm(
            "Bạn có chắc chắn muốn xóa danh mục này? Hành động này không thể hoàn tác."
        )
    ) {
        showNotification(`Đã xóa danh mục ID: ${categoryId}`, "success");
        // Remove from DOM
        const node = document.querySelector(
            `[data-category-id="${categoryId}"]`
        );
        if (node) {
            node.remove();
        }
    }
}

function showAddCategoryModal() {
    // Redirect to create page
    window.location.href = "/admin/categories/create";
}

// Initialize drag and drop functionality
function initializeDragAndDrop() {
    // This would integrate with a drag-and-drop library like Sortable.js
    // For now, just add visual feedback
    const handles = document.querySelectorAll(".tree-handle");

    handles.forEach((handle) => {
        handle.addEventListener("mousedown", function () {
            this.closest(".tree-item").classList.add("dragging");
        });

        handle.addEventListener("mouseup", function () {
            this.closest(".tree-item").classList.remove("dragging");
        });
    });
}

// Notification function
function showNotification(message, type = "info") {
    const notification = document.createElement("div");
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = `
                top: 20px;
                right: 20px;
                z-index: 9999;
                max-width: 400px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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
