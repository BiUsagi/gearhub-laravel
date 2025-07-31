document.addEventListener("DOMContentLoaded", function () {
    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById("selectAll");
    const categoryCheckboxes = document.querySelectorAll(
        'tbody input[type="checkbox"]'
    );

    selectAllCheckbox.addEventListener("change", function () {
        categoryCheckboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    // Individual checkbox change
    categoryCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const checkedBoxes = document.querySelectorAll(
                'tbody input[type="checkbox"]:checked'
            );
            selectAllCheckbox.checked =
                checkedBoxes.length === categoryCheckboxes.length;
            selectAllCheckbox.indeterminate =
                checkedBoxes.length > 0 &&
                checkedBoxes.length < categoryCheckboxes.length;
        });
    });
});

// Delete category function
function deleteCategory(categoryId) {
    if (
        confirm(
            "Bạn có chắc chắn muốn xóa danh mục này? Hành động này không thể hoàn tác!"
        )
    ) {
        // Here you would normally make an AJAX call to delete the category
        alert(`Đang xóa danh mục ID: ${categoryId}`);
        // For demo purposes, you could remove the row from the table
        // const row = document.querySelector(`input[value="${categoryId}"]`).closest('tr');
        // row.remove();
    }
}
