document.addEventListener("DOMContentLoaded", function () {
    // Image Upload Handler - Xử lý upload hình ảnh
    const imageUploadArea = document.getElementById("imageUploadArea");
    const productImages = document.getElementById("productImages");
    const imagePreviewContainer = document.getElementById(
        "imagePreviewContainer"
    );
    let uploadedImages = [];

    // Click to select files - Click để chọn file
    imageUploadArea.addEventListener("click", function () {
        productImages.click();
    });

    // File input change - Thay đổi file input
    productImages.addEventListener("change", function (e) {
        handleFiles(e.target.files);
    });

    // Drag and drop functionality - Chức năng kéo thả
    imageUploadArea.addEventListener("dragover", function (e) {
        e.preventDefault();
        imageUploadArea.classList.add("dragover");
    });

    imageUploadArea.addEventListener("dragleave", function (e) {
        e.preventDefault();
        imageUploadArea.classList.remove("dragover");
    });

    imageUploadArea.addEventListener("drop", function (e) {
        e.preventDefault();
        imageUploadArea.classList.remove("dragover");
        handleFiles(e.dataTransfer.files);
    });

    // Handle uploaded files - Xử lý file đã upload
    function handleFiles(files) {
        Array.from(files).forEach((file) => {
            if (file.type.startsWith("image/") && uploadedImages.length < 10) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    addImagePreview(e.target.result, file.name);
                    uploadedImages.push(file);
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Add image preview - Thêm preview hình ảnh
    function addImagePreview(src, fileName) {
        const previewDiv = document.createElement("div");
        previewDiv.className = "image-preview";
        previewDiv.innerHTML = `
            <img src="${src}" alt="${fileName}" class="preview-image">
            <button type="button" class="remove-image" onclick="removeImage(this)">
                <i class="bi bi-x"></i>
            </button>
        `;
        imagePreviewContainer.appendChild(previewDiv);
    }

    // Remove image - Xóa hình ảnh
    window.removeImage = function (button) {
        const previewDiv = button.parentElement;
        const index = Array.from(imagePreviewContainer.children).indexOf(
            previewDiv
        );
        uploadedImages.splice(index, 1);
        previewDiv.remove();
    };

    // Tags functionality - Chức năng tags
    const tagsInput = document.getElementById("tags");
    const tagDisplay = document.getElementById("tagDisplay");
    let tags = [];

    tagsInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            const tagValue = this.value.trim();
            if (tagValue && !tags.includes(tagValue)) {
                addTag(tagValue);
                this.value = "";
            }
        }
    });

    // Add tag - Thêm tag
    function addTag(tagValue) {
        tags.push(tagValue);
        const tagElement = document.createElement("span");
        tagElement.className = "tag-item";
        tagElement.innerHTML = `
            ${tagValue}
            <button type="button" class="tag-remove" onclick="removeTag('${tagValue}', this)">
                <i class="bi bi-x"></i>
            </button>
        `;
        tagDisplay.appendChild(tagElement);
    }

    // Remove tag - Xóa tag
    window.removeTag = function (tagValue, button) {
        const index = tags.indexOf(tagValue);
        if (index > -1) {
            tags.splice(index, 1);
        }
        button.parentElement.remove();
    };

    // Toggle switches - Các nút toggle
    const statusToggle = document.getElementById("statusToggle");
    const featuredToggle = document.getElementById("featuredToggle");
    const isActiveInput = document.getElementById("is_active");
    const isFeaturedInput = document.getElementById("is_featured");

    statusToggle.addEventListener("click", function () {
        this.classList.toggle("active");
        isActiveInput.value = this.classList.contains("active") ? "1" : "0";
    });

    featuredToggle.addEventListener("click", function () {
        this.classList.toggle("active");
        isFeaturedInput.value = this.classList.contains("active") ? "1" : "0";
    });

    // Price validation - Kiểm tra giá
    const regularPrice = document.getElementById("regular_price");
    const salePrice = document.getElementById("sale_price");

    salePrice.addEventListener("input", function () {
        const regular = parseFloat(regularPrice.value) || 0;
        const sale = parseFloat(this.value) || 0;

        if (sale > 0 && sale >= regular) {
            this.classList.add("error");
            showError(this, "Giá khuyến mãi phải nhỏ hơn giá gốc");
        } else {
            this.classList.remove("error");
            hideError(this);
        }
    });

    // Form submission - Gửi form
    const createProductForm = document.getElementById("createProductForm");
    const submitBtn = document.getElementById("submitBtn");
    const saveDraftBtn = document.getElementById("saveDraftBtn");

    createProductForm.addEventListener("submit", function (e) {
        e.preventDefault();
        submitForm(false); // false = không phải draft
    });

    saveDraftBtn.addEventListener("click", function () {
        submitForm(true); // true = lưu draft
    });

    // Submit form function - Hàm gửi form
    function submitForm(isDraft) {
        const formData = new FormData(createProductForm);

        // Add tags - Thêm tags
        formData.append("tags", JSON.stringify(tags));

        // Add images - Thêm hình ảnh
        uploadedImages.forEach((file, index) => {
            formData.append(`images[${index}]`, file);
        });

        // Add draft status - Thêm trạng thái draft
        formData.append("is_draft", isDraft ? "1" : "0");

        // Disable buttons - Vô hiệu hóa nút
        submitBtn.disabled = true;
        saveDraftBtn.disabled = true;

        // Show loading - Hiển thị loading
        if (isDraft) {
            saveDraftBtn.innerHTML =
                '<i class="bi bi-hourglass-split"></i> Đang lưu...';
        } else {
            submitBtn.innerHTML =
                '<i class="bi bi-hourglass-split"></i> Đang tạo...';
        }

        // Simulate API call - Mô phỏng gọi API
        setTimeout(() => {
            if (isDraft) {
                alert("Đã lưu nháp thành công!");
                saveDraftBtn.innerHTML =
                    '<i class="bi bi-file-earmark"></i> Lưu Nháp';
            } else {
                alert("Tạo sản phẩm thành công!");
                // Redirect to products list - Chuyển hướng đến danh sách sản phẩm
                window.location.href = "/admin/products";
            }

            // Re-enable buttons - Kích hoạt lại nút
            submitBtn.disabled = false;
            saveDraftBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-check-lg"></i> Tạo Sản Phẩm';
        }, 2000);
    }

    // Error handling functions - Hàm xử lý lỗi
    function showError(element, message) {
        hideError(element);
        const errorDiv = document.createElement("div");
        errorDiv.className = "error-message";
        errorDiv.textContent = message;
        element.parentNode.appendChild(errorDiv);
    }

    function hideError(element) {
        const errorMessage = element.parentNode.querySelector(".error-message");
        if (errorMessage) {
            errorMessage.remove();
        }
    }

    // Auto-generate SKU - Tự động tạo SKU
    const productName = document.getElementById("product_name");
    const productSku = document.getElementById("product_sku");

    productName.addEventListener("input", function () {
        if (!productSku.value) {
            const sku = generateSKU(this.value);
            productSku.value = sku;
        }
    });

    function generateSKU(name) {
        // Simple SKU generation - Tạo SKU đơn giản
        return (
            name
                .replace(/[^a-zA-Z0-9\s]/g, "")
                .trim()
                .split(" ")
                .map((word) => word.charAt(0).toUpperCase())
                .join("") +
            "-" +
            Date.now().toString().slice(-4)
        );
    }

    // Format price inputs - Định dạng input giá
    document
        .querySelectorAll('input[type="number"][step="1000"]')
        .forEach((input) => {
            input.addEventListener("input", function () {
                // Add thousand separators for display - Thêm dấu phân cách hàng nghìn
                // This is just for UX, actual value remains unchanged
            });
        });
});
