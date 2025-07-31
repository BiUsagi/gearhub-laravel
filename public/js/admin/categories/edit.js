document.addEventListener("DOMContentLoaded", function () {
    // Auto-generate slug from category name
    const nameInput = document.getElementById("categoryName");
    const slugInput = document.getElementById("categorySlug");

    nameInput.addEventListener("input", function () {
        const slug = generateSlug(this.value);
        slugInput.value = slug;
        updatePreview();
    });

    // Update description preview
    const descInput = document.getElementById("categoryDescription");
    descInput.addEventListener("input", updatePreview);

    // Update parent category preview
    const parentSelect = document.getElementById("parentCategory");
    parentSelect.addEventListener("change", updatePreview);

    // Update status preview
    const statusInputs = document.querySelectorAll('input[name="status"]');
    statusInputs.forEach((input) => {
        input.addEventListener("change", updatePreview);
    });

    // Character count for meta fields
    setupCharacterCount("metaTitle", 60);
    setupCharacterCount("metaDescription", 160);

    // Image upload preview
    const imageInput = document.getElementById("categoryImage");
    imageInput.addEventListener("change", handleImageUpload);

    // Form submission
    document
        .getElementById("editCategoryForm")
        .addEventListener("submit", handleFormSubmit);

    // Delete confirmation
    const confirmText = document.getElementById("confirmText");
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

    confirmText.addEventListener("input", function () {
        confirmDeleteBtn.disabled = this.value !== "XÓA DANH MỤC";
    });

    // Initialize preview
    updatePreview();
});

function generateSlug(text) {
    return text
        .toLowerCase()
        .replace(/[áàảãạâấầẩẫậăắằẳẵặ]/g, "a")
        .replace(/[éèẻẽẹêếềểễệ]/g, "e")
        .replace(/[íìỉĩị]/g, "i")
        .replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, "o")
        .replace(/[úùủũụưứừửữự]/g, "u")
        .replace(/[ýỳỷỹỵ]/g, "y")
        .replace(/đ/g, "d")
        .replace(/[^a-z0-9\s-]/g, "")
        .replace(/\s+/g, "-")
        .replace(/-+/g, "-")
        .trim("-");
}

function toggleIconPicker() {
    const picker = document.getElementById("iconPicker");
    picker.style.display = picker.style.display === "none" ? "block" : "none";
}

function selectIcon(iconClass) {
    const selectedIcon = document.getElementById("selectedIcon");
    const previewIcon = document.getElementById("previewIcon");
    const iconInput = document.getElementById("categoryIcon");

    selectedIcon.className = iconClass;
    previewIcon.className = iconClass;
    iconInput.value = iconClass;

    // Update active state
    document
        .querySelectorAll(".icon-option")
        .forEach((opt) => opt.classList.remove("active"));
    document
        .querySelector(`[data-icon="${iconClass}"]`)
        .classList.add("active");

    toggleIconPicker();
}

function toggleSection(sectionId) {
    const section = document.getElementById(sectionId);
    const toggle = document.getElementById(
        sectionId.replace("Section", "Toggle")
    );

    if (section.style.display === "none") {
        section.style.display = "block";
        toggle.className = "bi bi-chevron-up";
    } else {
        section.style.display = "none";
        toggle.className = "bi bi-chevron-down";
    }
}

function updatePreview() {
    const name =
        document.getElementById("categoryName").value || "Tên danh mục";
    const description =
        document.getElementById("categoryDescription").value ||
        "Mô tả danh mục sẽ hiển thị ở đây...";
    const parent = document.getElementById("parentCategory");
    const status = document.querySelector('input[name="status"]:checked').value;

    document.getElementById("previewName").textContent = name;
    document.getElementById("previewDescription").textContent = description;
    document.getElementById("previewParent").textContent = parent.value
        ? parent.options[parent.selectedIndex].text
        : "Danh mục gốc";

    const statusElement = document.getElementById("previewStatus");
    if (status === "active") {
        statusElement.innerHTML =
            '<i class="bi bi-check-circle"></i> Hoạt động';
        statusElement.className = "preview-status active";
    } else {
        statusElement.innerHTML = '<i class="bi bi-eye-slash"></i> Tạm ẩn';
        statusElement.className = "preview-status inactive";
    }
}

function setupCharacterCount(fieldId, maxLength) {
    const field = document.getElementById(fieldId);
    const counter = field.parentElement.querySelector(".char-count");

    field.addEventListener("input", function () {
        const count = this.value.length;
        counter.textContent = `${count}/${maxLength} ký tự`;

        if (count > maxLength * 0.9) {
            counter.style.color = "var(--warning-color)";
        } else {
            counter.style.color = "var(--text-secondary)";
        }
    });
}

function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const preview = document.getElementById("imagePreview");
            const img = document.getElementById("previewImg");
            const uploadContent = document.querySelector(".upload-content");

            img.src = e.target.result;
            preview.style.display = "block";
            uploadContent.style.display = "none";
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    const preview = document.getElementById("imagePreview");
    const uploadContent = document.querySelector(".upload-content");
    const imageInput = document.getElementById("categoryImage");

    preview.style.display = "none";
    uploadContent.style.display = "flex";
    imageInput.value = "";
}

function resetForm() {
    if (
        confirm(
            "Bạn có chắc chắn muốn đặt lại form? Tất cả dữ liệu đã nhập sẽ bị xóa."
        )
    ) {
        document.getElementById("editCategoryForm").reset();
        removeImage();
        document.getElementById("categoryIcon").value = "bi-phone";
        document.getElementById("selectedIcon").className = "bi bi-phone";
        document.getElementById("previewIcon").className = "bi bi-phone";
        updatePreview();
    }
}

function handleFormSubmit(event) {
    event.preventDefault();

    // Validation
    const name = document.getElementById("categoryName").value.trim();
    if (!name) {
        alert("Vui lòng nhập tên danh mục");
        return;
    }

    // Show loading state
    const submitBtn = event.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML =
        '<i class="bi bi-hourglass-split me-2"></i>Đang cập nhật...';
    submitBtn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        alert("Cập nhật danh mục thành công!");
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 2000);
}

// Icon picker functionality
document.addEventListener("click", function (event) {
    const iconPicker = document.getElementById("iconPicker");
    const selectedIcon = document.querySelector(".selected-icon");

    if (
        !selectedIcon.contains(event.target) &&
        !iconPicker.contains(event.target)
    ) {
        iconPicker.style.display = "none";
    }

    if (event.target.closest(".icon-option")) {
        const iconClass = event.target.closest(".icon-option").dataset.icon;
        selectIcon(iconClass);
    }
});
