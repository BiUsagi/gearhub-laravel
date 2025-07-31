document.addEventListener("DOMContentLoaded", function () {
    // Import functionality
    const importUploadArea = document.getElementById("importUploadArea");
    const importFile = document.getElementById("importFile");
    const importFileInfo = document.getElementById("importFileInfo");
    const importFileName = document.getElementById("importFileName");
    const importFileDetails = document.getElementById("importFileDetails");
    const startImportBtn = document.getElementById("startImport");
    const importProgress = document.getElementById("importProgress");
    const importProgressFill = document.getElementById("importProgressFill");

    // Export functionality
    const startExportBtn = document.getElementById("startExport");
    const exportProgress = document.getElementById("exportProgress");
    const exportProgressFill = document.getElementById("exportProgressFill");

    // Import drag & drop
    importUploadArea.addEventListener("click", () => importFile.click());

    importUploadArea.addEventListener("dragover", (e) => {
        e.preventDefault();
        importUploadArea.classList.add("dragover");
    });

    importUploadArea.addEventListener("dragleave", () => {
        importUploadArea.classList.remove("dragover");
    });

    importUploadArea.addEventListener("drop", (e) => {
        e.preventDefault();
        importUploadArea.classList.remove("dragover");
        handleImportFile(e.dataTransfer.files[0]);
    });

    importFile.addEventListener("change", (e) => {
        handleImportFile(e.target.files[0]);
    });

    function handleImportFile(file) {
        if (!file) return;

        const allowedTypes = [
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "application/vnd.ms-excel",
            "text/csv",
        ];

        if (!allowedTypes.includes(file.type)) {
            showAlert(
                "error",
                "Chỉ hỗ trợ file Excel (.xlsx, .xls) và CSV (.csv)"
            );
            return;
        }

        importFileName.textContent = file.name;
        importFileDetails.textContent = `Kích thước: ${formatFileSize(
            file.size
        )} • Loại: ${file.type.split("/").pop().toUpperCase()}`;
        importFileInfo.classList.add("show");
        startImportBtn.disabled = false;
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return "0 Bytes";
        const k = 1024;
        const sizes = ["Bytes", "KB", "MB", "GB"];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
    }

    // Start import
    startImportBtn.addEventListener("click", function () {
        if (!importFile.files[0]) return;

        this.disabled = true;
        this.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang xử lý...';

        importProgress.style.display = "block";
        simulateProgress(importProgressFill, () => {
            showAlert(
                "success",
                "Import thành công! Đã thêm 156 sản phẩm mới."
            );
            this.disabled = false;
            this.innerHTML = '<i class="bi bi-play-fill"></i> Bắt đầu Import';
            importProgress.style.display = "none";

            // Reset form
            importFileInfo.classList.remove("show");
            importFile.value = "";
            this.disabled = true;
        });
    });

    // Start export
    startExportBtn.addEventListener("click", function () {
        this.disabled = true;
        this.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang xuất...';

        exportProgress.style.display = "block";
        simulateProgress(exportProgressFill, () => {
            showAlert("success", "Export thành công! File đã được tải xuống.");
            this.disabled = false;
            this.innerHTML = '<i class="bi bi-download"></i> Xuất Dữ Liệu';
            exportProgress.style.display = "none";

            // Simulate download
            downloadFile("products_export.xlsx");
        });
    });

    function simulateProgress(progressElement, callback) {
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
                setTimeout(callback, 500);
            }
            progressElement.style.width = progress + "%";
        }, 200);
    }

    function showAlert(type, message) {
        const alertDiv = document.createElement("div");
        alertDiv.className = `alert alert-${type} show`;
        alertDiv.innerHTML = `
                    <i class="bi bi-${
                        type === "success"
                            ? "check-circle"
                            : type === "error"
                            ? "x-circle"
                            : "exclamation-triangle"
                    }"></i>
                    ${message}
                `;

        document
            .querySelector(".section-body")
            .insertBefore(alertDiv, document.querySelector(".upload-area"));

        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }

    function downloadFile(filename) {
        // Simulate file download
        const link = document.createElement("a");
        link.href = "#";
        link.download = filename;
        link.click();
    }

    // Global functions
    window.downloadTemplate = function () {
        showAlert("success", "Template đã được tải xuống!");
        downloadFile("product_import_template.xlsx");
    };

    window.validateFile = function () {
        if (!importFile.files[0]) {
            showAlert("warning", "Vui lòng chọn file trước khi kiểm tra");
            return;
        }
        showAlert("success", "File hợp lệ! Có thể import 156 sản phẩm.");
    };

    window.previewExport = function () {
        const modal = document.createElement("div");
        modal.style.cssText = `
                    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                    background: rgba(0,0,0,0.5); z-index: 9999; display: flex;
                    align-items: center; justify-content: center;
                `;
        modal.innerHTML = `
                    <div style="background: var(--bg-primary); padding: 2rem; border-radius: 12px; max-width: 80%; max-height: 80%; overflow-y: auto;">
                        <h3 style="color: var(--text-primary); margin-bottom: 1rem;">Xem trước dữ liệu xuất</h3>
                        <p style="color: var(--text-secondary);">Sẽ xuất 1,247 sản phẩm với các trường đã chọn</p>
                        <button onclick="this.parentElement.parentElement.remove()" 
                                style="background: var(--primary-color); color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; margin-top: 1rem;">
                            Đóng
                        </button>
                    </div>
                `;
        document.body.appendChild(modal);
    };
});
