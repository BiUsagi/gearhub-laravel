@extends('admin.layouts.app')

@section('title', 'Chỉnh Sửa Sản Phẩm - GearHub Admin')

@push('styles')
    <style>
        /* Edit Product Styles */
        .edit-product-container {
            padding: 1.5rem 0;
        }

        .page-header {
            background: var(--bg-primary);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: var(--primary-gradient);
            border-radius: 50%;
            opacity: 0.1;
            transform: translate(30px, -30px);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-subtitle {
            color: var(--text-secondary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0 0 1rem 0;
            font-size: 0.875rem;
        }

        .breadcrumb-item {
            color: var(--text-secondary);
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
            color: var(--text-muted);
            margin: 0 0.5rem;
        }

        .form-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .form-section {
            background: var(--bg-primary);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            box-shadow: 0 1px 3px var(--shadow-color);
        }

        .section-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            background: var(--bg-secondary);
            position: relative;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .required {
            color: #ef4444;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-color-alpha);
        }

        .form-control.error {
            border-color: #ef4444;
            background-color: rgba(239, 68, 68, 0.1);
        }

        .form-text {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        .form-text.modified {
            color: #059669;
            font-weight: 500;
        }

        .error-message {
            font-size: 0.75rem;
            color: #ef4444;
            margin-top: 0.25rem;
        }

        .textarea-resize {
            resize: vertical;
            min-height: 100px;
        }

        .image-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: var(--bg-secondary);
        }

        .image-upload-area:hover {
            border-color: var(--primary-color);
            background: var(--primary-color-alpha);
        }

        .image-upload-area.dragover {
            border-color: var(--primary-color);
            background: var(--primary-color-alpha);
            transform: scale(1.02);
        }

        .upload-icon {
            font-size: 3rem;
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .upload-text {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .upload-subtext {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .existing-images {
            margin-bottom: 1.5rem;
        }

        .existing-images-label {
            font-size: 0.875rem;
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 1rem;
            display: block;
        }

        .image-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
        }

        .image-preview {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .image-preview.existing {
            border-color: #059669;
            box-shadow: 0 0 0 2px rgba(5, 150, 105, 0.1);
        }

        .preview-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .remove-image {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            width: 24px;
            height: 24px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .image-status {
            position: absolute;
            bottom: 0.5rem;
            left: 0.5rem;
            background: rgba(5, 150, 105, 0.9);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.625rem;
            font-weight: 500;
        }

        .price-input-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .input-with-icon {
            padding-right: 3rem;
        }

        .tag-input-container {
            position: relative;
        }

        .tag-display {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .tag-item {
            background: var(--primary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tag-item.existing {
            background: #059669;
        }

        .tag-item.new {
            background: #f59e0b;
        }

        .tag-remove {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .inventory-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
        }

        .status-toggle {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--bg-secondary);
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .toggle-switch {
            position: relative;
            width: 48px;
            height: 24px;
            background: #6b7280;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-switch.active {
            background: var(--primary-color);
        }

        .toggle-slider {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .toggle-switch.active .toggle-slider {
            transform: translateX(24px);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding: 1.5rem 0;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
            color: white !important;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
            font-weight: 700;
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5b21b6, #7c3aed) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
            color: white !important;
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }

        .btn-secondary {
            background: var(--bg-secondary);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--bg-primary);
            border-color: var(--text-secondary);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px var(--shadow-color);
            color: var(--text-primary);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            font-weight: 600;
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
            border-color: var(--primary-color);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn:disabled::before {
            display: none;
        }

        .modification-indicator {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 12px;
            height: 12px;
            background: #f59e0b;
            border-radius: 50%;
            border: 2px solid white;
        }

        .changes-summary {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(245, 158, 11, 0.2));
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .changes-summary h6 {
            color: #f59e0b;
            margin: 0 0 0.5rem 0;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .changes-list {
            list-style: none;
            margin: 0;
            padding: 0;
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .changes-list li {
            margin-bottom: 0.25rem;
        }

        .changes-list li::before {
            content: "•";
            margin-right: 0.5rem;
        }

        /* Dark mode styles for buttons */
        @media (prefers-color-scheme: dark) {
            .btn-secondary {
                background: var(--bg-secondary);
                color: var(--text-primary);
                border: 1px solid var(--border-color);
            }

            .btn-secondary:hover {
                background: var(--bg-primary);
                border-color: var(--text-secondary);
                color: var(--text-primary);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .form-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {

            .price-input-group,
            .inventory-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <div class="edit-product-container p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/products">Sản Phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh Sửa</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">
                        <i class="bi bi-pencil-square"></i>
                        Chỉnh Sửa Sản Phẩm
                    </h1>
                    <p class="page-subtitle">
                        <i class="bi bi-info-circle"></i>
                        iPhone 15 Pro Max 256GB - Titanium Natural (SKU: IP15P-256-TN)
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="/admin/products" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Quay lại
                    </a>
                    <button type="button" class="btn btn-outline" onclick="previewProduct()">
                        <i class="bi bi-eye"></i>
                        Xem Trước
                    </button>
                </div>
            </div>
        </div>

        {{-- Changes Summary --}}
        <div class="changes-summary" id="changesSummary" style="display: none;">
            <h6><i class="bi bi-exclamation-triangle"></i> Các thay đổi chưa lưu:</h6>
            <ul class="changes-list" id="changesList">
                <!-- Changes will be populated by JavaScript -->
            </ul>
        </div>

        {{-- Form Container --}}
        <form id="editProductForm" enctype="multipart/form-data">
            <div class="form-container">
                {{-- Left Column --}}
                <div class="left-column">
                    {{-- Basic Information --}}
                    <div class="form-section mb-3">
                        <div class="section-header">
                            <h3 class="section-title">
                                <i class="bi bi-info-circle"></i>
                                Thông Tin Cơ Bản
                                <div class="modification-indicator" id="basicInfoIndicator" style="display: none;"></div>
                            </h3>
                        </div>
                        <div class="section-body">
                            <div class="form-group">
                                <label class="form-label" for="product_name">
                                    Tên Sản Phẩm <span class="required">*</span>
                                </label>
                                <input type="text" id="product_name" name="product_name" class="form-control"
                                    value="iPhone 15 Pro Max 256GB - Titanium Natural" required>
                                <div class="form-text">Tên sản phẩm sẽ hiển thị cho khách hàng</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="product_sku">
                                    Mã Sản Phẩm (SKU) <span class="required">*</span>
                                </label>
                                <input type="text" id="product_sku" name="product_sku" class="form-control"
                                    value="IP15P-256-TN" required>
                                <div class="form-text">Mã định danh duy nhất cho sản phẩm</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="short_description">
                                    Mô Tả Ngắn
                                </label>
                                <textarea id="short_description" name="short_description" class="form-control textarea-resize" rows="3">iPhone 15 Pro Max với chip A17 Pro, camera 48MP và màn hình Super Retina XDR 6.7 inch</textarea>
                                <div class="form-text">Mô tả ngắn hiển thị trong danh sách sản phẩm</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">
                                    Mô Tả Chi Tiết
                                </label>
                                <textarea id="description" name="description" class="form-control textarea-resize" rows="6">iPhone 15 Pro Max sở hữu thiết kế Titanium cao cấp với màn hình Super Retina XDR 6.7 inch. Chip A17 Pro mạnh mẽ, hệ thống camera Pro 48MP với tính năng Action Button mới. Hỗ trợ USB-C và tương thích 5G.</textarea>
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
                                <div class="modification-indicator" id="pricingIndicator" style="display: none;"></div>
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
                                            class="form-control input-with-icon" value="34990000" min="0"
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
                                            class="form-control input-with-icon" value="31990000" min="0"
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
                                        class="form-control input-with-icon" value="28000000" min="0"
                                        step="1000">
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
                                <div class="modification-indicator" id="inventoryIndicator" style="display: none;"></div>
                            </h3>
                        </div>
                        <div class="section-body">
                            <div class="inventory-grid">
                                <div class="form-group">
                                    <label class="form-label" for="stock_quantity">
                                        Số Lượng Tồn Kho <span class="required">*</span>
                                    </label>
                                    <input type="number" id="stock_quantity" name="stock_quantity" class="form-control"
                                        value="25" min="0" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="low_stock_threshold">
                                        Ngưỡng Cảnh Báo
                                    </label>
                                    <input type="number" id="low_stock_threshold" name="low_stock_threshold"
                                        class="form-control" value="5" min="0">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="weight">
                                        Trọng Lượng (gram)
                                    </label>
                                    <input type="number" id="weight" name="weight" class="form-control"
                                        value="221" min="0" step="0.1">
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
                                <div class="modification-indicator" id="imagesIndicator" style="display: none;"></div>
                            </h3>
                        </div>
                        <div class="section-body">
                            {{-- Existing Images --}}
                            <div class="existing-images">
                                <label class="existing-images-label">Hình ảnh hiện tại:</label>
                                <div class="image-preview-container" id="existingImageContainer">
                                    <div class="image-preview existing">
                                        <img src="{{ asset('storage/products/product-1.png') }}" alt="iPhone 15 Pro Max"
                                            class="preview-image">
                                        <div class="image-status">Chính</div>
                                        <button type="button" class="remove-image" onclick="removeExistingImage(this)">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    <div class="image-preview existing">
                                        <img src="{{ asset('storage/products/product-2.png') }}"
                                            alt="iPhone 15 Pro Max Back" class="preview-image">
                                        <button type="button" class="remove-image" onclick="removeExistingImage(this)">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    <div class="image-preview existing">
                                        <img src="{{ asset('storage/products/product-3.png') }}"
                                            alt="iPhone 15 Pro Max Side" class="preview-image">
                                        <button type="button" class="remove-image" onclick="removeExistingImage(this)">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Upload New Images --}}
                            <div class="image-upload-area" id="imageUploadArea">
                                <div class="upload-icon">
                                    <i class="bi bi-cloud-upload"></i>
                                </div>
                                <div class="upload-text">Thêm hình ảnh mới</div>
                                <div class="upload-subtext">Kéo thả hoặc click để chọn file</div>
                                <input type="file" id="productImages" name="images[]" multiple accept="image/*"
                                    style="display: none;">
                            </div>
                            <div class="image-preview-container" id="newImagePreviewContainer"></div>
                            <div class="form-text">Hỗ trợ: JPG, PNG, WebP. Tối đa 10 hình ảnh.</div>
                        </div>
                    </div>

                    {{-- Categories & Tags --}}
                    <div class="form-section mb-3">
                        <div class="section-header">
                            <h3 class="section-title">
                                <i class="bi bi-tags"></i>
                                Phân Loại
                                <div class="modification-indicator" id="categoriesIndicator" style="display: none;">
                                </div>
                            </h3>
                        </div>
                        <div class="section-body">
                            <div class="form-group">
                                <label class="form-label" for="category_id">
                                    Danh Mục <span class="required">*</span>
                                </label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="">Chọn danh mục...</option>
                                    <option value="1" selected>Điện Thoại</option>
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
                                    <option value="1" selected>Apple</option>
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
                                        placeholder="Nhập tag mới và nhấn Enter...">
                                    <div class="tag-display" id="tagDisplay">
                                        <span class="tag-item existing">
                                            iPhone
                                            <button type="button" class="tag-remove"
                                                onclick="removeTag('iPhone', this)">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </span>
                                        <span class="tag-item existing">
                                            Apple
                                            <button type="button" class="tag-remove" onclick="removeTag('Apple', this)">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </span>
                                        <span class="tag-item existing">
                                            Flagship
                                            <button type="button" class="tag-remove"
                                                onclick="removeTag('Flagship', this)">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </span>
                                    </div>
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
                                <div class="modification-indicator" id="statusIndicator" style="display: none;"></div>
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
                                    <div class="toggle-switch active" id="featuredToggle">
                                        <div class="toggle-slider"></div>
                                    </div>
                                    <div>
                                        <div class="form-label" style="margin: 0;">Sản phẩm nổi bật</div>
                                        <div class="form-text">Hiển thị trong mục sản phẩm nổi bật</div>
                                    </div>
                                </div>
                                <input type="hidden" id="is_featured" name="is_featured" value="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="action-buttons">
                <a href="/admin/products" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i>
                    Hủy Thay Đổi
                </a>
                <button type="button" class="btn btn-outline" id="saveDraftBtn">
                    <i class="bi bi-file-earmark"></i>
                    Lưu Nháp
                </button>
                <button type="button" class="btn btn-warning" id="resetBtn">
                    <i class="bi bi-arrow-clockwise"></i>
                    Khôi Phục
                </button>
                <button type="submit" class="btn btn-primary" id="updateBtn">
                    <i class="bi bi-check-lg"></i>
                    Cập Nhật Sản Phẩm
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Store original values for change tracking
            const originalValues = {};
            const form = document.getElementById('editProductForm');
            const changesSummary = document.getElementById('changesSummary');
            const changesList = document.getElementById('changesList');

            // Store original form data
            function storeOriginalValues() {
                const formData = new FormData(form);
                for (let [key, value] of formData.entries()) {
                    originalValues[key] = value;
                }

                // Store original tags
                originalValues.tags = Array.from(document.querySelectorAll('.tag-item.existing')).map(tag =>
                    tag.textContent.trim().replace('×', '').trim()
                );

                // Store original images
                originalValues.existingImages = Array.from(document.querySelectorAll('.image-preview.existing img'))
                    .map(img => img.src);
            }

            // Track changes
            function trackChanges() {
                const changes = [];
                const currentFormData = new FormData(form);

                // Check form fields
                for (let [key, value] of currentFormData.entries()) {
                    if (originalValues[key] && originalValues[key] !== value) {
                        changes.push(`${getFieldLabel(key)}: "${originalValues[key]}" → "${value}"`);
                    }
                }

                // Check tags
                const currentTags = Array.from(document.querySelectorAll('.tag-item')).map(tag =>
                    tag.textContent.trim().replace('×', '').trim()
                );
                if (JSON.stringify(originalValues.tags) !== JSON.stringify(currentTags)) {
                    changes.push('Tags đã được thay đổi');
                }

                // Check images
                const currentImages = Array.from(document.querySelectorAll('.image-preview img')).map(img => img
                    .src);
                if (JSON.stringify(originalValues.existingImages) !== JSON.stringify(currentImages)) {
                    changes.push('Hình ảnh đã được thay đổi');
                }

                // Update UI
                if (changes.length > 0) {
                    changesSummary.style.display = 'block';
                    changesList.innerHTML = changes.map(change => `<li>${change}</li>`).join('');
                    showModificationIndicators(changes);
                } else {
                    changesSummary.style.display = 'none';
                    hideAllModificationIndicators();
                }
            }

            function getFieldLabel(key) {
                const labels = {
                    'product_name': 'Tên sản phẩm',
                    'product_sku': 'Mã SKU',
                    'short_description': 'Mô tả ngắn',
                    'description': 'Mô tả chi tiết',
                    'regular_price': 'Giá gốc',
                    'sale_price': 'Giá khuyến mãi',
                    'cost_price': 'Giá vốn',
                    'stock_quantity': 'Số lượng tồn kho',
                    'low_stock_threshold': 'Ngưỡng cảnh báo',
                    'weight': 'Trọng lượng',
                    'category_id': 'Danh mục',
                    'brand_id': 'Thương hiệu'
                };
                return labels[key] || key;
            }

            function showModificationIndicators(changes) {
                // Logic to show indicators based on changed fields
                hideAllModificationIndicators();

                changes.forEach(change => {
                    if (change.includes('Tên sản phẩm') || change.includes('Mô tả') || change.includes(
                            'SKU')) {
                        document.getElementById('basicInfoIndicator').style.display = 'block';
                    }
                    if (change.includes('Giá')) {
                        document.getElementById('pricingIndicator').style.display = 'block';
                    }
                    if (change.includes('Số lượng') || change.includes('Trọng lượng')) {
                        document.getElementById('inventoryIndicator').style.display = 'block';
                    }
                    if (change.includes('Hình ảnh')) {
                        document.getElementById('imagesIndicator').style.display = 'block';
                    }
                    if (change.includes('Danh mục') || change.includes('Tags')) {
                        document.getElementById('categoriesIndicator').style.display = 'block';
                    }
                });
            }

            function hideAllModificationIndicators() {
                document.querySelectorAll('.modification-indicator').forEach(indicator => {
                    indicator.style.display = 'none';
                });
            }

            // Initialize
            storeOriginalValues();

            // Form change listeners
            form.addEventListener('input', trackChanges);
            form.addEventListener('change', trackChanges);

            // Image Upload Handler (similar to create page)
            const imageUploadArea = document.getElementById('imageUploadArea');
            const productImages = document.getElementById('productImages');
            const newImagePreviewContainer = document.getElementById('newImagePreviewContainer');
            let newUploadedImages = [];

            imageUploadArea.addEventListener('click', function() {
                productImages.click();
            });

            productImages.addEventListener('change', function(e) {
                handleFiles(e.target.files);
            });

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

            function handleFiles(files) {
                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/') && newUploadedImages.length < 5) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            addNewImagePreview(e.target.result, file.name);
                            newUploadedImages.push(file);
                            trackChanges();
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            function addNewImagePreview(src, fileName) {
                const previewDiv = document.createElement('div');
                previewDiv.className = 'image-preview';
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
            window.removeNewImage = function(button) {
                const previewDiv = button.parentElement;
                const index = Array.from(newImagePreviewContainer.children).indexOf(previewDiv);
                newUploadedImages.splice(index, 1);
                previewDiv.remove();
                trackChanges();
            };

            // Remove existing image
            window.removeExistingImage = function(button) {
                if (confirm('Bạn có chắc chắn muốn xóa hình ảnh này?')) {
                    button.parentElement.remove();
                    trackChanges();
                }
            };

            // Tags functionality
            const tagsInput = document.getElementById('tags');
            const tagDisplay = document.getElementById('tagDisplay');
            let currentTags = Array.from(document.querySelectorAll('.tag-item.existing')).map(tag =>
                tag.textContent.trim().replace('×', '').trim()
            );

            tagsInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const tagValue = this.value.trim();
                    if (tagValue && !currentTags.includes(tagValue)) {
                        addTag(tagValue, 'new');
                        this.value = '';
                        trackChanges();
                    }
                }
            });

            function addTag(tagValue, type = 'existing') {
                currentTags.push(tagValue);
                const tagElement = document.createElement('span');
                tagElement.className = `tag-item ${type}`;
                tagElement.innerHTML = `
                    ${tagValue}
                    <button type="button" class="tag-remove" onclick="removeTag('${tagValue}', this)">
                        <i class="bi bi-x"></i>
                    </button>
                `;
                tagDisplay.appendChild(tagElement);
            }

            window.removeTag = function(tagValue, button) {
                const index = currentTags.indexOf(tagValue);
                if (index > -1) {
                    currentTags.splice(index, 1);
                }
                button.parentElement.remove();
                trackChanges();
            };

            // Toggle switches
            const statusToggle = document.getElementById('statusToggle');
            const featuredToggle = document.getElementById('featuredToggle');
            const isActiveInput = document.getElementById('is_active');
            const isFeaturedInput = document.getElementById('is_featured');

            statusToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                isActiveInput.value = this.classList.contains('active') ? '1' : '0';
                trackChanges();
            });

            featuredToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                isFeaturedInput.value = this.classList.contains('active') ? '1' : '0';
                trackChanges();
            });

            // Price validation
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

            // Form actions
            const updateBtn = document.getElementById('updateBtn');
            const saveDraftBtn = document.getElementById('saveDraftBtn');
            const resetBtn = document.getElementById('resetBtn');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                updateProduct();
            });

            saveDraftBtn.addEventListener('click', function() {
                saveDraft();
            });

            resetBtn.addEventListener('click', function() {
                if (confirm(
                        'Bạn có chắc chắn muốn khôi phục về trạng thái ban đầu? Tất cả thay đổi sẽ bị mất.'
                    )) {
                    resetForm();
                }
            });

            function updateProduct() {
                updateBtn.disabled = true;
                updateBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang cập nhật...';

                // Simulate API call
                setTimeout(() => {
                    alert('Cập nhật sản phẩm thành công!');
                    storeOriginalValues(); // Update original values
                    trackChanges(); // Re-check changes
                    updateBtn.disabled = false;
                    updateBtn.innerHTML = '<i class="bi bi-check-lg"></i> Cập Nhật Sản Phẩm';
                }, 2000);
            }

            function saveDraft() {
                saveDraftBtn.disabled = true;
                saveDraftBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang lưu...';

                setTimeout(() => {
                    alert('Đã lưu nháp thành công!');
                    saveDraftBtn.disabled = false;
                    saveDraftBtn.innerHTML = '<i class="bi bi-file-earmark"></i> Lưu Nháp';
                }, 1500);
            }

            function resetForm() {
                // Reset form to original values
                location.reload(); // Simple way to reset everything
            }

            // Preview product function
            window.previewProduct = function() {
                window.open('/products/preview/1', '_blank');
            };

            // Utility functions
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

            // Prevent accidental page leave
            window.addEventListener('beforeunload', function(e) {
                if (changesSummary.style.display !== 'none') {
                    e.preventDefault();
                    e.returnValue = 'Bạn có thay đổi chưa được lưu. Bạn có chắc chắn muốn rời khỏi trang?';
                }
            });
        });
    </script>
@endpush
