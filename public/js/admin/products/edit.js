document.addEventListener("DOMContentLoaded", function () {
    // Store original values for change tracking
    const originalValues = {};
    const form = document.getElementById("editProductForm");
    const changesSummary = document.getElementById("changesSummary");
    const changesList = document.getElementById("changesList");

    // Store original form data
    function storeOriginalValues() {
        const formData = new FormData(form);
        for (let [key, value] of formData.entries()) {
            originalValues[key] = value;
        }

        // Store original tags
        originalValues.tags = Array.from(
            document.querySelectorAll(".tag-item.existing")
        ).map((tag) => tag.textContent.trim().replace("×", "").trim());

        // Store original images
        originalValues.existingImages = Array.from(
            document.querySelectorAll(".image-preview.existing img")
        ).map((img) => img.src);
    }

    // Track changes
    function trackChanges() {
        const changes = [];
        const currentFormData = new FormData(form);

        // Check form fields
        for (let [key, value] of currentFormData.entries()) {
            if (originalValues[key] && originalValues[key] !== value) {
                changes.push(
                    `${getFieldLabel(key)}: "${
                        originalValues[key]
                    }" → "${value}"`
                );
            }
        }

        // Check tags
        const currentTags = Array.from(
            document.querySelectorAll(".tag-item")
        ).map((tag) => tag.textContent.trim().replace("×", "").trim());
        if (
            JSON.stringify(originalValues.tags) !== JSON.stringify(currentTags)
        ) {
            changes.push("Tags đã được thay đổi");
        }

        // Check images
        const currentImages = Array.from(
            document.querySelectorAll(".image-preview img")
        ).map((img) => img.src);
        if (
            JSON.stringify(originalValues.existingImages) !==
            JSON.stringify(currentImages)
        ) {
            changes.push("Hình ảnh đã được thay đổi");
        }

        // Update UI
        if (changes.length > 0) {
            changesSummary.style.display = "block";
            changesList.innerHTML = changes
                .map((change) => `<li>${change}</li>`)
                .join("");
            showModificationIndicators(changes);
        } else {
            changesSummary.style.display = "none";
            hideAllModificationIndicators();
        }
    }

    function getFieldLabel(key) {
        const labels = {
            product_name: "Tên sản phẩm",
            product_sku: "Mã SKU",
            short_description: "Mô tả ngắn",
            description: "Mô tả chi tiết",
            regular_price: "Giá gốc",
            sale_price: "Giá khuyến mãi",
            cost_price: "Giá vốn",
            stock_quantity: "Số lượng tồn kho",
            low_stock_threshold: "Ngưỡng cảnh báo",
            weight: "Trọng lượng",
            category_id: "Danh mục",
            brand_id: "Thương hiệu",
        };
        return labels[key] || key;
    }

    function showModificationIndicators(changes) {
        // Logic to show indicators based on changed fields
        hideAllModificationIndicators();

        changes.forEach((change) => {
            if (
                change.includes("Tên sản phẩm") ||
                change.includes("Mô tả") ||
                change.includes("SKU")
            ) {
                document.getElementById("basicInfoIndicator").style.display =
                    "block";
            }
            if (change.includes("Giá")) {
                document.getElementById("pricingIndicator").style.display =
                    "block";
            }
            if (change.includes("Số lượng") || change.includes("Trọng lượng")) {
                document.getElementById("inventoryIndicator").style.display =
                    "block";
            }
            if (change.includes("Hình ảnh")) {
                document.getElementById("imagesIndicator").style.display =
                    "block";
            }
            if (change.includes("Danh mục") || change.includes("Tags")) {
                document.getElementById("categoriesIndicator").style.display =
                    "block";
            }
        });
    }

    function hideAllModificationIndicators() {
        document
            .querySelectorAll(".modification-indicator")
            .forEach((indicator) => {
                indicator.style.display = "none";
            });
    }

    // Initialize
    storeOriginalValues();

    // Form change listeners
    form.addEventListener("input", trackChanges);
    form.addEventListener("change", trackChanges);

    // Image Upload Handler (similar to create page)
    const imageUploadArea = document.getElementById("imageUploadArea");
    const productImages = document.getElementById("productImages");
    const newImagePreviewContainer = document.getElementById(
        "newImagePreviewContainer"
    );
    let newUploadedImages = [];

    imageUploadArea.addEventListener("click", function () {
        productImages.click();
    });

    productImages.addEventListener("change", function (e) {
        handleFiles(e.target.files);
    });

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

    function handleFiles(files) {
        Array.from(files).forEach((file) => {
            if (
                file.type.startsWith("image/") &&
                newUploadedImages.length < 5
            ) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    addNewImagePreview(e.target.result, file.name);
                    newUploadedImages.push(file);
                    trackChanges();
                };
                reader.readAsDataURL(file);
            }
        });
    }

    function addNewImagePreview(src, fileName) {
        const previewDiv = document.createElement("div");
        previewDiv.className = "image-preview";
        previewDiv.innerHTML = `
                    <img src="${src}" alt="${fileName}" class="preview-image">
                    <div class="image-status" style="background: rgba(245, 158, 11, 0.9);">Mới</div>
                    <button type="button" class="remove-image" onclick="removeNewImage(this)">
                        <i class="bi bi-x"></i>
                    </button>
                `;
        newImagePreviewContainer.appendChild(previewDiv);
    }

    // Remove new image
    window.removeNewImage = function (button) {
        const previewDiv = button.parentElement;
        const index = Array.from(newImagePreviewContainer.children).indexOf(
            previewDiv
        );
        newUploadedImages.splice(index, 1);
        previewDiv.remove();
        trackChanges();
    };

    // Remove existing image
    window.removeExistingImage = function (button) {
        if (confirm("Bạn có chắc chắn muốn xóa hình ảnh này?")) {
            button.parentElement.remove();
            trackChanges();
        }
    };

    // Tags functionality
    const tagsInput = document.getElementById("tags");
    const tagDisplay = document.getElementById("tagDisplay");
    let currentTags = Array.from(
        document.querySelectorAll(".tag-item.existing")
    ).map((tag) => tag.textContent.trim().replace("×", "").trim());

    tagsInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            const tagValue = this.value.trim();
            if (tagValue && !currentTags.includes(tagValue)) {
                addTag(tagValue, "new");
                this.value = "";
                trackChanges();
            }
        }
    });

    function addTag(tagValue, type = "existing") {
        currentTags.push(tagValue);
        const tagElement = document.createElement("span");
        tagElement.className = `tag-item ${type}`;
        tagElement.innerHTML = `
                    ${tagValue}
                    <button type="button" class="tag-remove" onclick="removeTag('${tagValue}', this)">
                        <i class="bi bi-x"></i>
                    </button>
                `;
        tagDisplay.appendChild(tagElement);
    }

    window.removeTag = function (tagValue, button) {
        const index = currentTags.indexOf(tagValue);
        if (index > -1) {
            currentTags.splice(index, 1);
        }
        button.parentElement.remove();
        trackChanges();
    };

    // Toggle switches
    const statusToggle = document.getElementById("statusToggle");
    const featuredToggle = document.getElementById("featuredToggle");
    const isActiveInput = document.getElementById("is_active");
    const isFeaturedInput = document.getElementById("is_featured");

    statusToggle.addEventListener("click", function () {
        this.classList.toggle("active");
        isActiveInput.value = this.classList.contains("active") ? "1" : "0";
        trackChanges();
    });

    featuredToggle.addEventListener("click", function () {
        this.classList.toggle("active");
        isFeaturedInput.value = this.classList.contains("active") ? "1" : "0";
        trackChanges();
    });

    // Price validation
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

    // Form actions
    const updateBtn = document.getElementById("updateBtn");
    const saveDraftBtn = document.getElementById("saveDraftBtn");
    const resetBtn = document.getElementById("resetBtn");

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        updateProduct();
    });

    saveDraftBtn.addEventListener("click", function () {
        saveDraft();
    });

    resetBtn.addEventListener("click", function () {
        if (
            confirm(
                "Bạn có chắc chắn muốn khôi phục về trạng thái ban đầu? Tất cả thay đổi sẽ bị mất."
            )
        ) {
            resetForm();
        }
    });

    function updateProduct() {
        updateBtn.disabled = true;
        updateBtn.innerHTML =
            '<i class="bi bi-hourglass-split"></i> Đang cập nhật...';

        // Simulate API call
        setTimeout(() => {
            alert("Cập nhật sản phẩm thành công!");
            storeOriginalValues(); // Update original values
            trackChanges(); // Re-check changes
            updateBtn.disabled = false;
            updateBtn.innerHTML =
                '<i class="bi bi-check-lg"></i> Cập Nhật Sản Phẩm';
        }, 2000);
    }

    function saveDraft() {
        saveDraftBtn.disabled = true;
        saveDraftBtn.innerHTML =
            '<i class="bi bi-hourglass-split"></i> Đang lưu...';

        setTimeout(() => {
            alert("Đã lưu nháp thành công!");
            saveDraftBtn.disabled = false;
            saveDraftBtn.innerHTML =
                '<i class="bi bi-file-earmark"></i> Lưu Nháp';
        }, 1500);
    }

    function resetForm() {
        // Reset form to original values
        location.reload(); // Simple way to reset everything
    }

    // Preview product function
    window.previewProduct = function () {
        window.open("/products/preview/1", "_blank");
    };

    // Utility functions
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

    // Prevent accidental page leave
    window.addEventListener("beforeunload", function (e) {
        if (changesSummary.style.display !== "none") {
            e.preventDefault();
            e.returnValue =
                "Bạn có thay đổi chưa được lưu. Bạn có chắc chắn muốn rời khỏi trang?";
        }
    });
});
