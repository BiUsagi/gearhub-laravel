function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function () {
        // Show success notification
        showNotification("Đã sao chép đường dẫn!", "success");
    });
}

function deleteCategory(id) {
    if (confirm("Bạn có chắc chắn muốn xóa danh mục này?")) {
        // Handle delete
        showNotification("Danh mục đã được xóa!", "success");
    }
}

function showNotification(message, type) {
    // Simple notification
    alert(message);
}
