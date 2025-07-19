@extends('layouts.app')

@section('content')
    <!-- Banner -->
    <section class="hero " id="home">
        <div class="container ">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title fade-in">Công Nghệ Chính Hãng - Giá Tốt Nhất</h1>
                    <p class="hero-subtitle fade-in">Bảo hành 24 tháng - Giao hàng miễn phí - Đổi trả 30 ngày</p>
                    <div class="d-flex gap-3 fade-in">
                        <a href="#products" class="btn btn-primary">
                            Khám phá ngay
                        </a>
                        <a href="#features" class="btn btn-outline-primary align-content-center">
                            Tư vấn miễn phí
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image text-center fade-in">
                        <img src="storage/banner/banner1.jpg" alt="Hero Image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hiệu suất -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number" data-count="50000">0</div>
                        <div class="stat-label">
                            <i class="fas fa-users me-2"></i>
                            Khách hàng tin tưởng
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number" data-count="99.5">0</div>
                        <div class="stat-label">
                            <i class="fas fa-star me-2"></i>
                            % Đánh giá tích cực
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number" data-count="24">0</div>
                        <div class="stat-label">
                            <i class="fas fa-clock me-2"></i>
                            Giờ hỗ trợ kỹ thuật
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number" data-count="30">0</div>
                        <div class="stat-label">
                            <i class="fas fa-undo me-2"></i>
                            Ngày đổi trả miễn phí
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Flash Sale -->
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
                @foreach ($saleProducts as $product)
                    <div class="col-lg-3 col-md-6">
                        <div class="flash-card fade-in">
                            <div class="flash-badge">-40%</div>
                            <img src="{{ asset('storage/' . $product->mainImage->image_path) }}" alt="Flash Sale"
                                class="flash-image">
                            <div class="flash-progress">
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                                </div>
                                <small class="text-danger">Đã bán 15/20</small>
                            </div>
                            <h3 class="flash-title">{{ $product->name }}</h3>
                            <div class="flash-price">
                                <span class="new-price">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                                <span class="old-price">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                            </div>
                            <button class="btn btn-danger w-100 mt-3">
                                <i class="fas fa-cart-plus me-2"></i>Mua ngay
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Danh mục -->
    <section class="py-5 mt-5">
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

    <!-- Sản phẩm bán chạy -->
    <section class="py-5 bg-light" id="products">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6 text-center">
                    <h2 class="display-5 fw-bold mb-3 fade-in">Sản Phẩm Nổi Bật</h2>
                    <p class="text-secondary fade-in">Khám phá những sản phẩm công nghệ được mua nhiều nhất</p>
                </div>
            </div>
            <div class="row">
                @foreach ($bestSelling as $product)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="hover-wrapper">
                            <div class="product-card fade-in">
                                <div class="new-badge">
                                    <i class="fas fa-fire me-1"></i>HOT
                                </div>
                                <img src="{{ asset('storage/' . $product->mainImage->image_path) }}" alt="Product"
                                    class="product-image">
                                <div class="product-category">{{ $product->category->name }}</div>
                                <h3 class="product-title">{{ $product->name }}</h3>
                                <div class="review-stars mb-1">
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <span class="text-secondary px-2"><small>(4.8/5 - 10.234
                                            đánh giá)</small></span>
                                </div>
                                <div class="mb-2"><span class="text-secondary">Còn {{ $product->stock }} sản phẩm</span>
                                </div>
                                <div class="flash-price mb-3">
                                    @if ($product->sale_price > 0 && $product->sale_price < $product->price)
                                        <span
                                            class="new-price">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                                        <span class="old-price">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                    @else
                                        <span class="new-price">{{ number_format($product->price, 0, ',', '.') }}₫
                                        </span>
                                    @endif
                                </div>
                                <div class="product-actions">
                                    <button class="btn-add-cart">
                                        <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                    </button>
                                    <button class="btn-quick-wishlist">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-primary">Xem tất cả sản phẩm</a>
            </div>
        </div>
    </section>

    <!-- Nhấn mạnh -->
    <section class="py-3" id="features">
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

    <!-- Đánh giá -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6 text-center">
                    <h2 class="display-6 fw-bold mb-3 fade-in">Khách Hàng Nói Gì?</h2>
                    <p class="text-secondary fade-in">Đánh giá từ những khách hàng đã mua sắm tại GearHub</p>
                </div>
            </div>
            <div class="row">
                @foreach ($topReviews as $review)
                    <div class="col-lg-4 mb-4">
                        <div class="review-card fade-in">
                            <div class="review-stars mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="review-text">"{{ $review->comment }}"</p>
                            <div class="review-author d-flex align-items-center">
                                <img src="{{ asset('/storage/user/' . $review->user->avatar) }}" alt="Avatar"
                                    class="review-avatar">
                                <div class="ms-3">
                                    <h6 class="mb-1">{{ $review->user->name }}</h6>
                                    <small class="text-secondary">{{ $review->product->name }}</small>
                                    <div class="review-likes">
                                        <i class="fas fa-thumbs-up"></i> {{ $review->likes_count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Sản phẩm mới -->
    <section class="new-arrivals">
        <div class="container">
            <h2 class="section-title">Sản Phẩm Mới Nhất</h2>
            <p class="section-subtitle">Cập nhật những công nghệ tiên tiến nhất từ các thương hiệu hàng đầu</p>
            <div class="row">
                @foreach ($newProducts as $product)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="hover-wrapper">
                            <div class="product-card fade-in">
                                <div class="new-badge">
                                    <i class="fas fa-star me-1"></i>NEW
                                </div>
                                <img src={{ asset('storage/' . $product->mainImage->image_path) }} alt="Product"
                                    class="product-image">
                                <div class="product-category">{{ $product->category->name }}</div>
                                <h3 class="product-title">{{ $product->name }}</h3>
                                <div class="review-stars mb-1">
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <span class="text-secondary px-2"><small>(4.8/5 - 10.234
                                            đánh giá)</small></span>
                                </div>
                                <div class="mb-2"><span class="text-secondary">Còn {{ $product->stock }} sản
                                        phẩm</span></div>
                                <div class="flash-price mb-3">
                                    @if ($product->sale_price > 0 && $product->sale_price < $product->price)
                                        <span
                                            class="new-price">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                                        <span class="old-price">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                    @else
                                        <span class="new-price">{{ number_format($product->price, 0, ',', '.') }}₫
                                        </span>
                                    @endif
                                </div>
                                <div class="product-actions">
                                    <button class="btn-add-cart">
                                        <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                    </button>
                                    <button class="btn-quick-wishlist">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-primary">Xem tất cả sản phẩm</a>
            </div>
        </div>
    </section>

    <!-- Thương hiệu nổi bật -->
    <section class="brand-showcase">
        <div class="container">
            <h2 class="section-title">Thương Hiệu Nổi Bật</h2>
            <p class="section-subtitle">Đối tác tin cậy từ những thương hiệu công nghệ hàng đầu thế giới</p>

            <div class="brand-grid">
                @foreach ($brands as $brand)
                    <div class="brand-card">
                        <div class="brand-logo">
                            <img src="{{ asset('storage/brands/' . $brand->logo) }}" alt="{{ $brand->name }}">
                        </div>
                        <div class="brand-name">{{ $brand->name }}</div>
                        <div class="brand-products">{{ $brand->description }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


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

                <div class="policy-card">
                    <div class="policy-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4 class="policy-title">Hotline 24/7</h4>
                    <p class="policy-description">
                        Hỗ trợ khách hàng nhanh chóng và hiệu quả
                    </p>
                    <ul class="policy-features">
                        <li>Thời gian phản hồi nhanh</li>
                        <li>Hỗ trợ qua điện thoại và chat</li>
                        <li>Đội ngũ chuyên viên tận tâm</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Đăng ký nhận tin -->
    <section class="newsletter" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="newsletter-form text-center">
                        <h2 class="display-6 fw-bold mb-3 fade-in">Nhận Ưu Đãi Độc Quyền</h2>
                        <p class="text-secondary mb-4 fade-in">Giảm 10% đơn đầu + Thông báo flash sale sớm nhất
                        </p>
                        <form class="d-flex gap-2 fade-in">
                            <input type="email" class="form-control" placeholder="Nhập email để nhận voucher 100k">
                            <button class="btn btn-primary px-4">Nhận ngay ưu đãi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tác vụ nhanh -->
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
