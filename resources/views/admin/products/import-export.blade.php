@extends('admin.layouts.app')

@section('title', 'Import/Export Sản Phẩm - GearHub Admin')

@push('styles')
    <style>
        /* Import/Export Styles */
        .import-export-container {
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

        .main-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .section-card {
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
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin: 0;
        }

        .section-body {
            padding: 1.5rem;
        }

        .upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: var(--bg-secondary);
            margin-bottom: 1.5rem;
        }

        .upload-area:hover {
            border-color: var(--primary-color);
            background: var(--primary-color-alpha);
        }

        .upload-area.dragover {
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

        .file-info {
            background: var(--bg-secondary);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            display: none;
        }

        .file-info.show {
            display: block;
        }

        .file-name {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .file-details {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
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
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5b21b6, #7c3aed);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
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
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .export-options {
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
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

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            border-radius: 6px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
        }

        .checkbox-item:hover {
            background: var(--primary-color-alpha);
        }

        .checkbox-item input[type="checkbox"] {
            margin: 0;
            cursor: pointer;
        }

        .checkbox-item label {
            margin: 0;
            cursor: pointer;
            font-size: 0.875rem;
            color: var(--text-primary);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg-primary);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            text-align: center;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            border: 2px solid var(--primary-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .history-section {
            margin-top: 2rem;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--bg-primary);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .history-table th,
        .history-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .history-table th {
            background: var(--bg-secondary);
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
        }

        .history-table td {
            color: var(--text-primary);
            font-size: 0.875rem;
        }

        .history-table tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .status-error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .status-processing {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: var(--bg-secondary);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 1rem;
            display: none;
        }

        .progress-fill {
            height: 100%;
            background: var(--primary-gradient);
            border-radius: 4px;
            transition: width 0.3s ease;
            width: 0%;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
        }

        .alert.show {
            display: block;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid #ef4444;
            color: #ef4444;
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid #f59e0b;
            color: #f59e0b;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }

            .checkbox-group {
                grid-template-columns: 1fr;
            }

            .history-table {
                font-size: 0.75rem;
            }

            .history-table th,
            .history-table td {
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
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
