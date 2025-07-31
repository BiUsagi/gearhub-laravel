@extends('admin.layouts.app')

@section('title', 'Thuộc Tính Sản Phẩm - GearHub Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/products/attributes.css') }}">
@endpush

@section('content')
    <div class="attributes-container p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/products">Sản Phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thuộc Tính Sản Phẩm</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">
                        <i class="bi bi-sliders"></i>
                        Thuộc Tính Sản Phẩm
                    </h1>
                    <p class="page-subtitle">Quản lý và tạo thuộc tính cho sản phẩm như màu sắc, kích thước, dung lượng</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="/admin/products" class="btn btn-outline">
                        <i class="bi bi-arrow-left"></i>
                        Quay lại
                    </a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createAttributeModal">
                        <i class="bi bi-plus-circle"></i>
                        Tạo thuộc tính mới
                    </button>
                </div>
            </div>
        </div>

        {{-- Stats Overview --}}
        <div class="stats-grid">
            <div class="stat-card attributes">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-sliders"></i>
                    </div>
                </div>
                <div class="stat-value">12</div>
                <p class="stat-label">Tổng thuộc tính</p>
            </div>
            <div class="stat-card values">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-tags"></i>
                    </div>
                </div>
                <div class="stat-value">47</div>
                <p class="stat-label">Tổng giá trị</p>
            </div>
            <div class="stat-card used">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
                <div class="stat-value">9</div>
                <p class="stat-label">Đang sử dụng</p>
            </div>
            <div class="stat-card unused">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-circle"></i>
                    </div>
                </div>
                <div class="stat-value">3</div>
                <p class="stat-label">Chưa sử dụng</p>
            </div>
        </div>

        {{-- Attributes Grid --}}
        <div class="attributes-section">
            <h3 class="section-title">
                <i class="bi bi-grid"></i>
                Danh Sách Thuộc Tính
            </h3>

            <div class="attributes-grid">
                {{-- Color Attribute --}}
                <div class="attribute-card">
                    <div class="attribute-header">
                        <h4 class="attribute-name">Màu sắc</h4>
                        <span class="attribute-type">Color</span>
                    </div>
                    <div class="attribute-values">
                        <div class="color-picker-grid">
                            <div class="color-option" style="background: #000000;" title="Đen"></div>
                            <div class="color-option" style="background: #ffffff;" title="Trắng"></div>
                            <div class="color-option" style="background: #3b82f6;" title="Xanh dương"></div>
                            <div class="color-option" style="background: #ef4444;" title="Đỏ"></div>
                            <div class="color-option" style="background: #10b981;" title="Xanh lá"></div>
                            <div class="color-option" style="background: #f59e0b;" title="Vàng"></div>
                            <div class="color-option" style="background: #8b5cf6;" title="Tím"></div>
                            <div class="color-option" style="background: #6b7280;" title="Xám"></div>
                        </div>
                    </div>
                    <div class="attribute-actions">
                        <button class="btn btn-sm btn-primary" onclick="editAttribute('color')">
                            <i class="bi bi-pencil"></i>
                            Sửa
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="addValue('color')">
                            <i class="bi bi-plus"></i>
                            Thêm màu
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteAttribute('color')">
                            <i class="bi bi-trash"></i>
                            Xóa
                        </button>
                    </div>
                </div>

                {{-- Size Attribute --}}
                <div class="attribute-card">
                    <div class="attribute-header">
                        <h4 class="attribute-name">Kích thước</h4>
                        <span class="attribute-type">Text</span>
                    </div>
                    <div class="attribute-values">
                        <span class="value-tag">XS</span>
                        <span class="value-tag">S</span>
                        <span class="value-tag">M</span>
                        <span class="value-tag">L</span>
                        <span class="value-tag">XL</span>
                        <span class="value-tag">XXL</span>
                    </div>
                    <div class="add-value-form mb-3">
                        <input type="text" class="form-control" placeholder="Thêm kích thước mới..."
                            style="flex: 1;">
                        <button class="btn btn-sm btn-success">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <div class="attribute-actions">
                        <button class="btn btn-sm btn-primary" onclick="editAttribute('size')">
                            <i class="bi bi-pencil"></i>
                            Sửa
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteAttribute('size')">
                            <i class="bi bi-trash"></i>
                            Xóa
                        </button>
                    </div>
                </div>

                {{-- Storage Capacity Attribute --}}
                <div class="attribute-card">
                    <div class="attribute-header">
                        <h4 class="attribute-name">Dung lượng</h4>
                        <span class="attribute-type">Number</span>
                    </div>
                    <div class="attribute-values">
                        <span class="value-tag">64GB</span>
                        <span class="value-tag">128GB</span>
                        <span class="value-tag">256GB</span>
                        <span class="value-tag">512GB</span>
                        <span class="value-tag">1TB</span>
                    </div>
                    <div class="add-value-form mb-3">
                        <input type="text" class="form-control" placeholder="Thêm dung lượng mới..."
                            style="flex: 1;">
                        <button class="btn btn-sm btn-success">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <div class="attribute-actions">
                        <button class="btn btn-sm btn-primary" onclick="editAttribute('storage')">
                            <i class="bi bi-pencil"></i>
                            Sửa
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteAttribute('storage')">
                            <i class="bi bi-trash"></i>
                            Xóa
                        </button>
                    </div>
                </div>

                {{-- Material Attribute --}}
                <div class="attribute-card">
                    <div class="attribute-header">
                        <h4 class="attribute-name">Chất liệu</h4>
                        <span class="attribute-type">Text</span>
                    </div>
                    <div class="attribute-values">
                        <span class="value-tag">Aluminum</span>
                        <span class="value-tag">Titanium</span>
                        <span class="value-tag">Stainless Steel</span>
                        <span class="value-tag">Plastic</span>
                        <span class="value-tag">Carbon Fiber</span>
                    </div>
                    <div class="add-value-form mb-3">
                        <input type="text" class="form-control" placeholder="Thêm chất liệu mới..." style="flex: 1;">
                        <button class="btn btn-sm btn-success">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <div class="attribute-actions">
                        <button class="btn btn-sm btn-primary" onclick="editAttribute('material')">
                            <i class="bi bi-pencil"></i>
                            Sửa
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteAttribute('material')">
                            <i class="bi bi-trash"></i>
                            Xóa
                        </button>
                    </div>
                </div>

                {{-- RAM Attribute --}}
                <div class="attribute-card">
                    <div class="attribute-header">
                        <h4 class="attribute-name">RAM</h4>
                        <span class="attribute-type">Number</span>
                    </div>
                    <div class="attribute-values">
                        <span class="value-tag">8GB</span>
                        <span class="value-tag">16GB</span>
                        <span class="value-tag">32GB</span>
                        <span class="value-tag">64GB</span>
                    </div>
                    <div class="add-value-form mb-3">
                        <input type="text" class="form-control" placeholder="Thêm RAM mới..." style="flex: 1;">
                        <button class="btn btn-sm btn-success">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <div class="attribute-actions">
                        <button class="btn btn-sm btn-primary" onclick="editAttribute('ram')">
                            <i class="bi bi-pencil"></i>
                            Sửa
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteAttribute('ram')">
                            <i class="bi bi-trash"></i>
                            Xóa
                        </button>
                    </div>
                </div>

                {{-- Screen Size Attribute --}}
                <div class="attribute-card">
                    <div class="attribute-header">
                        <h4 class="attribute-name">Kích thước màn hình</h4>
                        <span class="attribute-type">Number</span>
                    </div>
                    <div class="attribute-values">
                        <span class="value-tag">5.4"</span>
                        <span class="value-tag">6.1"</span>
                        <span class="value-tag">6.7"</span>
                        <span class="value-tag">11"</span>
                        <span class="value-tag">12.9"</span>
                        <span class="value-tag">13.3"</span>
                        <span class="value-tag">14"</span>
                        <span class="value-tag">16"</span>
                    </div>
                    <div class="add-value-form mb-3">
                        <input type="text" class="form-control" placeholder="Thêm kích thước mới..."
                            style="flex: 1;">
                        <button class="btn btn-sm btn-success">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <div class="attribute-actions">
                        <button class="btn btn-sm btn-primary" onclick="editAttribute('screen')">
                            <i class="bi bi-pencil"></i>
                            Sửa
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteAttribute('screen')">
                            <i class="bi bi-trash"></i>
                            Xóa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Attribute Modal -->
    <div class="modal fade" id="createAttributeModal" tabindex="-1" aria-labelledby="createAttributeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAttributeModalLabel">
                        <i class="bi bi-plus-circle me-2" style="color: var(--primary-color);"></i>
                        Tạo Thuộc Tính Mới
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createAttributeForm">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-tag me-1"></i>
                                    Tên thuộc tính
                                </label>
                                <input type="text" class="form-control" id="attributeName"
                                    placeholder="Ví dụ: Màu sắc, Kích thước..." required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-list me-1"></i>
                                    Loại thuộc tính
                                </label>
                                <select class="form-select" id="attributeType" required>
                                    <option value="">Chọn loại thuộc tính</option>
                                    <option value="text">Text</option>
                                    <option value="number">Number</option>
                                    <option value="color">Color</option>
                                    <option value="boolean">Boolean</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-text-paragraph me-1"></i>
                                Mô tả
                            </label>
                            <textarea class="form-control" id="attributeDescription" rows="3"
                                placeholder="Mô tả chi tiết về thuộc tính này..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-tags me-1"></i>
                                Giá trị mặc định
                            </label>
                            <div id="defaultValuesContainer">
                                <div class="add-value-form">
                                    <input type="text" class="form-control" placeholder="Nhập giá trị..."
                                        style="flex: 1;">
                                    <button type="button" class="btn btn-sm btn-success" onclick="addDefaultValue()">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="valuesList" class="mt-2"></div>
                        </div>

                        <div id="colorPickerSection" class="form-group" style="display: none;">
                            <label class="form-label">
                                <i class="bi bi-palette me-1"></i>
                                Chọn màu sắc
                            </label>
                            <div class="color-picker-grid">
                                <div class="color-option" style="background: #000000;" data-color="#000000"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #ffffff;" data-color="#ffffff"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #3b82f6;" data-color="#3b82f6"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #ef4444;" data-color="#ef4444"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #10b981;" data-color="#10b981"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #f59e0b;" data-color="#f59e0b"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #8b5cf6;" data-color="#8b5cf6"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #6b7280;" data-color="#6b7280"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #ec4899;" data-color="#ec4899"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #06b6d4;" data-color="#06b6d4"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #84cc16;" data-color="#84cc16"
                                    onclick="selectColor(this)"></div>
                                <div class="color-option" style="background: #f97316;" data-color="#f97316"
                                    onclick="selectColor(this)"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x me-2"></i>Hủy
                    </button>
                    <button type="button" class="btn btn-success" onclick="createAttribute()">
                        <i class="bi bi-check-lg me-2"></i>Tạo thuộc tính
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/products/attributes.js') }}"></script>
@endpush
