@extends('admin.layouts.app')

@section('title', 'Import/Export Sản Phẩm - GearHub Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/products/import-export.css') }}">
@endpush


@section('content')
<div class="import-export-container p-3">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/products">Sản Phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Import/Export</li>
        </ol>
    </nav>

    {{-- Page Header --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="bi bi-arrow-down-up"></i>
                    Import/Export Sản Phẩm
                </h1>
                <p class="page-subtitle">Nhập và xuất dữ liệu sản phẩm hàng loạt</p>
            </div>
            <div class="d-flex gap-2">
                <a href="/admin/products" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Quay lại
                </a>
                <button type="button" class="btn btn-outline" onclick="downloadTemplate()">
                    <i class="bi bi-download"></i>
                    Tải Template
                </button>
            </div>
        </div>
    </div>

    {{-- Stats Overview --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-upload"></i>
            </div>
            <div class="stat-value">156</div>
            <div class="stat-label">Lần Import</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-download"></i>
            </div>
            <div class="stat-value">89</div>
            <div class="stat-label">Lần Export</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-value">98.5%</div>
            <div class="stat-label">Tỷ lệ thành công</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-value">2 phút</div>
            <div class="stat-label">Thời gian trung bình</div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="main-container">
        {{-- Import Section --}}
        <div class="section-card">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="bi bi-upload"></i>
                    Import Sản Phẩm
                </h3>
                <p class="section-subtitle">Tải lên file Excel/CSV để thêm sản phẩm hàng loạt</p>
            </div>
            <div class="section-body">
                <div class="alert alert-warning" id="importAlert">
                    <i class="bi bi-exclamation-triangle"></i>
                    Vui lòng kiểm tra định dạng file trước khi upload
                </div>

                <div class="upload-area" id="importUploadArea">
                    <div class="upload-icon">
                        <i class="bi bi-cloud-upload"></i>
                    </div>
                    <div class="upload-text">Kéo thả file vào đây</div>
                    <div class="upload-subtext">hoặc click để chọn file Excel/CSV</div>
                    <input type="file" id="importFile" accept=".xlsx,.xls,.csv" style="display: none;">
                </div>

                <div class="file-info" id="importFileInfo">
                    <div class="file-name" id="importFileName"></div>
                    <div class="file-details" id="importFileDetails"></div>
                </div>

                <div class="progress-bar" id="importProgress">
                    <div class="progress-fill" id="importProgressFill"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tùy chọn Import</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="updateExisting" checked>
                            <label for="updateExisting">Cập nhật sản phẩm tồn tại</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="skipErrors">
                            <label for="skipErrors">Bỏ qua lỗi</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="validateData" checked>
                            <label for="validateData">Kiểm tra dữ liệu</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="backupBeforeImport">
                            <label for="backupBeforeImport">Backup trước khi import</label>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="button" class="btn btn-primary" id="startImport" disabled>
                        <i class="bi bi-play-fill"></i>
                        Bắt đầu Import
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="validateFile()">
                        <i class="bi bi-check-square"></i>
                        Kiểm tra File
                    </button>
                </div>
            </div>
        </div>

        {{-- Export Section --}}
        <div class="section-card">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="bi bi-download"></i>
                    Export Sản Phẩm
                </h3>
                <p class="section-subtitle">Xuất dữ liệu sản phẩm ra file Excel/CSV</p>
            </div>
            <div class="section-body">
                <div class="export-options">
                    <div class="form-group">
                        <label class="form-label" for="exportFormat">Định dạng file</label>
                        <select id="exportFormat" class="form-select">
                            <option value="xlsx">Excel (.xlsx)</option>
                            <option value="csv">CSV (.csv)</option>
                            <option value="json">JSON (.json)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="exportCategory">Danh mục</label>
                        <select id="exportCategory" class="form-select">
                            <option value="">Tất cả danh mục</option>
                            <option value="1">Điện Thoại</option>
                            <option value="2">Laptop</option>
                            <option value="3">Máy Tính Bảng</option>
                            <option value="4">Phụ Kiện</option>
                            <option value="5">Tai Nghe</option>
                            <option value="6">Smartwatch</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Dữ liệu xuất</label>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="exportBasicInfo" checked>
                                <label for="exportBasicInfo">Thông tin cơ bản</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="exportPricing" checked>
                                <label for="exportPricing">Giá cả</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="exportInventory" checked>
                                <label for="exportInventory">Tồn kho</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="exportImages">
                                <label for="exportImages">Hình ảnh</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="exportCategories" checked>
                                <label for="exportCategories">Danh mục</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="exportTags">
                                <label for="exportTags">Tags</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="exportLimit">Giới hạn số lượng</label>
                        <select id="exportLimit" class="form-select">
                            <option value="">Không giới hạn</option>
                            <option value="100">100 sản phẩm</option>
                            <option value="500">500 sản phẩm</option>
                            <option value="1000">1000 sản phẩm</option>
                            <option value="5000">5000 sản phẩm</option>
                        </select>
                    </div>
                </div>

                <div class="progress-bar" id="exportProgress">
                    <div class="progress-fill" id="exportProgressFill"></div>
                </div>

                <div class="action-buttons">
                    <button type="button" class="btn btn-success" id="startExport">
                        <i class="bi bi-download"></i>
                        Xuất Dữ Liệu
                    </button>
                    <button type="button" class="btn btn-outline" onclick="previewExport()">
                        <i class="bi bi-eye"></i>
                        Xem Trước
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- History Section --}}
    <div class="history-section">
        <div class="section-card">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="bi bi-clock-history"></i>
                    Lịch Sử Import/Export
                </h3>
                <p class="section-subtitle">Các lần import/export gần đây</p>
            </div>
            <div class="section-body">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Thời gian</th>
                            <th>Loại</th>
                            <th>File</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Người thực hiện</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>30/07/2025 14:30</td>
                            <td><i class="bi bi-upload text-primary"></i> Import</td>
                            <td>products_batch_001.xlsx</td>
                            <td>156 sản phẩm</td>
                            <td><span class="status-badge status-success">Thành công</span></td>
                            <td>Admin</td>
                            <td>
                                <button class="btn btn-sm btn-outline">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>30/07/2025 10:15</td>
                            <td><i class="bi bi-download text-success"></i> Export</td>
                            <td>all_products.xlsx</td>
                            <td>1,247 sản phẩm</td>
                            <td><span class="status-badge status-success">Thành công</span></td>
                            <td>Admin</td>
                            <td>
                                <button class="btn btn-sm btn-outline">
                                    <i class="bi bi-download"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>29/07/2025 16:45</td>
                            <td><i class="bi bi-upload text-primary"></i> Import</td>
                            <td>mobile_products.csv</td>
                            <td>89 sản phẩm</td>
                            <td><span class="status-badge status-error">Lỗi</span></td>
                            <td>Admin</td>
                            <td>
                                <button class="btn btn-sm btn-outline">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>29/07/2025 09:20</td>
                            <td><i class="bi bi-upload text-primary"></i> Import</td>
                            <td>accessories.xlsx</td>
                            <td>234 sản phẩm</td>
                            <td><span class="status-badge status-processing">Đang xử lý</span></td>
                            <td>Admin</td>
                            <td>
                                <button class="btn btn-sm btn-outline">
                                    <i class="bi bi-pause-fill"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Import functionality
        const importUploadArea = document.getElementById('importUploadArea');
        const importFile = document.getElementById('importFile');
        const importFileInfo = document.getElementById('importFileInfo');
        const importFileName = document.getElementById('importFileName');
        const importFileDetails = document.getElementById('importFileDetails');
        const startImportBtn = document.getElementById('startImport');
        const importProgress = document.getElementById('importProgress');
        const importProgressFill = document.getElementById('importProgressFill');

        // Export functionality
        const startExportBtn = document.getElementById('startExport');
        const exportProgress = document.getElementById('exportProgress');
        const exportProgressFill = document.getElementById('exportProgressFill');

        // Import drag & drop
        importUploadArea.addEventListener('click', () => importFile.click());

        importUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            importUploadArea.classList.add('dragover');
        });

        importUploadArea.addEventListener('dragleave', () => {
            importUploadArea.classList.remove('dragover');
        });

        importUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            importUploadArea.classList.remove('dragover');
            handleImportFile(e.dataTransfer.files[0]);
        });

        importFile.addEventListener('change', (e) => {
            handleImportFile(e.target.files[0]);
        });

        function handleImportFile(file) {
            if (!file) return;

            const allowedTypes = [
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-excel',
                'text/csv'
            ];

            if (!allowedTypes.includes(file.type)) {
                showAlert('error', 'Chỉ hỗ trợ file Excel (.xlsx, .xls) và CSV (.csv)');
                return;
            }

            importFileName.textContent = file.name;
            importFileDetails.textContent =
                `Kích thước: ${formatFileSize(file.size)} • Loại: ${file.type.split('/').pop().toUpperCase()}`;
            importFileInfo.classList.add('show');
            startImportBtn.disabled = false;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Start import
        startImportBtn.addEventListener('click', function() {
            if (!importFile.files[0]) return;

            this.disabled = true;
            this.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang xử lý...';

            importProgress.style.display = 'block';
            simulateProgress(importProgressFill, () => {
                showAlert('success', 'Import thành công! Đã thêm 156 sản phẩm mới.');
                this.disabled = false;
                this.innerHTML = '<i class="bi bi-play-fill"></i> Bắt đầu Import';
                importProgress.style.display = 'none';

                // Reset form
                importFileInfo.classList.remove('show');
                importFile.value = '';
                this.disabled = true;
            });
        });

        // Start export
        startExportBtn.addEventListener('click', function() {
            this.disabled = true;
            this.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang xuất...';

            exportProgress.style.display = 'block';
            simulateProgress(exportProgressFill, () => {
                showAlert('success', 'Export thành công! File đã được tải xuống.');
                this.disabled = false;
                this.innerHTML = '<i class="bi bi-download"></i> Xuất Dữ Liệu';
                exportProgress.style.display = 'none';

                // Simulate download
                downloadFile('products_export.xlsx');
            });
        });

        function simulateProgress(progressElement, callback) {
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    setTimeout(callback, 500);
                }
                progressElement.style.width = progress + '%';
            }, 200);
        }

        function showAlert(type, message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} show`;
            alertDiv.innerHTML = `
                    <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'error' ? 'x-circle' : 'exclamation-triangle'}"></i>
                    ${message}
                `;

            document.querySelector('.section-body').insertBefore(alertDiv, document.querySelector(
                '.upload-area'));

            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }

        function downloadFile(filename) {
            // Simulate file download
            const link = document.createElement('a');
            link.href = '#';
            link.download = filename;
            link.click();
        }

        // Global functions
        window.downloadTemplate = function() {
            showAlert('success', 'Template đã được tải xuống!');
            downloadFile('product_import_template.xlsx');
        };

        window.validateFile = function() {
            if (!importFile.files[0]) {
                showAlert('warning', 'Vui lòng chọn file trước khi kiểm tra');
                return;
            }
            showAlert('success', 'File hợp lệ! Có thể import 156 sản phẩm.');
        };

        window.previewExport = function() {
            const modal = document.createElement('div');
            modal.style.cssText = `
                    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                    background: rgba(0,0,0,0.5); z-index: 9999; display: flex;
                    align-items: center; justify-content: center;
                `;
            modal.innerHTML = `
                    <div style="background: var(--bg-primary); padding: 2rem; border-radius: 12px; max-width: 80%; max-height: 80%; overflow-y: auto;">
                        <h3 style="color: var(--text-primary); margin-bottom: 1rem;">Xem trước dữ liệu xuất</h3>
                        <p style="color: var(--text-secondary);">Sẽ xuất 1,247 sản phẩm với các trường đã chọn</p>
                        <button onclick="this.parentElement.parentElement.remove()" 
                                style="background: var(--primary-color); color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; margin-top: 1rem;">
                            Đóng
                        </button>
                    </div>
                `;
            document.body.appendChild(modal);
        };
    });
</script>
@endpush
