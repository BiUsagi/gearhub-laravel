document.addEventListener("DOMContentLoaded", function () {
    // Select All Checkbox Functionality - Chức năng chọn tất cả checkbox
    const selectAllCheckbox = document.querySelector(
        'thead input[type="checkbox"]'
    );
    const rowCheckboxes = document.querySelectorAll(
        'tbody input[type="checkbox"]'
    );

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener("change", function () {
            rowCheckboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    }

    // Individual checkbox change - Thay đổi checkbox riêng lẻ
    rowCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const checkedCount = document.querySelectorAll(
                'tbody input[type="checkbox"]:checked'
            ).length;
            selectAllCheckbox.checked = checkedCount === rowCheckboxes.length;
            selectAllCheckbox.indeterminate =
                checkedCount > 0 && checkedCount < rowCheckboxes.length;
        });
    });

    // Filter functionality - Chức năng lọc
    const categoryFilter = document.querySelector(
        ".filter-select:first-of-type"
    );
    const statusFilter = document.querySelector(".filter-select:last-of-type");
    const searchInput = document.querySelector(".filter-input");

    function filterProducts() {
        const categoryValue = categoryFilter?.value.toLowerCase() || "";
        const statusValue = statusFilter?.value.toLowerCase() || "";
        const searchValue = searchInput?.value.toLowerCase() || "";

        const rows = document.querySelectorAll("tbody tr");

        rows.forEach((row) => {
            const categoryCell = row
                .querySelector("td:nth-child(3)")
                .textContent.toLowerCase();
            const productName = row
                .querySelector(".product-details h6")
                .textContent.toLowerCase();
            const statusCell = row
                .querySelector(".status-badge")
                .textContent.toLowerCase();

            const matchesCategory =
                !categoryValue || categoryCell.includes(categoryValue);
            const matchesStatus =
                !statusValue || statusCell.includes(statusValue);
            const matchesSearch =
                !searchValue || productName.includes(searchValue);

            if (matchesCategory && matchesStatus && matchesSearch) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    // Add event listeners for filters - Thêm event listeners cho bộ lọc
    categoryFilter?.addEventListener("change", filterProducts);
    statusFilter?.addEventListener("change", filterProducts);
    searchInput?.addEventListener("input", filterProducts);

    // Action button handlers - Xử lý các nút thao tác
    document.addEventListener("click", function (e) {
        if (e.target.closest(".btn-view")) {
            const productName = e.target
                .closest("tr")
                .querySelector(".product-details h6").textContent;
            alert(`Xem chi tiết sản phẩm: ${productName}`);
        }

        if (e.target.closest(".btn-edit")) {
            const productName = e.target
                .closest("tr")
                .querySelector(".product-details h6").textContent;
            alert(`Chỉnh sửa sản phẩm: ${productName}`);
        }

        if (e.target.closest(".btn-delete")) {
            const productName = e.target
                .closest("tr")
                .querySelector(".product-details h6").textContent;
            if (
                confirm(`Bạn có chắc chắn muốn xóa sản phẩm: ${productName}?`)
            ) {
                e.target.closest("tr").remove();
            }
        }
    });

    // Add product button - Nút thêm sản phẩm
    const addProductBtn = document.querySelector(".btn-primary");
    addProductBtn?.addEventListener("click", function () {
        alert("Chuyển đến trang thêm sản phẩm mới");
    });

    // Export Excel button - Nút xuất Excel
    const exportBtn = document.querySelector(".btn-outline-primary");
    exportBtn?.addEventListener("click", function () {
        alert("Đang xuất danh sách sản phẩm ra file Excel...");
    });
});
