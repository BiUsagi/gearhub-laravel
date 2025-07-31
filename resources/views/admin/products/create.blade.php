@extends('admin.layouts.app')

@section('title', 'Thêm Sản Phẩm Mới - GearHub Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/products/create.css') }}">
@endpush



@section('content')
<div class="create-product-container p-3">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/products">Sản Phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
        </ol>
    </nav>
    {{-- Page Header --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Thêm Sản Phẩm Mới</h1>
                <p class="page-subtitle">Tạo sản phẩm mới cho cửa hàng điện tử GearHub</p>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                    <i class="bi bi-arrow-left"></i>
                    Quay lại
                </button>
            </div>
        </div>
    </div>

    {{-- Form Container --}}
    <form id="createProductForm" enctype="multipart/form-data">
        <div class="form-container">
            {{-- Left Column --}}
            <div class="left-column">
                {{-- Basic Information --}}
                <div class="form-section mb-3">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="bi bi-info-circle"></i>
                            Thông Tin Cơ Bản
                        </h3>
                    </div>
                    <div class="section-body">
                        <div class="form-group">
                            <label class="form-label" for="product_name">
                                Tên Sản Phẩm <span class="required">*</span>
                            </label>
                            <input type="text" id="product_name" name="product_name" class="form-control"
                                placeholder="Nhập tên sản phẩm..." required>
                            <div class="form-text">Tên sản phẩm sẽ hiển thị cho khách hàng</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="product_sku">
                                Mã Sản Phẩm (SKU) <span class="required">*</span>
                            </label>
                            <input type="text" id="product_sku" name="product_sku" class="form-control"
                                placeholder="Ví dụ: IP15P-128-TI" required>
                            <div class="form-text">Mã định danh duy nhất cho sản phẩm</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="short_description">
                                Mô Tả Ngắn
                            </label>
                            <textarea id="short_description" name="short_description" class="form-control textarea-resize" rows="3"
                                placeholder="Mô tả ngắn gọn về sản phẩm..."></textarea>
                            <div class="form-text">Mô tả ngắn hiển thị trong danh sách sản phẩm</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="description">
                                Mô Tả Chi Tiết
                            </label>
                            <textarea id="description" name="description" class="form-control textarea-resize" rows="6"
                                placeholder="Mô tả chi tiết về sản phẩm, tính năng, thông số kỹ thuật..."></textarea>
                            <div class="form-text">Mô tả chi tiết hiển thị trên trang sản phẩm</div>
                        </div>
                    </div>
                </div>

                {{-- Pricing --}}
                <div class="form-section mb-3">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="bi bi-currency-dollar"></i>
                            Giá Cả & Khuyến Mãi
                        </h3>
                    </div>
                    <div class="section-body">
                        <div class="price-input-group">
                            <div class="form-group">
                                <label class="form-label" for="regular_price">
                                    Giá Gốc <span class="required">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" id="regular_price" name="regular_price"
                                        class="form-control input-with-icon" placeholder="0" min="0"
                                        step="1000" required>
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="sale_price">
                                    Giá Khuyến Mãi
                                </label>
                                <div class="input-group">
                                    <input type="number" id="sale_price" name="sale_price"
                                        class="form-control input-with-icon" placeholder="0" min="0"
                                        step="1000">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="cost_price">
                                Giá Vốn
                            </label>
                            <div class="input-group">
                                <input type="number" id="cost_price" name="cost_price"
                                    class="form-control input-with-icon" placeholder="0" min="0" step="1000">
                                <span class="input-group-text">VNĐ</span>
                            </div>
                            <div class="form-text">Giá nhập hàng (không hiển thị cho khách hàng)</div>
                        </div>
                    </div>
                </div>

                {{-- Inventory  --}}
                <div class="form-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="bi bi-box-seam"></i>
                            Quản Lý Kho
                        </h3>
                    </div>
                    <div class="section-body">
                        <div class="inventory-grid">
                            <div class="form-group">
                                <label class="form-label" for="stock_quantity">
                                    Số Lượng Tồn Kho <span class="required">*</span>
                                </label>
                                <input type="number" id="stock_quantity" name="stock_quantity" class="form-control"
                                    placeholder="0" min="0" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="low_stock_threshold">
                                    Ngưỡng Cảnh Báo
                                </label>
                                <input type="number" id="low_stock_threshold" name="low_stock_threshold"
                                    class="form-control" placeholder="10" min="0" value="10">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="weight">
                                    Trọng Lượng (gram)
                                </label>
                                <input type="number" id="weight" name="weight" class="form-control"
                                    placeholder="0" min="0" step="0.1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="right-column">
                {{-- Product Images --}}
                <div class="form-section mb-3">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="bi bi-images"></i>
                            Hình Ảnh Sản Phẩm
                        </h3>
                    </div>
                    <div class="section-body">
                        <div class="image-upload-area" id="imageUploadArea">
                            <div class="upload-icon">
                                <i class="bi bi-cloud-upload"></i>
                            </div>
                            <div class="upload-text">Kéo thả hình ảnh vào đây</div>
                            <div class="upload-subtext">hoặc click để chọn file</div>
                            <input type="file" id="productImages" name="images[]" multiple accept="image/*"
                                style="display: none;">
                        </div>
                        <div class="image-preview-container" id="imagePreviewContainer"></div>
                        <div class="form-text">Hỗ trợ: JPG, PNG, WebP. Tối đa 10 hình ảnh.</div>
                    </div>
                </div>

                {{-- Categories & Tags --}}
                <div class="form-section mb-3">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="bi bi-tags"></i>
                            Phân Loại
                        </h3>
                    </div>
                    <div class="section-body">
                        <div class="form-group">
                            <label class="form-label" for="category_id">
                                Danh Mục <span class="required">*</span>
                            </label>
                            <select id="category_id" name="category_id" class="form-select" required>
                                <option value="">Chọn danh mục...</option>
                                <option value="1">Điện Thoại</option>
                                <option value="2">Laptop</option>
                                <option value="3">Máy Tính Bảng</option>
                                <option value="4">Phụ Kiện</option>
                                <option value="5">Tai Nghe</option>
                                <option value="6">Smartwatch</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="brand_id">
                                Thương Hiệu
                            </label>
                            <select id="brand_id" name="brand_id" class="form-select">
                                <option value="">Chọn thương hiệu...</option>
                                <option value="1">Apple</option>
                                <option value="2">Samsung</option>
                                <option value="3">Xiaomi</option>
                                <option value="4">ASUS</option>
                                <option value="5">Dell</option>
                                <option value="6">HP</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="tags">
                                Tags
                            </label>
                            <div class="tag-input-container">
                                <input type="text" id="tags" class="form-control"
                                    placeholder="Nhập tag và nhấn Enter...">
                                <div class="tag-display" id="tagDisplay"></div>
                            </div>
                            <div class="form-text">Nhấn Enter để thêm tag mới</div>
                        </div>
                    </div>
                </div>

                {{-- Product Status --}}
                <div class="form-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="bi bi-toggle-on"></i>
                            Trạng Thái
                        </h3>
                    </div>
                    <div class="section-body">
                        <div class="form-group">
                            <div class="status-toggle">
                                <div class="toggle-switch active" id="statusToggle">
                                    <div class="toggle-slider"></div>
                                </div>
                                <div>
                                    <div class="form-label" style="margin: 0;">Trạng thái hoạt động</div>
                                    <div class="form-text">Sản phẩm hiển thị trên website</div>
                                </div>
                            </div>
                            <input type="hidden" id="is_active" name="is_active" value="1">
                        </div>

                        <div class="form-group">
                            <div class="status-toggle">
                                <div class="toggle-switch" id="featuredToggle">
                                    <div class="toggle-slider"></div>
                                </div>
                                <div>
                                    <div class="form-label" style="margin: 0;">Sản phẩm nổi bật</div>
                                    <div class="form-text">Hiển thị trong mục sản phẩm nổi bật</div>
                                </div>
                            </div>
                            <input type="hidden" id="is_featured" name="is_featured" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="action-buttons">
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                <i class="bi bi-x-lg"></i>
                Hủy
            </button>
            <button type="button" class="btn btn-outline" id="saveDraftBtn">
                <i class="bi bi-file-earmark"></i>
                Lưu Nháp
            </button>
            <button type="submit" class="btn btn-primary" id="submitBtn">
                <i class="bi bi-check-lg"></i>
                Tạo Sản Phẩm
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image Upload Handler - Xử lý upload hình ảnh
        const imageUploadArea = document.getElementById('imageUploadArea');
        const productImages = document.getElementById('productImages');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        let uploadedImages = [];

        // Click to select files - Click để chọn file
        imageUploadArea.addEventListener('click', function() {
            productImages.click();
        });

        // File input change - Thay đổi file input
        productImages.addEventListener('change', function(e) {
            handleFiles(e.target.files);
        });

        // Drag and drop functionality - Chức năng kéo thả
        imageUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            imageUploadArea.classList.add('dragover');
        });

        imageUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            imageUploadArea.classList.remove('dragover');
        });

        imageUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            imageUploadArea.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        // Handle uploaded files - Xử lý file đã upload
        function handleFiles(files) {
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/') && uploadedImages.length < 10) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        addImagePreview(e.target.result, file.name);
                        uploadedImages.push(file);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Add image preview - Thêm preview hình ảnh
        function addImagePreview(src, fileName) {
            const previewDiv = document.createElement('div');
            previewDiv.className = 'image-preview';
            previewDiv.innerHTML = `
            <img src="${src}" alt="${fileName}" class="preview-image">
            <button type="button" class="remove-image" onclick="removeImage(this)">
                <i class="bi bi-x"></i>
            </button>
        `;
            imagePreviewContainer.appendChild(previewDiv);
        }

        // Remove image - Xóa hình ảnh
        window.removeImage = function(button) {
            const previewDiv = button.parentElement;
            const index = Array.from(imagePreviewContainer.children).indexOf(previewDiv);
            uploadedImages.splice(index, 1);
            previewDiv.remove();
        };

        // Tags functionality - Chức năng tags
        const tagsInput = document.getElementById('tags');
        const tagDisplay = document.getElementById('tagDisplay');
        let tags = [];

        tagsInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const tagValue = this.value.trim();
                if (tagValue && !tags.includes(tagValue)) {
                    addTag(tagValue);
                    this.value = '';
                }
            }
        });

        // Add tag - Thêm tag
        function addTag(tagValue) {
            tags.push(tagValue);
            const tagElement = document.createElement('span');
            tagElement.className = 'tag-item';
            tagElement.innerHTML = `
            ${tagValue}
            <button type="button" class="tag-remove" onclick="removeTag('${tagValue}', this)">
                <i class="bi bi-x"></i>
            </button>
        `;
            tagDisplay.appendChild(tagElement);
        }

        // Remove tag - Xóa tag
        window.removeTag = function(tagValue, button) {
            const index = tags.indexOf(tagValue);
            if (index > -1) {
                tags.splice(index, 1);
            }
            button.parentElement.remove();
        };

        // Toggle switches - Các nút toggle
        const statusToggle = document.getElementById('statusToggle');
        const featuredToggle = document.getElementById('featuredToggle');
        const isActiveInput = document.getElementById('is_active');
        const isFeaturedInput = document.getElementById('is_featured');

        statusToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            isActiveInput.value = this.classList.contains('active') ? '1' : '0';
        });

        featuredToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            isFeaturedInput.value = this.classList.contains('active') ? '1' : '0';
        });

        // Price validation - Kiểm tra giá
        const regularPrice = document.getElementById('regular_price');
        const salePrice = document.getElementById('sale_price');

        salePrice.addEventListener('input', function() {
            const regular = parseFloat(regularPrice.value) || 0;
            const sale = parseFloat(this.value) || 0;

            if (sale > 0 && sale >= regular) {
                this.classList.add('error');
                showError(this, 'Giá khuyến mãi phải nhỏ hơn giá gốc');
            } else {
                this.classList.remove('error');
                hideError(this);
            }
        });

        // Form submission - Gửi form
        const createProductForm = document.getElementById('createProductForm');
        const submitBtn = document.getElementById('submitBtn');
        const saveDraftBtn = document.getElementById('saveDraftBtn');

        createProductForm.addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm(false); // false = không phải draft
        });

        saveDraftBtn.addEventListener('click', function() {
            submitForm(true); // true = lưu draft
        });

        // Submit form function - Hàm gửi form
        function submitForm(isDraft) {
            const formData = new FormData(createProductForm);

            // Add tags - Thêm tags
            formData.append('tags', JSON.stringify(tags));

            // Add images - Thêm hình ảnh
            uploadedImages.forEach((file, index) => {
                formData.append(`images[${index}]`, file);
            });

            // Add draft status - Thêm trạng thái draft
            formData.append('is_draft', isDraft ? '1' : '0');

            // Disable buttons - Vô hiệu hóa nút
            submitBtn.disabled = true;
            saveDraftBtn.disabled = true;

            // Show loading - Hiển thị loading
            if (isDraft) {
                saveDraftBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang lưu...';
            } else {
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang tạo...';
            }

            // Simulate API call - Mô phỏng gọi API
            setTimeout(() => {
                if (isDraft) {
                    alert('Đã lưu nháp thành công!');
                    saveDraftBtn.innerHTML = '<i class="bi bi-file-earmark"></i> Lưu Nháp';
                } else {
                    alert('Tạo sản phẩm thành công!');
                    // Redirect to products list - Chuyển hướng đến danh sách sản phẩm
                    window.location.href = '/admin/products';
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
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.textContent = message;
            element.parentNode.appendChild(errorDiv);
        }

        function hideError(element) {
            const errorMessage = element.parentNode.querySelector('.error-message');
            if (errorMessage) {
                errorMessage.remove();
            }
        }

        // Auto-generate SKU - Tự động tạo SKU
        const productName = document.getElementById('product_name');
        const productSku = document.getElementById('product_sku');

        productName.addEventListener('input', function() {
            if (!productSku.value) {
                const sku = generateSKU(this.value);
                productSku.value = sku;
            }
        });

        function generateSKU(name) {
            // Simple SKU generation - Tạo SKU đơn giản
            return name
                .replace(/[^a-zA-Z0-9\s]/g, '')
                .trim()
                .split(' ')
                .map(word => word.charAt(0).toUpperCase())
                .join('') + '-' + Date.now().toString().slice(-4);
        }

        // Format price inputs - Định dạng input giá
        document.querySelectorAll('input[type="number"][step="1000"]').forEach(input => {
            input.addEventListener('input', function() {
                // Add thousand separators for display - Thêm dấu phân cách hàng nghìn
                // This is just for UX, actual value remains unchanged
            });
        });
    });
</script>
@endpush
