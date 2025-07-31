@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa danh mục')
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
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa danh mục</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Chỉnh Sửa Danh Mục</h1>
                    <p class="page-subtitle">Cập nhật thông tin danh mục sản phẩm</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="/admin/categories" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Quay lại
                    </a>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteCategoryModal">
                        <i class="bi bi-trash"></i>
                        Xóa danh mục
                    </button>
                </div>
            </div>
        </div>

        <form id="editCategoryForm" class="create-category-form">
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
                                            value="Điện thoại" required>
                                        <div class="form-text">Tên hiển thị của danh mục trên website</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categorySlug" class="form-label required">Đường dẫn (Slug)</label>
                                        <input type="text" class="form-control" id="categorySlug" name="slug"
                                            value="dien-thoai" required>
                                        <div class="form-text">URL thân thiện cho danh mục này</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categoryDescription" class="form-label">Mô tả danh mục</label>
                                <textarea class="form-control" id="categoryDescription" name="description" rows="4"
                                    placeholder="Nhập mô tả chi tiết về danh mục...">Danh mục chứa các sản phẩm điện thoại di động từ nhiều thương hiệu khác nhau như iPhone, Samsung, Xiaomi, Oppo...</textarea>
                                <div class="form-text">Mô tả sẽ hiển thị trên trang danh mục và giúp SEO</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parentCategory" class="form-label">Danh mục cha</label>
                                        <select class="form-select" id="parentCategory" name="parent_id">
                                            <option value="">-- Chọn danh mục cha (tùy chọn) --</option>
                                            <option value="1">Công nghệ</option>
                                            <option value="2">Thiết bị di động</option>
                                            <option value="3">Phụ kiện</option>
                                            <option value="4">Gaming</option>
                                            <option value="5">Âm thanh</option>
                                        </select>
                                        <div class="form-text">Để trống nếu đây là danh mục gốc</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categoryOrder" class="form-label">Thứ tự hiển thị</label>
                                        <input type="number" class="form-control" id="categoryOrder" name="sort_order"
                                            value="1" min="0">
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
                                                <i class="bi bi-phone" id="selectedIcon"></i>
                                                <span>Điện thoại</span>
                                                <i class="bi bi-chevron-down"></i>
                                            </div>
                                            <div class="icon-picker" id="iconPicker" style="display: none;">
                                                <div class="icon-grid">
                                                    <div class="icon-option active" data-icon="bi-phone">
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
                                                    <div class="icon-option" data-icon="bi-cpu">
                                                        <i class="bi bi-cpu"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="categoryIcon" name="icon" value="bi-phone">
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
                                                <div class="image-preview" id="imagePreview" style="display: block;">
                                                    <img id="previewImg" src="/api/placeholder/300/200" alt="Preview">
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
                                    value="Điện thoại di động chính hãng - GearHub" placeholder="Tiêu đề trang cho SEO..."
                                    maxlength="60">
                                <div class="form-text">
                                    <span class="char-count">42/60 ký tự</span> - Nên từ 50-60 ký tự
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="metaDescription" class="form-label">Meta Description</label>
                                <textarea class="form-control" id="metaDescription" name="meta_description" rows="3"
                                    placeholder="Mô tả trang cho SEO..." maxlength="160">Khám phá bộ sưu tập điện thoại di động chính hãng với giá tốt nhất. iPhone, Samsung, Xiaomi và nhiều thương hiệu hàng đầu tại GearHub.</textarea>
                                <div class="form-text">
                                    <span class="char-count">147/160 ký tự</span> - Nên từ 150-160 ký tự
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="metaKeywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" id="metaKeywords" name="meta_keywords"
                                    value="điện thoại, smartphone, iPhone, Samsung, Xiaomi, di động"
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

                    {{-- Category Stats --}}
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="bi bi-graph-up text-primary me-2"></i>
                                Thống kê danh mục
                            </h5>
                        </div>
                        <div class="section-content">
                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-label">Tổng sản phẩm</div>
                                    <div class="stat-value text-primary">347</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Sản phẩm active</div>
                                    <div class="stat-value text-success">334</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Lượt xem tháng này</div>
                                    <div class="stat-value text-info">12,547</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Đơn hàng tháng này</div>
                                    <div class="stat-value text-warning">89</div>
                                </div>
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
                                        <i class="bi bi-phone" id="previewIcon"></i>
                                    </div>
                                    <div class="preview-content">
                                        <h6 class="preview-name" id="previewName">Điện thoại</h6>
                                        <p class="preview-description" id="previewDescription">Danh mục chứa các sản phẩm
                                            điện thoại di động từ nhiều thương hiệu khác nhau...</p>
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

                    {{-- Recent Activity --}}
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="bi bi-clock-history text-secondary me-2"></i>
                                Lịch sử thay đổi
                            </h5>
                        </div>
                        <div class="section-content">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="bi bi-pencil text-primary"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Cập nhật mô tả danh mục</div>
                                        <div class="activity-time">2 giờ trước</div>
                                        <div class="activity-user">bởi Admin</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="bi bi-image text-info"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Thay đổi hình ảnh danh mục</div>
                                        <div class="activity-time">1 ngày trước</div>
                                        <div class="activity-user">bởi Admin</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="bi bi-plus text-success"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Tạo danh mục</div>
                                        <div class="activity-time">15/07/2025</div>
                                        <div class="activity-user">bởi Admin</div>
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
                                    <i class="bi bi-check-lg me-2"></i>
                                    Cập nhật danh mục
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

    {{-- Delete Category Modal --}}
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger" id="deleteCategoryModalLabel">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Xác nhận xóa danh mục
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning d-flex align-items-center">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <div>
                            <strong>Cảnh báo:</strong> Hành động này không thể hoàn tác!
                        </div>
                    </div>

                    <p class="mb-3">Bạn có chắc chắn muốn xóa danh mục <strong>"Điện thoại"</strong>?</p>

                    <div class="deletion-info">
                        <h6 class="text-danger mb-2">Điều gì sẽ xảy ra khi xóa:</h6>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check text-success me-2"></i>Danh mục sẽ bị xóa vĩnh viễn</li>
                            <li><i class="bi bi-check text-success me-2"></i>347 sản phẩm sẽ chuyển về "Chưa phân loại"
                            </li>
                            <li><i class="bi bi-check text-success me-2"></i>Các danh mục con sẽ trở thành danh mục gốc
                            </li>
                        </ul>
                    </div>

                    <div class="form-group mt-3">
                        <label for="confirmText" class="form-label">
                            Để xác nhận, vui lòng nhập: <code>XÓA DANH MỤC</code>
                        </label>
                        <input type="text" class="form-control" id="confirmText"
                            placeholder="Nhập văn bản xác nhận...">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                        <i class="bi bi-trash me-2"></i>
                        Xóa danh mục
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/admin/categories/edit.js') }}"></script>
    @endpush
@endsection
