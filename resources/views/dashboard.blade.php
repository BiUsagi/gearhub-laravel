<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHub - Homepage Sections 2025</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #3b82f6;
            --success-green: #10b981;
            --warning-orange: #f59e0b;
            --danger-red: #ef4444;
            --purple-gradient: linear-gradient(135deg, #8b5cf6, #a855f7);
            --gold-color: #fbbf24;
        }

        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f8fafc;
            overflow-x: hidden;
        }

        /* 3. Social Proof Section */
        .social-proof {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            padding: 20px 0;
            position: relative;
            overflow: hidden;
        }

        .social-proof::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% { transform: translateX(-50px) translateY(-50px); }
            100% { transform: translateX(50px) translateY(50px); }
        }

        .proof-item {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .proof-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--gold-color);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .proof-text {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 5px;
        }

        /* 9. New Arrivals Section */
        .new-arrivals {
            background: white;
            padding: 80px 0;
            position: relative;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 20px;
            position: relative;
        }

        .section-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 50px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--purple-gradient);
            border-radius: 2px;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .product-image {
            position: relative;
            overflow: hidden;
            height: 200px;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .new-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--danger-red);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            animation: pulse-badge 2s infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .product-info {
            padding: 20px;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--danger-red);
            margin-bottom: 15px;
        }

        .product-rating {
            margin-bottom: 15px;
        }

        .product-rating .stars {
            color: var(--gold-color);
            margin-right: 5px;
        }

        .product-rating .count {
            color: #64748b;
            font-size: 0.9rem;
        }

        .product-actions {
            display: flex;
            gap: 10px;
        }

        .btn-add-cart {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-add-cart:hover {
            background: var(--secondary-blue);
            transform: translateY(-2px);
        }

        .btn-quick-view {
            background: transparent;
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            padding: 10px 15px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-quick-view:hover {
            background: var(--primary-blue);
            color: white;
        }

        /* 10. Brand Showcase */
        .brand-showcase {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 80px 0;
            position: relative;
        }

        .brand-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .brand-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .brand-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .brand-card:hover::before {
            left: 100%;
        }

        .brand-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-blue);
        }

        .brand-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .brand-products {
            color: #64748b;
            font-size: 0.9rem;
        }

        /* 11. Policies Section */
        .policies-section {
            background: white;
            padding: 80px 0;
            position: relative;
        }

        .policy-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .policy-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .policy-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--purple-gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .policy-card:hover::before {
            transform: scaleX(1);
        }

        .policy-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .policy-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: var(--purple-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
        }

        .policy-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 15px;
        }

        .policy-description {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .policy-features {
            list-style: none;
            padding: 0;
        }

        .policy-features li {
            color: #10b981;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .policy-features li::before {
            content: '✓';
            color: #10b981;
            font-weight: bold;
            margin-right: 8px;
        }

        /* 12. Payment & Security */
        .payment-security {
            background: linear-gradient(135deg, #1e293b, #334155);
            color: white;
            padding: 80px 0;
            position: relative;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .payment-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px 20px;
            border-radius: 15px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .payment-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .payment-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--gold-color);
        }

        .payment-name {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .payment-desc {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .security-badges {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .security-badge {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px 25px;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* 13. Blog Section */
        .blog-section {
            background: white;
            padding: 80px 0;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .blog-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .blog-image {
            position: relative;
            height: 200px;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            overflow: hidden;
        }

        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-card:hover .blog-image img {
            transform: scale(1.1);
        }

        .blog-category {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary-blue);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .blog-content {
            padding: 25px;
        }

        .blog-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .blog-excerpt {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .blog-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .blog-author {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .author-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .blog-date {
            color: #64748b;
            font-size: 0.9rem;
        }

        .blog-read-more {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .blog-read-more:hover {
            color: var(--secondary-blue);
            transform: translateX(5px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
            
            .proof-number {
                font-size: 1.5rem;
            }
            
            .proof-text {
                font-size: 0.8rem;
            }
            
            .product-card {
                margin-bottom: 20px;
            }
            
            .brand-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 20px;
            }
            
            .policy-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .payment-grid {
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 20px;
            }
            
            .blog-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- 3. Social Proof Section -->
    <section class="social-proof">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="proof-item">
                        <div class="proof-number">50,000+</div>
                        <div class="proof-text">
                            <i class="fas fa-users me-1"></i>
                            Khách hàng tin tưởng
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="proof-item">
                        <div class="proof-number">99.5%</div>
                        <div class="proof-text">
                            <i class="fas fa-star me-1"></i>
                            Đánh giá tích cực
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="proof-item">
                        <div class="proof-number">24/7</div>
                        <div class="proof-text">
                            <i class="fas fa-headset me-1"></i>
                            Hỗ trợ kỹ thuật
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="proof-item">
                        <div class="proof-number">2H</div>
                        <div class="proof-text">
                            <i class="fas fa-shipping-fast me-1"></i>
                            Giao hàng nội thành
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. New Arrivals Section -->
    <section class="new-arrivals">
        <div class="container">
            <h2 class="section-title">Sản Phẩm Mới Nhất</h2>
            <p class="section-subtitle">Cập nhật những công nghệ tiên tiến nhất từ các thương hiệu hàng đầu</p>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <div class="new-badge">
                                <i class="fas fa-star me-1"></i>NEW
                            </div>
                            <img src="https://via.placeholder.com/300x200/e2e8f0/64748b?text=Gaming+Laptop" alt="Gaming Laptop">
                        </div>
                        <div class="product-info">
                            <h5 class="product-name">ASUS ROG Strix G16 2025</h5>
                            <div class="product-price">29.990.000đ</div>
                            <div class="product-rating">
                                <span class="stars">★★★★★</span>
                                <span class="count">(4.8/5 - 124 đánh giá)</span>
                            </div>
                            <div class="product-actions">
                                <button class="btn-add-cart">
                                    <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                </button>
                                <button class="btn-quick-view">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <div class="new-badge">
                                <i class="fas fa-fire me-1"></i>HOT
                            </div>
                            <img src="https://via.placeholder.com/300x200/e2e8f0/64748b?text=Gaming+Mouse" alt="Gaming Mouse">
                        </div>
                        <div class="product-info">
                            <h5 class="product-name">Logitech G Pro X Superlight 2</h5>
                            <div class="product-price">3.290.000đ</div>
                            <div class="product-rating">
                                <span class="stars">★★★★★</span>
                                <span class="count">(4.9/5 - 89 đánh giá)</span>
                            </div>
                            <div class="product-actions">
                                <button class="btn-add-cart">
                                    <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                </button>
                                <button class="btn-quick-view">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <div class="new-badge">
                                <i class="fas fa-bolt me-1"></i>FAST
                            </div>
                            <img src="https://via.placeholder.com/300x200/e2e8f0/64748b?text=Mechanical+Keyboard" alt="Mechanical Keyboard">
                        </div>
                        <div class="product-info">
                            <h5 class="product-name">Keychron K3 Pro Max</h5>
                            <div class="product-price">4.590.000đ</div>
                            <div class="product-rating">
                                <span class="stars">★★★★★</span>
                                <span class="count">(4.7/5 - 156 đánh giá)</span>
                            </div>
                            <div class="product-actions">
                                <button class="btn-add-cart">
                                    <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                </button>
                                <button class="btn-quick-view">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <div class="new-badge">
                                <i class="fas fa-crown me-1"></i>PRO
                            </div>
                            <img src="https://via.placeholder.com/300x200/e2e8f0/64748b?text=Gaming+Headset" alt="Gaming Headset">
                        </div>
                        <div class="product-info">
                            <h5 class="product-name">SteelSeries Arctis Nova Pro</h5>
                            <div class="product-price">8.990.000đ</div>
                            <div class="product-rating">
                                <span class="stars">★★★★★</span>
                                <span class="count">(4.8/5 - 203 đánh giá)</span>
                            </div>
                            <div class="product-actions">
                                <button class="btn-add-cart">
                                    <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                </button>
                                <button class="btn-quick-view">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. Brand Showcase -->
    <section class="brand-showcase">
        <div class="container">
            <h2 class="section-title">Thương Hiệu Chính Hãng</h2>
            <p class="section-subtitle">Đối tác tin cậy từ những thương hiệu công nghệ hàng đầu thế giới</p>
            
            <div class="brand-grid">
                <div class="brand-card">
                    <div class="brand-logo">🍎</div>
                    <div class="brand-name">Apple</div>
                    <div class="brand-products">MacBook, iPhone, iPad</div>
                </div>
                
                <div class="brand-card">
                    <div class="brand-logo">📱</div>
                    <div class="brand-name">Samsung</div>
                    <div class="brand-products">Galaxy, Monitor, SSD</div>
                </div>
                
                <div class="brand-card">
                    <div class="brand-logo">🖱️</div>
                    <div class="brand-name">Logitech</div>
                    <div class="brand-products">Mouse, Keyboard, Webcam</div>
                </div>
                
                <div class="brand-card">
                    <div class="brand-logo">🐍</div>
                    <div class="brand-name">Razer</div>
                    <div class="brand-products">Gaming Gear, Laptop</div>
                </div>
                
                <div class="brand-card">
                    <div class="brand-logo">💻</div>
                    <div class="brand-name">ASUS</div>
                    <div class="brand-products">ROG, Laptop, Monitor</div>
                </div>
                
                <div class="brand-card">
                    <div class="brand-logo">🔥</div>
                    <div class="brand-name">MSI</div>
                    <div class="brand-products">Gaming Laptop, GPU</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 11. Policies Section -->
    <section class="policies-section">
        <div class="container">
            <h2 class="section-title">Chính Sách Vượt Trội</h2>
            <p class="section-subtitle">Cam kết mang đến trải nghiệm mua sắm tuyệt vời nhất</p>
            
            <div class="policy-grid">
                <div class="policy-card">
                    <div class="policy-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="policy-title">Bảo Hành Tận Nhà</h4>
                    <p class="policy-description">
                        Kỹ thuật viên chuyên nghiệp đến tận nơi sửa chữa, bảo hành trong vòng 24h
                    </p>
                    <ul class="policy-features">
                        <li>Miễn phí vận chuyển</li>
                        <li>Bảo hành chính hãng 24 tháng</li>
                        <li>Hỗ trợ kỹ thuật chuyên sâu</li>
                    </ul>
                </div>
                
                <div class="policy-card">
                    <div class="policy-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h4 class="policy-title">Trả Góp 0% Lãi Suất</h4>
                    <p class="policy-description">
                        Hỗ trợ trả góp qua thẻ tín dụng và công ty tài chính uy tín
                    </p>
                    <ul class="policy-features">
                        <li>Duyệt nhanh chỉ 15 phút</li>
                        <li>Không phí phát sinh</li>
                        <li>Linh hoạt kỳ hạn thanh toán</li>
                    </ul>
                </div>
                
                <div class="policy-card">
                    <div class="policy-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h4 class="policy-title">Đổi Mới Trong 7 Ngày</h4>
                    <p class="policy-description">
                        Đổi sản phẩm mới 100% nếu có lỗi từ nhà sản xuất
                    </p>
                    <ul class="policy-features">
                        <li>Thời gian đổi trả linh hoạt</li>
                        <li>Miễn phí vận chuyển</li>
                        <li>Hỗ trợ đổi trả nhanh chóng</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>