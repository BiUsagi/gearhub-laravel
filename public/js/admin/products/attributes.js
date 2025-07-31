document.addEventListener("DOMContentLoaded", function () {
    // Handle attribute type change
    document
        .getElementById("attributeType")
        .addEventListener("change", function () {
            const colorSection = document.getElementById("colorPickerSection");
            const defaultValuesContainer = document.getElementById(
                "defaultValuesContainer"
            );

            if (this.value === "color") {
                colorSection.style.display = "block";
                defaultValuesContainer.style.display = "none";
            } else {
                colorSection.style.display = "none";
                defaultValuesContainer.style.display = "block";
            }
        });

    // Handle adding values from input
    document.querySelectorAll(".add-value-form").forEach((form) => {
        const input = form.querySelector("input");
        const button = form.querySelector("button");

        button.addEventListener("click", function () {
            const value = input.value.trim();
            if (value) {
                addValueTag(value, form.parentElement);
                input.value = "";
            }
        });

        input.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                button.click();
            }
        });
    });
});

function addValueTag(value, container) {
    const valuesDiv = container.querySelector(".attribute-values");
    const tag = document.createElement("span");
    tag.className = "value-tag";
    tag.innerHTML = `${value} <i class="bi bi-x" onclick="removeValueTag(this)" style="cursor: pointer; margin-left: 0.25rem;"></i>`;
    valuesDiv.appendChild(tag);
    showNotification(`Đã thêm giá trị "${value}"`, "success");
}

function removeValueTag(element) {
    const tag = element.parentElement;
    const value = tag.textContent.trim();
    tag.remove();
    showNotification(`Đã xóa giá trị "${value}"`, "info");
}

function selectColor(element) {
    // Remove previous selection
    document.querySelectorAll(".color-option").forEach((option) => {
        option.classList.remove("selected");
    });

    // Add selection to clicked element
    element.classList.add("selected");

    // Store selected color
    const color = element.getAttribute("data-color");
    element.setAttribute("data-selected", "true");

    showNotification(`Đã chọn màu ${color}`, "success");
}

function addDefaultValue() {
    const input = document.querySelector("#defaultValuesContainer input");
    const value = input.value.trim();

    if (value) {
        const valuesList = document.getElementById("valuesList");
        const tag = document.createElement("span");
        tag.className = "value-tag";
        tag.innerHTML = `${value} <i class="bi bi-x" onclick="removeValueTag(this)" style="cursor: pointer; margin-left: 0.25rem;"></i>`;
        valuesList.appendChild(tag);
        input.value = "";
        showNotification(`Đã thêm giá trị "${value}"`, "success");
    }
}

function createAttribute() {
    const name = document.getElementById("attributeName").value.trim();
    const type = document.getElementById("attributeType").value;
    const description = document
        .getElementById("attributeDescription")
        .value.trim();

    if (!name || !type) {
        showNotification("Vui lòng điền đầy đủ thông tin bắt buộc", "warning");
        return;
    }

    // Collect values
    let values = [];
    if (type === "color") {
        const selectedColors = document.querySelectorAll(
            ".color-option.selected"
        );
        values = Array.from(selectedColors).map((color) =>
            color.getAttribute("data-color")
        );
    } else {
        const valueTags = document.querySelectorAll("#valuesList .value-tag");
        values = Array.from(valueTags).map((tag) =>
            tag.textContent.replace("×", "").trim()
        );
    }

    // Here you would typically send the data to the server
    console.log("Creating attribute:", {
        name,
        type,
        description,
        values,
    });

    // Close modal and show success message
    const modal = bootstrap.Modal.getInstance(
        document.getElementById("createAttributeModal")
    );
    modal.hide();

    showNotification(`Đã tạo thuộc tính "${name}" thành công!`, "success");

    // Reset form
    document.getElementById("createAttributeForm").reset();
    document.getElementById("valuesList").innerHTML = "";
    document.querySelectorAll(".color-option").forEach((option) => {
        option.classList.remove("selected");
    });
}

function editAttribute(attributeId) {
    showNotification(`Chỉnh sửa thuộc tính ${attributeId}`, "info");
    // Implement edit functionality
}

function addValue(attributeId) {
    showNotification(`Thêm giá trị cho thuộc tính ${attributeId}`, "info");
    // Implement add value functionality
}

function deleteAttribute(attributeId) {
    if (confirm("Bạn có chắc chắn muốn xóa thuộc tính này?")) {
        showNotification(`Đã xóa thuộc tính ${attributeId}`, "warning");
        // Implement delete functionality
    }
}

function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement("div");
    notification.className = `alert alert-${type} position-fixed`;
    notification.style.cssText = `
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                opacity: 0;
                transform: translateX(100%);
                transition: all 0.3s ease;
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
                    <span>${message}</span>
                </div>
            `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.style.opacity = "1";
        notification.style.transform = "translateX(0)";
    }, 100);

    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.style.opacity = "0";
        notification.style.transform = "translateX(100%)";
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}
