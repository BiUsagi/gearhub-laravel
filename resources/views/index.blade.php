@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero " id="home">
        <div class="container ">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title fade-in">Nâng Tầm Công Nghệ Cuộc Sống</h1>
                    <p class="hero-subtitle fade-in">Khám phá bộ sưu tập sản phẩm công nghệ cao cấp, được tuyển chọn kỹ
                        lưỡng để mang đến trải nghiệm tốt nhất cho người dùng.</p>
                    <div class="d-flex gap-3 fade-in">
                        <a href="#products" class="btn btn-primary">
                            Khám phá ngay
                        </a>
                        <a href="#features" class="btn btn-outline-primary align-content-center">
                            Tìm hiểu thêm
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image text-center fade-in">
                        <img src="images/banner/banner1.jpg" alt="Hero Image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5" id="features">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6 text-center">
                    <h2 class="display-5 fw-bold mb-3 fade-in">Tại Sao Chọn TechHub?</h2>
                    <p class="text-secondary fade-in">Chúng tôi cam kết mang đến những sản phẩm và dịch vụ tốt nhất</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h3 class="feature-title">Giao Hàng Nhanh</h3>
                        <p class="feature-description">Miễn phí giao hàng toàn quốc cho đơn hàng từ 500.000đ</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3 class="feature-title">Chất Lượng Cao</h3>
                        <p class="feature-description">Sản phẩm chính hãng với chế độ bảo hành tận tâm</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="feature-title">Hỗ Trợ 24/7</h3>
                        <p class="feature-description">Đội ngũ chuyên viên luôn sẵn sàng hỗ trợ bạn</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6 text-center">
                    <h2 class="display-6 fw-bold mb-3 fade-in">Danh Mục Sản Phẩm</h2>
                    <p class="text-secondary fade-in">Tìm kiếm theo danh mục yêu thích của bạn</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="category-card text-center fade-in">
                        <div class="category-icon">
                            <i class="fas fa-headphones"></i>
                        </div>
                        <h6 class="mt-3">Tai Nghe</h6>
                        <small class="text-secondary">86 sản phẩm</small>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="category-card text-center fade-in">
                        <div class="category-icon">
                            <i class="fas fa-keyboard"></i>
                        </div>
                        <h6 class="mt-3">Bàn Phím</h6>
                        <small class="text-secondary">45 sản phẩm</small>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="category-card text-center fade-in">
                        <div class="category-icon">
                            <i class="fas fa-mouse"></i>
                        </div>
                        <h6 class="mt-3">Chuột</h6>
                        <small class="text-secondary">38 sản phẩm</small>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="category-card text-center fade-in">
                        <div class="category-icon">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <h6 class="mt-3">Linh Kiện</h6>
                        <small class="text-secondary">124 sản phẩm</small>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="category-card text-center fade-in">
                        <div class="category-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <h6 class="mt-3">Gaming</h6>
                        <small class="text-secondary">93 sản phẩm</small>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="category-card text-center fade-in">
                        <div class="category-icon">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                        <h6 class="mt-3">Khác</h6>
                        <small class="text-secondary">57 sản phẩm</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Flash Sale Section -->
    <section class="flash-sale py-5">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center">
                        <h2 class="display-6 fw-bold mb-0 me-4 fade-in">
                            <i class="fas fa-bolt text-warning me-2"></i>Flash Sale
                        </h2>
                        <div class="countdown d-flex gap-3 fade-in">
                            <div class="countdown-item">
                                <div class="countdown-number">02</div>
                                <div class="countdown-label">Giờ</div>
                            </div>
                            <div class="countdown-item">
                                <div class="countdown-number">45</div>
                                <div class="countdown-label">Phút</div>
                            </div>
                            <div class="countdown-item">
                                <div class="countdown-number">30</div>
                                <div class="countdown-label">Giây</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <a href="#" class="btn btn-outline-primary">Xem tất cả</a>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="flash-card fade-in">
                        <div class="flash-badge">-40%</div>
                        <img src="uploads/products/tai-nghe-gaming-pro.png" alt="Flash Sale" class="flash-image">
                        <div class="flash-progress">
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: 75%"></div>
                            </div>
                            <small class="text-danger">Đã bán 15/20</small>
                        </div>
                        <h3 class="flash-title">Tai nghe Gaming Pro</h3>
                        <div class="flash-price">
                            <span class="new-price">890.000₫</span>
                            <span class="old-price">1.490.000₫</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="flash-card fade-in">
                        <div class="flash-badge">-35%</div>
                        <img src="uploads/products/aula-f75.webp" alt="Flash Sale" class="flash-image">
                        <div class="flash-progress">
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: 60%"></div>
                            </div>
                            <small class="text-danger">Đã bán 12/20</small>
                        </div>
                        <h3 class="flash-title">Bàn phím cơ RGB</h3>
                        <div class="flash-price">
                            <span class="new-price">1.290.000₫</span>
                            <span class="old-price">1.990.000₫</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="flash-card fade-in">
                        <div class="flash-badge">-50%</div>
                        <img src="uploads/products/chuot-khong-day.jpg" alt="Flash Sale" class="flash-image">
                        <div class="flash-progress">
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: 90%"></div>
                            </div>
                            <small class="text-danger">Đã bán 18/20</small>
                        </div>
                        <h3 class="flash-title">Chuột không dây</h3>
                        <div class="flash-price">
                            <span class="new-price">495.000₫</span>
                            <span class="old-price">990.000₫</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="flash-card fade-in">
                        <div class="flash-badge">-30%</div>
                        <img src="uploads/products/balo-gaming.png" alt="Flash Sale" class="flash-image">
                        <div class="flash-progress">
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: 45%"></div>
                            </div>
                            <small class="text-danger">Đã bán 9/20</small>
                        </div>
                        <h3 class="flash-title">Balo Gaming</h3>
                        <div class="flash-price">
                            <span class="new-price">699.000₫</span>
                            <span class="old-price">999.000₫</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5 bg-light" id="products">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6 text-center">
                    <h2 class="display-5 fw-bold mb-3 fade-in">Sản Phẩm Nổi Bật</h2>
                    <p class="text-secondary fade-in">Khám phá những sản phẩm công nghệ mới nhất</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="hover-wrapper">
                        <div class="product-card fade-in">
                            <img src="uploads/products/tai-nghe-gaming-pro.png" alt="Product" class="product-image">
                            <div class="product-category">Tai nghe</div>
                            <h3 class="product-title">Tai nghe không dây Pro Max</h3>
                            <div class="product-price">2.990.000₫</div>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="hover-wrapper">
                        <div class="product-card fade-in">
                            <img src="uploads/products/sac-du-phong.webp" alt="Product" class="product-image">
                            <div class="product-category">Sạc dự phòng</div>
                            <h3 class="product-title">Pin sạc dự phòng 20000mAh</h3>
                            <div class="product-price">890.000₫</div>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="hover-wrapper">
                        <div class="product-card fade-in">
                            <img src="uploads/products/aula-f75.webp" alt="Product" class="product-image">
                            <div class="product-category">Bàn phím</div>
                            <h3 class="product-title">Bàn phím cơ Gaming RGB</h3>
                            <div class="product-price">1.990.000₫</div>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="hover-wrapper">
                        <div class="product-card fade-in">
                            <img src="uploads/products/chuot-khong-day.jpg" alt="Product" class="product-image">
                            <div class="product-category">Chuột</div>
                            <h3 class="product-title">Chuột gaming không dây</h3>
                            <div class="product-price">1.290.000₫</div>
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-primary">Xem tất cả sản phẩm</a>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6 text-center">
                    <h2 class="display-6 fw-bold mb-3 fade-in">Khách Hàng Nói Gì?</h2>
                    <p class="text-secondary fade-in">Đánh giá từ những khách hàng đã mua sắm tại TechHub</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="review-card fade-in">
                        <div class="review-stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"Chất lượng sản phẩm tuyệt vời, đóng gói cẩn thận. Shop tư vấn nhiệt
                            tình, sẽ ủng hộ dài dài!"</p>
                        <div class="review-author d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" alt="Avatar" class="review-avatar">
                            <div class="ms-3">
                                <h6 class="mb-1">Nguyễn Văn A</h6>
                                <small class="text-secondary">Khách hàng thân thiết</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="review-card fade-in">
                        <div class="review-stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"Giao hàng nhanh, sản phẩm chính hãng 100%. Đặc biệt là chế độ bảo hành
                            rất tốt!"</p>
                        <div class="review-author d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" alt="Avatar" class="review-avatar">
                            <div class="ms-3">
                                <h6 class="mb-1">Trần Thị B</h6>
                                <small class="text-secondary">Đã mua 5 sản phẩm</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="review-card fade-in">
                        <div class="review-stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="review-text">"Giá cả hợp lý, dịch vụ chăm sóc khách hàng tận tâm. Rất hài lòng với
                            trải nghiệm mua sắm!"</p>
                        <div class="review-author d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" alt="Avatar" class="review-avatar">
                            <div class="ms-3">
                                <h6 class="mb-1">Lê Văn C</h6>
                                <small class="text-secondary">Khách hàng mới</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="newsletter-form text-center">
                        <h2 class="display-6 fw-bold mb-3 fade-in">Đăng Ký Nhận Tin</h2>
                        <p class="text-secondary mb-4 fade-in">Nhận thông tin về sản phẩm mới và khuyến mãi đặc biệt
                        </p>
                        <form class="d-flex gap-2 fade-in">
                            <input type="email" class="form-control" placeholder="Địa chỉ email của bạn">
                            <button class="btn btn-primary px-4">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Action Buttons -->
    <div class="floating-buttons">
        <button class="floating-button" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
            <i class="fas fa-arrow-up"></i>
        </button>
        <button class="floating-button" onclick="alert('Chat feature coming soon!')">
            <i class="fas fa-comment-dots"></i>
        </button>
        <button class="floating-button" onclick="alert('Cart feature coming soon!')">
            <i class="fas fa-shopping-cart"></i>
        </button>
    </div>
@endsection
