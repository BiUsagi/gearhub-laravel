@extends('admin.layouts.app')

@section('title', 'Thêm danh mục mới')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/categories/create.css') }}">
@endpush

@section('content')
    <div class="container-fluid p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/categories">Danh mục</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm danh mục</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Thêm Danh Mục Mới</h1>
                    <p class="page-subtitle">Tạo danh mục sản phẩm mới cho cửa hàng GearHub</p>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                        <i class="bi bi-arrow-left"></i>
                        Quay lại
                    </button>
                </div>
            </div>
        </div>

        <form id="createCategoryForm" class="create-category-form">
            <div class="row">
                {{-- Main Form --}}
                <div class="col-lg-8">
                    {{-- Basic Information --}}
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="bi bi-info-circle text-primary me-2"></i>
                                Thông tin cơ bản
                            </h5>
                        </div>
                        <div class="section-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categoryName" class="form-label required">Tên danh mục</label>
                                        <input type="text" class="form-control" id="categoryName" name="name"
                                            placeholder="Nhập tên danh mục..." required>
                                        <div class="form-text">Tên danh mục sẽ hiển thị cho khách hàng</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categorySlug" class="form-label">Slug URL</label>
                                        <input type="text" class="form-control" id="categorySlug" name="slug"
                                            placeholder="slug-url-tu-dong-tao" readonly>
                                        <div class="form-text">URL thân thiện được tạo tự động từ tên danh mục</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categoryDescription" class="form-label">Mô tả danh mục</label>
                                <textarea class="form-control" id="categoryDescription" name="description" rows="4"
                                    placeholder="Nhập mô tả chi tiết về danh mục..."></textarea>
                                <div class="form-text">Mô tả sẽ hiển thị trên trang danh mục và giúp SEO</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parentCategory" class="form-label">Danh mục cha</label>
                                        <select class="form-select" id="parentCategory" name="parent_id">
                                            <option value="">-- Chọn danh mục cha (tùy chọn) --</option>
                                            <option value="1">Điện thoại</option>
                                            <option value="2">Laptop</option>
                                            <option value="3">Máy tính bảng</option>
                                            <option value="4">Phụ kiện âm thanh</option>
                                            <option value="5">Phụ kiện điện thoại</option>
                                        </select>
                                        <div class="form-text">Để trống nếu đây là danh mục gốc</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categoryOrder" class="form-label">Thứ tự hiển thị</label>
                                        <input type="number" class="form-control" id="categoryOrder" name="sort_order"
                                            value="0" min="0">
                                        <div class="form-text">Số thứ tự hiển thị (0 = ưu tiên cao nhất)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Icon & Image --}}
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="bi bi-image text-primary me-2"></i>
                                Biểu tượng & Hình ảnh
                            </h5>
                        </div>
                        <div class="section-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Chọn biểu tượng</label>
                                        <div class="icon-selector">
                                            <div class="selected-icon" onclick="toggleIconPicker()">
                                                <i class="bi bi-tags" id="selectedIcon"></i>
                                                <span>Chọn biểu tượng</span>
                                                <i class="bi bi-chevron-down"></i>
                                            </div>
                                            <div class="icon-picker" id="iconPicker" style="display: none;">
                                                <div class="icon-grid">
                                                    <div class="icon-option active" data-icon="bi-tags">
                                                        <i class="bi bi-tags"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-phone">
                                                        <i class="bi bi-phone"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-laptop">
                                                        <i class="bi bi-laptop"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-tablet">
                                                        <i class="bi bi-tablet"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-headphones">
                                                        <i class="bi bi-headphones"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-speaker">
                                                        <i class="bi bi-speaker"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-camera">
                                                        <i class="bi bi-camera"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-smartwatch">
                                                        <i class="bi bi-smartwatch"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-mouse">
                                                        <i class="bi bi-mouse"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-keyboard">
                                                        <i class="bi bi-keyboard"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-display">
                                                        <i class="bi bi-display"></i>
                                                    </div>
                                                    <div class="icon-option" data-icon="bi-usb-drive">
                                                        <i class="bi bi-usb-drive"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="categoryIcon" name="icon" value="bi-tags">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Hình ảnh đại diện</label>
                                        <div class="image-upload">
                                            <div class="upload-area"
                                                onclick="document.getElementById('categoryImage').click()">
                                                <div class="upload-content">
                                                    <i class="bi bi-cloud-upload"></i>
                                                    <span>Kéo thả hình ảnh hoặc click để chọn</span>
                                                    <small>PNG, JPG lên đến 2MB</small>
                                                </div>
                                                <div class="image-preview" id="imagePreview" style="display: none;">
                                                    <img id="previewImg" src="" alt="Preview">
                                                    <button type="button" class="remove-image" onclick="removeImage()">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="file" id="categoryImage" name="image" accept="image/*"
                                                style="display: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SEO Settings --}}
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="bi bi-search text-primary me-2"></i>
                                Cài đặt SEO
                            </h5>
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                onclick="toggleSection('seoSection')">
                                <i class="bi bi-chevron-down" id="seoToggle"></i>
                            </button>
                        </div>
                        <div class="section-content" id="seoSection" style="display: none;">
                            <div class="form-group">
                                <label for="metaTitle" class="form-label">Meta Title</label>
                                <input type="text" class="form-control" id="metaTitle" name="meta_title"
                                    placeholder="Tiêu đề trang cho SEO..." maxlength="60">
                                <div class="form-text">
                                    <span class="char-count">0/60 ký tự</span> - Nên từ 50-60 ký tự
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="metaDescription" class="form-label">Meta Description</label>
                                <textarea class="form-control" id="metaDescription" name="meta_description" rows="3"
                                    placeholder="Mô tả trang cho SEO..." maxlength="160"></textarea>
                                <div class="form-text">
                                    <span class="char-count">0/160 ký tự</span> - Nên từ 150-160 ký tự
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="metaKeywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" id="metaKeywords" name="meta_keywords"
                                    placeholder="từ khóa 1, từ khóa 2, từ khóa 3...">
                                <div class="form-text">Các từ khóa cách nhau bởi dấu phẩy</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    {{-- Status & Visibility --}}
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="bi bi-gear text-primary me-2"></i>
                                Trạng thái & Hiển thị
                            </h5>
                        </div>
                        <div class="section-content">
                            <div class="form-group">
                                <label class="form-label">Trạng thái danh mục</label>
                                <div class="status-options">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statusActive"
                                            value="active" checked>
                                        <label class="form-check-label" for="statusActive">
                                            <i class="bi bi-check-circle text-success me-2"></i>
                                            Hoạt động
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status"
                                            id="statusInactive" value="inactive">
                                        <label class="form-check-label" for="statusInactive">
                                            <i class="bi bi-eye-slash text-warning me-2"></i>
                                            Tạm ẩn
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="showInMenu" name="show_in_menu"
                                        checked>
                                    <label class="form-check-label" for="showInMenu">
                                        Hiển thị trong menu
                                    </label>
                                </div>
                                <div class="form-text">Danh mục sẽ xuất hiện trong menu điều hướng</div>
                            </div>

                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="isFeatured" name="is_featured">
                                    <label class="form-check-label" for="isFeatured">
                                        Danh mục nổi bật
                                    </label>
                                </div>
                                <div class="form-text">Hiển thị ở trang chủ và vị trí ưu tiên</div>
                            </div>
                        </div>
                    </div>

                    {{-- Category Preview --}}
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="bi bi-eye text-primary me-2"></i>
                                Xem trước
                            </h5>
                        </div>
                        <div class="section-content">
                            <div class="category-preview">
                                <div class="preview-card">
                                    <div class="preview-icon">
                                        <i class="bi bi-tags" id="previewIcon"></i>
                                    </div>
                                    <div class="preview-content">
                                        <h6 class="preview-name" id="previewName">Tên danh mục</h6>
                                        <p class="preview-description" id="previewDescription">Mô tả danh mục sẽ hiển thị
                                            ở đây...</p>
                                        <div class="preview-meta">
                                            <span class="preview-parent" id="previewParent">Danh mục gốc</span>
                                            <span class="preview-status active" id="previewStatus">
                                                <i class="bi bi-check-circle"></i>
                                                Hoạt động
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="form-section">
                        <div class="section-content">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Tạo danh mục
                                </button>
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="bi bi-arrow-clockwise me-2"></i>
                                    Đặt lại form
                                </button>
                                <button type="button" class="btn btn-outline-success">
                                    <i class="bi bi-eye me-2"></i>
                                    Lưu nháp & Xem trước
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('js/admin/categories/create.js') }}"></script>
    @endpush
@endsection
