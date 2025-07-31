@extends('admin.layouts.app')

@section('title', 'Quản Lý Sản Phẩm - GearHub Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/products/index.css') }}">
@endpush

@section('content')
    <div class="content-wrapper p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
            </ol>
        </nav>
        {{-- Page Header --}}
        <div class="product-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2">Quản Lý Sản Phẩm</h1>
                    <p class="text-muted mb-0">Quản lý tất cả sản phẩm trong cửa hàng điện tử của bạn</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-download me-2"></i>Xuất Excel
                    </button>
                    <button class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Thêm Sản Phẩm
                    </button>
                </div>
            </div>
        </div>

        {{-- Product Statistics --}}
        <div class="product-stats">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="stat-value">1,248</div>
                <div class="stat-label">Tổng Sản Phẩm</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-value">1,156</div>
                <div class="stat-label">Đang Hoạt Động</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div class="stat-value">48</div>
                <div class="stat-label">Sắp Hết Hàng</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="stat-value">44</div>
                <div class="stat-label">Hết Hàng</div>
            </div>
        </div>

        {{-- Products Table --}}
        <div class="products-table-container">
            {{-- Table Header with Filters --}}
            <div class="table-header">
                <h5 class="table-title">Danh Sách Sản Phẩm</h5>
                <div class="table-filters">
                    <select class="filter-select">
                        <option value="">Tất cả danh mục</option>
                        <option value="smartphones">Điện Thoại</option>
                        <option value="laptops">Laptop</option>
                        <option value="tablets">Máy Tính Bảng</option>
                        <option value="accessories">Phụ Kiện</option>
                    </select>
                    <select class="filter-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active">Hoạt động</option>
                        <option value="inactive">Tạm dừng</option>
                        <option value="out-of-stock">Hết hàng</option>
                    </select>
                    <input type="text" class="filter-input" placeholder="Tìm kiếm sản phẩm...">
                </div>
            </div>

            {{-- Products Table --}}
            <table class="products-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="form-check-input">
                        </th>
                        <th>Sản Phẩm</th>
                        <th>Danh Mục</th>
                        <th>Giá</th>
                        <th>Kho</th>
                        <th>Trạng Thái</th>
                        <th>Ngày Tạo</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Product Row 1 - iPhone 15 Pro --}}
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input">
                        </td>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('storage/products/product-1.png') }}" alt="iPhone 15 Pro"
                                    class="product-image">
                                <div class="product-details">
                                    <h6>iPhone 15 Pro 128GB</h6>
                                    <div class="product-sku">SKU: IP15P-128-TI</div>
                                </div>
                            </div>
                        </td>
                        <td>Điện Thoại</td>
                        <td>
                            <div class="product-price">28.990.000₫</div>
                            <div class="price-original">32.990.000₫</div>
                        </td>
                        <td>
                            <span class="stock-badge stock-high">85</span>
                        </td>
                        <td>
                            <span class="status-badge status-active">Hoạt động</span>
                        </td>
                        <td>15/07/2025</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view" title="Xem chi tiết">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-action btn-edit" title="Chỉnh sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Product Row 2 - MacBook Pro --}}
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input">
                        </td>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('storage/products/product-2.png') }}" alt="MacBook Pro"
                                    class="product-image">
                                <div class="product-details">
                                    <h6>MacBook Pro 14" M3 Pro</h6>
                                    <div class="product-sku">SKU: MBP14-M3P-512</div>
                                </div>
                            </div>
                        </td>
                        <td>Laptop</td>
                        <td>
                            <div class="product-price">52.990.000₫</div>
                        </td>
                        <td>
                            <span class="stock-badge stock-medium">12</span>
                        </td>
                        <td>
                            <span class="status-badge status-active">Hoạt động</span>
                        </td>
                        <td>12/07/2025</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view" title="Xem chi tiết">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-action btn-edit" title="Chỉnh sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Product Row 3 - Samsung Galaxy S24 --}}
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input">
                        </td>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('storage/products/product-3.png') }}" alt="Samsung Galaxy S24"
                                    class="product-image">
                                <div class="product-details">
                                    <h6>Samsung Galaxy S24 Ultra 256GB</h6>
                                    <div class="product-sku">SKU: SGS24U-256-TI</div>
                                </div>
                            </div>
                        </td>
                        <td>Điện Thoại</td>
                        <td>
                            <div class="product-price">27.990.000₫</div>
                            <div class="price-original">30.990.000₫</div>
                        </td>
                        <td>
                            <span class="stock-badge stock-low">3</span>
                        </td>
                        <td>
                            <span class="status-badge status-out-of-stock">Sắp hết</span>
                        </td>
                        <td>10/07/2025</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view" title="Xem chi tiết">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-action btn-edit" title="Chỉnh sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Product Row 4 - iPad Pro --}}
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input">
                        </td>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('storage/products/product-4.png') }}" alt="iPad Pro"
                                    class="product-image">
                                <div class="product-details">
                                    <h6>iPad Pro 12.9" M2 WiFi 128GB</h6>
                                    <div class="product-sku">SKU: IPP129-M2-128</div>
                                </div>
                            </div>
                        </td>
                        <td>Máy Tính Bảng</td>
                        <td>
                            <div class="product-price">28.990.000₫</div>
                        </td>
                        <td>
                            <span class="stock-badge stock-high">45 </span>
                        </td>
                        <td>
                            <span class="status-badge status-active">Hoạt động</span>
                        </td>
                        <td>08/07/2025</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view" title="Xem chi tiết">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-action btn-edit" title="Chỉnh sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Product Row 5 - AirPods Pro --}}
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input">
                        </td>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('storage/products/product-5.png') }}" alt="AirPods Pro"
                                    class="product-image">
                                <div class="product-details">
                                    <h6>AirPods Pro (3rd generation)</h6>
                                    <div class="product-sku">SKU: APP-3GEN-USB</div>
                                </div>
                            </div>
                        </td>
                        <td>Phụ Kiện</td>
                        <td>
                            <div class="product-price">6.490.000₫</div>
                            <div class="price-original">6.990.000₫</div>
                        </td>
                        <td>
                            <span class="stock-badge stock-high">156 </span>
                        </td>
                        <td>
                            <span class="status-badge status-active">Hoạt động</span>
                        </td>
                        <td>05/07/2025</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view" title="Xem chi tiết">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-action btn-edit" title="Chỉnh sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Product Row 6 - ASUS ROG Laptop --}}
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input">
                        </td>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('storage/products/product-3.png') }}" alt="ASUS ROG"
                                    class="product-image">
                                <div class="product-details">
                                    <h6>ASUS ROG Strix G15 RTX 4060</h6>
                                    <div class="product-sku">SKU: ASG15-4060-512</div>
                                </div>
                            </div>
                        </td>
                        <td>Laptop</td>
                        <td>
                            <div class="product-price">32.990.000₫</div>
                        </td>
                        <td>
                            <span class="stock-badge stock-low">0 </span>
                        </td>
                        <td>
                            <span class="status-badge status-inactive">Hết hàng</span>
                        </td>
                        <td>03/07/2025</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-view" title="Xem chi tiết">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-action btn-edit" title="Chỉnh sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn-action btn-delete" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- Pagination - Phân trang --}}
            <div class="pagination-container">
                <div class="pagination-info">
                    Hiển thị <strong>1-6</strong> của <strong>1,248</strong> sản phẩm
                </div>
                <div class="pagination-nav">
                    <a href="#" class="page-btn">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <a href="#" class="page-btn active">1</a>
                    <a href="#" class="page-btn">2</a>
                    <a href="#" class="page-btn">3</a>
                    <a href="#" class="page-btn">...</a>
                    <a href="#" class="page-btn">208</a>
                    <a href="#" class="page-btn">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select All Checkbox Functionality - Chức năng chọn tất cả checkbox  
            const selectAllCheckbox = document.querySelector('thead input[type="checkbox"]');
            const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }

            // Individual checkbox change - Thay đổi checkbox riêng lẻ
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedCount = document.querySelectorAll(
                        'tbody input[type="checkbox"]:checked').length;
                    selectAllCheckbox.checked = checkedCount === rowCheckboxes.length;
                    selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount <
                        rowCheckboxes.length;
                });
            });

            // Filter functionality - Chức năng lọc
            const categoryFilter = document.querySelector('.filter-select:first-of-type');
            const statusFilter = document.querySelector('.filter-select:last-of-type');
            const searchInput = document.querySelector('.filter-input');

            function filterProducts() {
                const categoryValue = categoryFilter?.value.toLowerCase() || '';
                const statusValue = statusFilter?.value.toLowerCase() || '';
                const searchValue = searchInput?.value.toLowerCase() || '';

                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const categoryCell = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const productName = row.querySelector('.product-details h6').textContent.toLowerCase();
                    const statusCell = row.querySelector('.status-badge').textContent.toLowerCase();

                    const matchesCategory = !categoryValue || categoryCell.includes(categoryValue);
                    const matchesStatus = !statusValue || statusCell.includes(statusValue);
                    const matchesSearch = !searchValue || productName.includes(searchValue);

                    if (matchesCategory && matchesStatus && matchesSearch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Add event listeners for filters - Thêm event listeners cho bộ lọc
            categoryFilter?.addEventListener('change', filterProducts);
            statusFilter?.addEventListener('change', filterProducts);
            searchInput?.addEventListener('input', filterProducts);

            // Action button handlers - Xử lý các nút thao tác
            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-view')) {
                    const productName = e.target.closest('tr').querySelector('.product-details h6')
                        .textContent;
                    alert(`Xem chi tiết sản phẩm: ${productName}`);
                }

                if (e.target.closest('.btn-edit')) {
                    const productName = e.target.closest('tr').querySelector('.product-details h6')
                        .textContent;
                    alert(`Chỉnh sửa sản phẩm: ${productName}`);
                }

                if (e.target.closest('.btn-delete')) {
                    const productName = e.target.closest('tr').querySelector('.product-details h6')
                        .textContent;
                    if (confirm(`Bạn có chắc chắn muốn xóa sản phẩm: ${productName}?`)) {
                        e.target.closest('tr').remove();
                    }
                }
            });

            // Add product button - Nút thêm sản phẩm
            const addProductBtn = document.querySelector('.btn-primary');
            addProductBtn?.addEventListener('click', function() {
                alert('Chuyển đến trang thêm sản phẩm mới');
            });

            // Export Excel button - Nút xuất Excel
            const exportBtn = document.querySelector('.btn-outline-primary');
            exportBtn?.addEventListener('click', function() {
                alert('Đang xuất danh sách sản phẩm ra file Excel...');
            });
        });
    </script>
@endpush
