<!DOCTYPE html>
<html lang="vi" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GearHub Admin Dashboard</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #8b5cf6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #06b6d4;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
            --sidebar-bg: #1e293b;
            --border-color: #334155;
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        [data-bs-theme="light"] {
            --dark-bg: #ffffff;
            --card-bg: #ffffff;
            --sidebar-bg: #f8fafc;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark-bg);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .brand-text,
        .sidebar.collapsed .nav-section-title,
        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .badge,
        .sidebar.collapsed .dropdown-arrow {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px;
        }

        .sidebar.collapsed .nav-link i {
            width: auto;
        }

        .sidebar.collapsed .sidebar-header {
            justify-content: center;
        }

        /* Tooltip for collapsed sidebar */
        .sidebar.collapsed .nav-link {
            position: relative;
        }

        .sidebar.collapsed .nav-link:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 70px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--card-bg);
            color: var(--text-primary);
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 14px;
            white-space: nowrap;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid var(--border-color);
            z-index: 1001;
            animation: tooltipFadeIn 0.2s ease;
        }

        @keyframes tooltipFadeIn {
            from {
                opacity: 0;
                transform: translateY(-50%) translateX(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(-50%) translateX(0);
            }
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-search {
            padding: 0 20px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-search-box {
            position: relative;
        }

        .sidebar-search-input {
            width: 100%;
            padding: 10px 12px 10px 36px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--dark-bg);
            color: var(--text-primary);
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .sidebar-search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
        }

        .sidebar-search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 14px;
        }

        .sidebar.collapsed .sidebar-search {
            display: none;
        }

        .logo {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .brand-text {
            font-size: 24px;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-section {
            margin-bottom: 30px;
        }

        .nav-section-title {
            padding: 0 20px 10px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-secondary);
            letter-spacing: 0.5px;
        }

        .nav-item {
            margin: 2px 12px;
            border-radius: 12px;
            overflow: hidden;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 12px;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
        }

        .nav-link.active {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.3);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .nav-link .dropdown-arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .nav-link.expanded .dropdown-arrow {
            transform: rotate(90deg);
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            margin-left: 32px;
        }

        .submenu.expanded {
            max-height: 300px;
        }

        .submenu .nav-item {
            margin: 2px 0;
        }

        .submenu .nav-link {
            padding: 8px 16px;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .submenu .nav-link:hover {
            background: rgba(99, 102, 241, 0.05);
            color: var(--primary-color);
        }

        .submenu .nav-link.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
            box-shadow: none;
        }

        .sidebar.collapsed .submenu {
            display: none;
        }

        .badge {
            margin-left: auto;
            font-size: 10px;
            padding: 4px 8px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            background: var(--dark-bg);
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 80px;
        }

        /* Top Header */
        .top-header {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 20px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
        }

        .search-box {
            position: relative;
            width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 12px 16px 12px 48px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background: var(--dark-bg);
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .theme-toggle {
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 18px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 18px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .notification-btn:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
        }

        .notification-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 8px;
            height: 8px;
            background: var(--danger-color);
            border-radius: 50%;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background: rgba(99, 102, 241, 0.1);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .user-info small {
            color: var(--text-secondary);
            font-size: 12px;
        }

        /* Dropdown Styles */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            min-width: 280px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 9999;
            max-height: 400px;
            overflow-y: auto;
            pointer-events: none;
            display: block;
        }

        .dropdown.show .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: auto;
        }

        .dropdown-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            font-size: 14px;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-color);
        }

        .dropdown-item-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: white;
            flex-shrink: 0;
        }

        .dropdown-item-content h6 {
            margin: 0 0 2px;
            font-size: 13px;
            font-weight: 600;
        }

        .dropdown-item-content p {
            margin: 0;
            font-size: 12px;
            color: var(--text-secondary);
        }

        .dropdown-item-time {
            margin-left: auto;
            font-size: 11px;
            color: var(--text-secondary);
        }

        .dropdown-footer {
            padding: 12px 20px;
            border-top: 1px solid var(--border-color);
            text-align: center;
        }

        .dropdown-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }

        .dropdown-footer a:hover {
            text-decoration: underline;
        }

        /* User Dropdown Specific */
        .user-dropdown {
            min-width: 240px;
        }

        .user-dropdown .dropdown-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-dropdown .user-avatar-large {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .user-dropdown .user-details h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .user-dropdown .user-details small {
            color: var(--text-secondary);
            font-size: 12px;
        }

        .user-dropdown .dropdown-item {
            border-bottom: none;
            padding: 10px 20px;
        }

        .user-dropdown .dropdown-item i {
            width: 18px;
            text-align: center;
            color: var(--text-secondary);
        }

        .user-dropdown .dropdown-divider {
            height: 1px;
            background: var(--border-color);
            margin: 8px 0;
        }

        .user-dropdown .logout-item {
            color: var(--danger-color);
        }

        .user-dropdown .logout-item:hover {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 24px;
        }

        .page-title {
            margin-bottom: 24px;
        }

        .page-title h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 16px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .stat-card.success::before {
            background: var(--gradient-success);
        }

        .stat-card.warning::before {
            background: var(--gradient-warning);
        }

        .stat-card.danger::before {
            background: var(--gradient-danger);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .stat-icon.primary {
            background: var(--gradient-primary);
        }

        .stat-icon.success {
            background: var(--gradient-success);
        }

        .stat-icon.warning {
            background: var(--gradient-warning);
        }

        .stat-icon.danger {
            background: var(--gradient-danger);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 14px;
            font-weight: 500;
        }

        .stat-change.positive {
            color: var(--success-color);
        }

        .stat-change.negative {
            color: var(--danger-color);
        }

        /* Chart Cards */
        .chart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        .chart-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: between;
            margin-bottom: 24px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .chart-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 16px;
        }

        /* Recent Activity */
        .activity-list {
            list-style: none;
            padding: 0;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            flex-shrink: 0;
        }

        .activity-content h6 {
            margin: 0 0 4px;
            font-size: 14px;
            font-weight: 600;
        }

        .activity-content p {
            margin: 0;
            color: var(--text-secondary);
            font-size: 13px;
        }

        .activity-time {
            margin-left: auto;
            color: var(--text-secondary);
            font-size: 12px;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .chart-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .search-box {
                width: 250px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .user-info {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .dashboard-content {
                padding: 16px;
            }

            .search-box {
                display: none;
            }

            .page-title h1 {
                font-size: 24px;
            }
        }

        /* Scrollbar Styles */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">GH</div>
            <div class="brand-text">GearHub</div>
        </div>

        <div class="sidebar-search">
            <div class="sidebar-search-box">
                <i class="bi bi-search sidebar-search-icon"></i>
                <input type="text" class="sidebar-search-input" placeholder="Tìm kiếm menu...">
            </div>
        </div>

        <div class="sidebar-nav">
            <!-- Dashboard Section -->
            <div class="nav-section">
                <div class="nav-section-title">Dashboard</div>
                <div class="nav-item">
                    <a href="#" class="nav-link active" data-tooltip="Tổng quan">
                        <i class="bi bi-speedometer2"></i>
                        <span>Tổng quan</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-tooltip="Phân tích">
                        <i class="bi bi-graph-up"></i>
                        <span>Phân tích</span>
                    </a>
                </div>
            </div>

            <!-- E-commerce Section -->
            <div class="nav-section">
                <div class="nav-section-title">Quản lý bán hàng</div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="products-submenu"
                        data-tooltip="Sản phẩm">
                        <i class="bi bi-box-seam"></i>
                        <span>Sản phẩm</span>
                        <span class="badge bg-primary">1.2k</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="products-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-list-ul"></i>
                                <span>Danh sách sản phẩm</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-plus-circle"></i>
                                <span>Thêm sản phẩm</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-images"></i>
                                <span>Thư viện ảnh</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-star"></i>
                                <span>Sản phẩm nổi bật</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="categories-submenu"
                        data-tooltip="Danh mục">
                        <i class="bi bi-tags"></i>
                        <span>Danh mục</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="categories-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-list-ul"></i>
                                <span>Tất cả danh mục</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-plus-circle"></i>
                                <span>Thêm danh mục</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-diagram-3"></i>
                                <span>Cây danh mục</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="orders-submenu"
                        data-tooltip="Đơn hàng">
                        <i class="bi bi-receipt"></i>
                        <span>Đơn hàng</span>
                        <span class="badge bg-warning">12</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="orders-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-list-ul"></i>
                                <span>Tất cả đơn hàng</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-clock"></i>
                                <span>Chờ xử lý</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-truck"></i>
                                <span>Đang giao</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-check-circle"></i>
                                <span>Hoàn thành</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-x-circle"></i>
                                <span>Đã hủy</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="customers-submenu"
                        data-tooltip="Khách hàng">
                        <i class="bi bi-people"></i>
                        <span>Khách hàng</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="customers-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-list-ul"></i>
                                <span>Tất cả khách hàng</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-person-plus"></i>
                                <span>Khách hàng mới</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-star-fill"></i>
                                <span>Khách VIP</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-envelope"></i>
                                <span>Gửi email</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="promotions-submenu"
                        data-tooltip="Khuyến mãi">
                        <i class="bi bi-percent"></i>
                        <span>Khuyến mãi</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="promotions-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-list-ul"></i>
                                <span>Tất cả khuyến mãi</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-plus-circle"></i>
                                <span>Tạo khuyến mãi</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-ticket"></i>
                                <span>Mã giảm giá</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-calendar-event"></i>
                                <span>Khuyến mãi theo thời gian</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory Section -->
            <div class="nav-section">
                <div class="nav-section-title">Quản lý kho</div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="inventory-submenu"
                        data-tooltip="Tồn kho">
                        <i class="bi bi-boxes"></i>
                        <span>Tồn kho</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="inventory-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-list-ul"></i>
                                <span>Báo cáo tồn kho</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-exclamation-triangle"></i>
                                <span>Hàng sắp hết</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-arrow-up-right"></i>
                                <span>Xuất kho</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="import-submenu"
                        data-tooltip="Nhập hàng">
                        <i class="bi bi-truck"></i>
                        <span>Nhập hàng</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="import-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-plus-circle"></i>
                                <span>Tạo đơn nhập</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-list-ul"></i>
                                <span>Lịch sử nhập hàng</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-calendar-check"></i>
                                <span>Lịch nhập hàng</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-tooltip="Nhà cung cấp">
                        <i class="bi bi-building"></i>
                        <span>Nhà cung cấp</span>
                    </a>
                </div>
            </div>

            <!-- Marketing Section -->
            <div class="nav-section">
                <div class="nav-section-title">Marketing</div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="campaigns-submenu"
                        data-tooltip="Chiến dịch">
                        <i class="bi bi-megaphone"></i>
                        <span>Chiến dịch</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="campaigns-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-list-ul"></i>
                                <span>Tất cả chiến dịch</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-plus-circle"></i>
                                <span>Tạo chiến dịch</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-graph-up"></i>
                                <span>Thống kê hiệu suất</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-tooltip="Email Marketing">
                        <i class="bi bi-envelope"></i>
                        <span>Email Marketing</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="reviews-submenu"
                        data-tooltip="Đánh giá">
                        <i class="bi bi-star"></i>
                        <span>Đánh giá</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="reviews-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-list-ul"></i>
                                <span>Tất cả đánh giá</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-clock"></i>
                                <span>Chờ duyệt</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-star-fill"></i>
                                <span>Đánh giá 5 sao</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-flag"></i>
                                <span>Báo cáo vi phạm</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="nav-section">
                <div class="nav-section-title">Hệ thống</div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="settings-submenu"
                        data-tooltip="Cài đặt">
                        <i class="bi bi-gear"></i>
                        <span>Cài đặt</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="settings-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-shop"></i>
                                <span>Thông tin cửa hàng</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-credit-card"></i>
                                <span>Phương thức thanh toán</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-truck"></i>
                                <span>Vận chuyển</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-globe"></i>
                                <span>SEO & Website</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-tooltip="Bảo mật">
                        <i class="bi bi-shield-check"></i>
                        <span>Bảo mật</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link has-submenu" data-submenu="reports-submenu"
                        data-tooltip="Báo cáo">
                        <i class="bi bi-file-text"></i>
                        <span>Báo cáo</span>
                        <i class="bi bi-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="submenu" id="reports-submenu">
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-graph-up"></i>
                                <span>Báo cáo doanh thu</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-box-seam"></i>
                                <span>Báo cáo sản phẩm</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-people"></i>
                                <span>Báo cáo khách hàng</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-download"></i>
                                <span>Xuất báo cáo</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-tooltip="Hỗ trợ">
                        <i class="bi bi-question-circle"></i>
                        <span>Hỗ trợ</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content" id="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="header-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>

                <div class="search-box">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="search-input"
                        placeholder="Tìm kiếm sản phẩm, đơn hàng, khách hàng...">
                </div>
            </div>

            <div class="header-right">
                <button class="theme-toggle" id="themeToggle">
                    <i class="bi bi-sun-fill"></i>
                </button>

                <div class="dropdown">
                    <button class="notification-btn" id="notificationBtn">
                        <i class="bi bi-bell"></i>
                        <div class="notification-badge"></div>
                    </button>
                    <div class="dropdown-menu" id="notificationDropdown">
                        <div class="dropdown-header">
                            <span>Thông báo</span>
                            <span class="badge bg-primary ms-auto">5</span>
                        </div>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-item-icon" style="background: var(--gradient-success);">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="dropdown-item-content">
                                <h6>Đơn hàng mới</h6>
                                <p>Đơn hàng #12345 đã được đặt</p>
                            </div>
                            <div class="dropdown-item-time">2 phút trước</div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-item-icon" style="background: var(--gradient-warning);">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="dropdown-item-content">
                                <h6>Cảnh báo tồn kho</h6>
                                <p>MacBook Air M2 sắp hết hàng</p>
                            </div>
                            <div class="dropdown-item-time">15 phút trước</div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-item-icon" style="background: var(--gradient-primary);">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="dropdown-item-content">
                                <h6>Khách hàng mới</h6>
                                <p>Nguyễn Văn A đã đăng ký</p>
                            </div>
                            <div class="dropdown-item-time">1 giờ trước</div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-item-icon" style="background: var(--gradient-danger);">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="dropdown-item-content">
                                <h6>Đánh giá mới</h6>
                                <p>iPhone 15 Pro Max - 5 sao</p>
                            </div>
                            <div class="dropdown-item-time">2 giờ trước</div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="dropdown-item-icon" style="background: var(--gradient-success);">
                                <i class="bi bi-credit-card"></i>
                            </div>
                            <div class="dropdown-item-content">
                                <h6>Thanh toán thành công</h6>
                                <p>Đơn hàng #12344 đã thanh toán</p>
                            </div>
                            <div class="dropdown-item-time">3 giờ trước</div>
                        </a>
                        <div class="dropdown-footer">
                            <a href="#">Xem tất cả thông báo</a>
                        </div>
                    </div>
                </div>

                <div class="dropdown">
                    <div class="user-profile" id="userProfileBtn">
                        <div class="user-avatar">AD</div>
                        <div class="user-info">
                            <h6>Admin User</h6>
                            <small>Super Admin</small>
                        </div>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="dropdown-menu user-dropdown" id="userDropdown">
                        <div class="dropdown-header">
                            <div class="user-avatar-large">AD</div>
                            <div class="user-details">
                                <h6>Admin User</h6>
                                <small>admin@gearhub.com</small>
                            </div>
                        </div>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-person"></i>
                            <span>Thông tin cá nhân</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-gear"></i>
                            <span>Cài đặt tài khoản</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-bell"></i>
                            <span>Cài đặt thông báo</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-question-circle"></i>
                            <span>Trợ giúp & Hỗ trợ</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item theme-toggle-menu" id="themeToggleMenu">
                            <i class="bi bi-moon"></i>
                            <span>Chế độ tối</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item logout-item">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Đăng xuất</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Page Title -->
            <div class="page-title fade-in-up">
                <h1>Dashboard</h1>
                <p class="page-subtitle">Chào mừng trở lại! Đây là tổng quan về cửa hàng GearHub của bạn.</p>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card fade-in-up">
                    <div class="stat-header">
                        <div class="stat-title">Tổng doanh thu</div>
                        <div class="stat-icon primary">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                    </div>
                    <div class="stat-value">₫2,450,000</div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>+12.5% so với tháng trước</span>
                    </div>
                </div>

                <div class="stat-card success fade-in-up">
                    <div class="stat-header">
                        <div class="stat-title">Đơn hàng mới</div>
                        <div class="stat-icon success">
                            <i class="bi bi-bag-check"></i>
                        </div>
                    </div>
                    <div class="stat-value">156</div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>+8.2% so với tuần trước</span>
                    </div>
                </div>

                <div class="stat-card warning fade-in-up">
                    <div class="stat-header">
                        <div class="stat-title">Sản phẩm tồn kho</div>
                        <div class="stat-icon warning">
                            <i class="bi bi-boxes"></i>
                        </div>
                    </div>
                    <div class="stat-value">1,248</div>
                    <div class="stat-change negative">
                        <i class="bi bi-arrow-down"></i>
                        <span>-3.1% so với tháng trước</span>
                    </div>
                </div>

                <div class="stat-card danger fade-in-up">
                    <div class="stat-header">
                        <div class="stat-title">Khách hàng mới</div>
                        <div class="stat-icon danger">
                            <i class="bi bi-person-plus"></i>
                        </div>
                    </div>
                    <div class="stat-value">89</div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>+15.3% so với tuần trước</span>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="chart-grid">
                <div class="chart-card fade-in-up">
                    <div class="chart-header">
                        <div>
                            <h3 class="chart-title">Doanh thu theo tháng</h3>
                            <p class="chart-subtitle">Biểu đồ doanh thu 12 tháng gần đây</p>
                        </div>
                    </div>
                    <div class="chart-placeholder">
                        <i class="bi bi-bar-chart-line"></i>
                        <span style="margin-left: 12px;">Biểu đồ doanh thu sẽ được hiển thị ở đây</span>
                    </div>
                </div>

                <div class="chart-card fade-in-up">
                    <div class="chart-header">
                        <div>
                            <h3 class="chart-title">Hoạt động gần đây</h3>
                            <p class="chart-subtitle">Các hoạt động mới nhất</p>
                        </div>
                    </div>
                    <ul class="activity-list">
                        <li class="activity-item">
                            <div class="activity-icon" style="background: var(--gradient-success);">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Đơn hàng #12345 đã được xác nhận</h6>
                                <p>Khách hàng: Nguyễn Văn A</p>
                            </div>
                            <div class="activity-time">2 phút trước</div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon" style="background: var(--gradient-primary);">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Sản phẩm mới đã được thêm</h6>
                                <p>iPhone 15 Pro Max - 256GB</p>
                            </div>
                            <div class="activity-time">15 phút trước</div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon" style="background: var(--gradient-warning);">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Cảnh báo tồn kho thấp</h6>
                                <p>MacBook Air M2 - Chỉ còn 3 sản phẩm</p>
                            </div>
                            <div class="activity-time">1 giờ trước</div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon" style="background: var(--gradient-danger);">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Khách hàng mới đăng ký</h6>
                                <p>Trần Thị B - tranthib@email.com</p>
                            </div>
                            <div class="activity-time">2 giờ trước</div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon" style="background: var(--gradient-success);">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Đánh giá mới 5 sao</h6>
                                <p>Samsung Galaxy S24 Ultra</p>
                            </div>
                            <div class="activity-time">3 giờ trước</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        const themeIcon = themeToggle.querySelector('i');

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        html.setAttribute('data-bs-theme', savedTheme);
        updateThemeIcon(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            html.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
            updateMenuThemeIcon(newTheme);
        });

        function updateThemeIcon(theme) {
            if (theme === 'dark') {
                themeIcon.className = 'bi bi-sun-fill';
            } else {
                themeIcon.className = 'bi bi-moon-fill';
            }
        }

        function updateMenuThemeIcon(theme) {
            const menuThemeToggle = document.getElementById('themeToggleMenu');
            if (menuThemeToggle) {
                const menuIcon = menuThemeToggle.querySelector('i');
                const menuText = menuThemeToggle.querySelector('span');
                if (theme === 'dark') {
                    menuIcon.className = 'bi bi-sun';
                    menuText.textContent = 'Chế độ sáng';
                } else {
                    menuIcon.className = 'bi bi-moon';
                    menuText.textContent = 'Chế độ tối';
                }
            }
        }

        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        sidebarToggle.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        });

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Responsive sidebar handling
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            } else {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
            }
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.style.transform = 'scale(1.02)';
        });

        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.style.transform = 'scale(1)';
        });

        // Smooth animations for stats cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                }
            });
        }, observerOptions);

        // Observe all fade-in-up elements
        document.querySelectorAll('.fade-in-up').forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease';
            setTimeout(() => observer.observe(el), index * 50);
        });

        // Active nav link handling
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();

                // Handle submenu toggle
                if (link.classList.contains('has-submenu')) {
                    const submenuId = link.getAttribute('data-submenu');
                    const submenu = document.getElementById(submenuId);
                    const arrow = link.querySelector('.dropdown-arrow');

                    if (submenu.classList.contains('expanded')) {
                        submenu.classList.remove('expanded');
                        link.classList.remove('expanded');
                    } else {
                        // Close all other submenus
                        document.querySelectorAll('.submenu.expanded').forEach(openSubmenu => {
                            openSubmenu.classList.remove('expanded');
                        });
                        document.querySelectorAll('.nav-link.expanded').forEach(expandedLink => {
                            expandedLink.classList.remove('expanded');
                        });

                        // Open current submenu
                        submenu.classList.add('expanded');
                        link.classList.add('expanded');
                    }
                } else {
                    // Handle regular nav link
                    // Remove active class from all links
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));

                    // Add active class to clicked link
                    link.classList.add('active');
                }
            });
        });

        // Handle submenu items
        document.querySelectorAll('.submenu .nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                // Remove active class from all submenu links
                document.querySelectorAll('.submenu .nav-link').forEach(l => l.classList.remove('active'));

                // Add active class to clicked submenu link
                link.classList.add('active');
            });
        });

        // Sidebar search functionality
        function initSidebarSearch() {
            const searchInput = document.querySelector('.sidebar-search-input');
            const navItems = document.querySelectorAll('.nav-item');
            const navSections = document.querySelectorAll('.nav-section');

            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const searchTerm = e.target.value.toLowerCase().trim();

                    if (searchTerm === '') {
                        // Show all items
                        navItems.forEach(item => {
                            item.style.display = '';
                        });
                        navSections.forEach(section => {
                            section.style.display = '';
                        });
                    } else {
                        // Filter items
                        navSections.forEach(section => {
                            let hasVisibleItems = false;
                            const items = section.querySelectorAll('.nav-item');

                            items.forEach(item => {
                                const text = item.textContent.toLowerCase();
                                if (text.includes(searchTerm)) {
                                    item.style.display = '';
                                    hasVisibleItems = true;
                                } else {
                                    item.style.display = 'none';
                                }
                            });

                            // Show/hide section based on whether it has visible items
                            section.style.display = hasVisibleItems ? '' : 'none';
                        });
                    }
                });
            }
        }

        // Initialize dropdowns and search
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dropdown functionality
            initDropdowns();

            // Initialize sidebar search
            initSidebarSearch();

            // Initialize menu theme icon
            updateMenuThemeIcon(localStorage.getItem('theme') || 'dark');
        });

        // Dropdown functionality
        function initDropdowns() {
            // Get elements
            const notificationBtn = document.getElementById('notificationBtn');
            const notificationDropdown = document.getElementById('notificationDropdown');
            const userProfileBtn = document.getElementById('userProfileBtn');
            const userDropdown = document.getElementById('userDropdown');

            // Setup notification dropdown
            if (notificationBtn && notificationDropdown) {
                const notificationContainer = notificationDropdown.parentElement;

                notificationBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Close user dropdown
                    if (userDropdown) {
                        userDropdown.parentElement.classList.remove('show');
                    }

                    // Toggle notification dropdown
                    notificationContainer.classList.toggle('show');
                });

                // Handle notification dropdown items
                notificationDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });

                const notificationItems = notificationDropdown.querySelectorAll('.dropdown-item');
                notificationItems.forEach(item => {
                    item.addEventListener('click', function() {
                        setTimeout(() => {
                            notificationContainer.classList.remove('show');
                        }, 100);
                    });
                });
            }

            // Setup user dropdown  
            if (userProfileBtn && userDropdown) {
                const userContainer = userDropdown.parentElement;

                userProfileBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Close notification dropdown
                    if (notificationDropdown) {
                        notificationDropdown.parentElement.classList.remove('show');
                    }

                    // Toggle user dropdown
                    userContainer.classList.toggle('show');
                });

                // Handle user dropdown items
                userDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });

                const userItems = userDropdown.querySelectorAll('.dropdown-item');
                userItems.forEach(item => {
                    item.addEventListener('click', function(e) {
                        if (item.classList.contains('logout-item')) {
                            alert('Đăng xuất...');
                        } else if (item.classList.contains('theme-toggle-menu')) {
                            e.preventDefault();
                            // Toggle theme
                            const currentTheme = html.getAttribute('data-bs-theme');
                            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                            html.setAttribute('data-bs-theme', newTheme);
                            localStorage.setItem('theme', newTheme);
                            updateThemeIcon(newTheme);
                            updateMenuThemeIcon(newTheme);
                        }

                        setTimeout(() => {
                            userContainer.classList.remove('show');
                        }, 100);
                    });
                });
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                if (notificationDropdown) {
                    notificationDropdown.parentElement.classList.remove('show');
                }
                if (userDropdown) {
                    userDropdown.parentElement.classList.remove('show');
                }
            });
        } // Notification badge animation
        const notificationBadge = document.querySelector('.notification-badge');
        setInterval(() => {
            notificationBadge.style.animation = 'none';
            setTimeout(() => {
                notificationBadge.style.animation = 'pulse 2s infinite';
            }, 10);
        }, 3000);

        // Add pulse animation for notification badge
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0% { transform: scale(1); opacity: 1; }
                50% { transform: scale(1.2); opacity: 0.7; }
                100% { transform: scale(1); opacity: 1; }
            }
        `;
        document.head.appendChild(style);

        // Counter animation for stats
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);

            const timer = setInterval(() => {
                start += increment;
                if (start >= target) {
                    element.textContent = formatNumber(target);
                    clearInterval(timer);
                } else {
                    element.textContent = formatNumber(Math.floor(start));
                }
            }, 16);
        }

        function formatNumber(num) {
            if (num >= 1000000) {
                return (num / 1000000).toFixed(1) + 'M';
            } else if (num >= 1000) {
                return (num / 1000).toFixed(1) + 'k';
            }
            return num.toString();
        }

        // Initialize counter animations when cards are visible
        const statValues = document.querySelectorAll('.stat-value');
        const statObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const text = entry.target.textContent;
                    const number = parseInt(text.replace(/[^\d]/g, ''));
                    if (number) {
                        entry.target.textContent = '0';
                        animateCounter(entry.target, number);
                        statObserver.unobserve(entry.target);
                    }
                }
            });
        });

        statValues.forEach(value => statObserver.observe(value));
    </script>
</body>

</html>
