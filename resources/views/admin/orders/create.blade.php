@extends('admin.layouts.app')

@section('title', 'Tạo đơn hàng mới')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/orders/create.css') }}">
@endpush

@section('content')
    <div class="container-fluid p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="fade-in-up">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/orders">Đơn hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tạo đơn hàng mới</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header fade-in-up">
            <div class="header-main">
                <h1 class="page-title">
                    <i class="bi bi-plus-circle-fill text-primary me-3"></i>
                    Tạo đơn hàng mới
                </h1>
                <p class="page-subtitle">Tạo đơn hàng cho khách hàng một cách nhanh chóng và dễ dàng</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline-secondary" id="saveDraftBtn">
                    <i class="bi bi-bookmark me-2"></i>
                    Lưu nháp
                </button>
                <button class="btn btn-success" id="createOrderBtn">
                    <i class="bi bi-check-circle me-2"></i>
                    Tạo đơn hàng
                </button>
            </div>
        </div>

        <div class="row">
            {{-- Left Column - Order Details --}}
            <div class="col-lg-8">
                {{-- Customer Selection --}}
                <div class="create-card fade-in-up">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-person-fill me-2"></i>
                            Thông tin khách hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="customer-selection">
                            <div class="search-customer">
                                <label class="form-label">Tìm kiếm khách hàng</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" class="form-control" id="customerSearch"
                                        placeholder="Tìm theo tên, email, số điện thoại...">
                                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#newCustomerModal">
                                        <i class="bi bi-person-plus"></i>
                                        Khách hàng mới
                                    </button>
                                </div>
                                <div class="customer-suggestions" id="customerSuggestions">
                                    <!-- Customer suggestions will appear here -->
                                </div>
                            </div>

                            <div class="selected-customer" id="selectedCustomer" style="display: none;">
                                <div class="customer-card">
                                    <div class="customer-avatar">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div class="customer-info">
                                        <h6 class="customer-name">Nguyễn Văn Anh</h6>
                                        <p class="customer-email">nguyenvananh@email.com</p>
                                        <p class="customer-phone">0912345678</p>
                                        <span class="customer-type badge bg-primary">Khách VIP</span>
                                    </div>
                                    <button class="btn btn-sm btn-outline-danger" id="removeCustomer">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Product Selection --}}
                <div class="create-card fade-in-up">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-box-seam me-2"></i>
                            Sản phẩm
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="product-search">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" class="form-control" id="productSearch"
                                    placeholder="Tìm kiếm sản phẩm theo tên, mã SKU...">
                                <button class="btn btn-outline-primary" type="button" id="scanBarcodeBtn">
                                    <i class="bi bi-upc-scan"></i>
                                    Quét mã vạch
                                </button>
                            </div>
                        </div>

                        <div class="selected-products" id="selectedProducts">
                            <!-- Sample products -->
                            <div class="product-item" data-product-id="1">
                                <div class="product-image">
                                    <img src="https://via.placeholder.com/60x60/007bff/ffffff?text=IP15"
                                        alt="iPhone 15 Pro">
                                </div>
                                <div class="product-details">
                                    <h6 class="product-name">iPhone 15 Pro 128GB</h6>
                                    <p class="product-sku">SKU: IP15-PRO-128</p>
                                    <p class="product-stock">Tồn kho: <span class="text-success">25 sản phẩm</span></p>
                                </div>
                                <div class="product-quantity">
                                    <label class="form-label">Số lượng</label>
                                    <div class="quantity-control">
                                        <button class="btn btn-sm btn-outline-secondary qty-minus">-</button>
                                        <input type="number" class="form-control quantity-input" value="1"
                                            min="1">
                                        <button class="btn btn-sm btn-outline-secondary qty-plus">+</button>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <label class="form-label">Đơn giá</label>
                                    <input type="text" class="form-control price-input" value="28,990,000">
                                </div>
                                <div class="product-total">
                                    <span class="total-label">Thành tiền</span>
                                    <span class="total-amount">₫28,990,000</span>
                                </div>
                                <div class="product-actions">
                                    <button class="btn btn-sm btn-outline-danger remove-product">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="product-item" data-product-id="2">
                                <div class="product-image">
                                    <img src="https://via.placeholder.com/60x60/28a745/ffffff?text=AP" alt="AirPods Pro">
                                </div>
                                <div class="product-details">
                                    <h6 class="product-name">AirPods Pro (2nd Gen)</h6>
                                    <p class="product-sku">SKU: APP-2ND-GEN</p>
                                    <p class="product-stock">Tồn kho: <span class="text-success">15 sản phẩm</span></p>
                                </div>
                                <div class="product-quantity">
                                    <label class="form-label">Số lượng</label>
                                    <div class="quantity-control">
                                        <button class="btn btn-sm btn-outline-secondary qty-minus">-</button>
                                        <input type="number" class="form-control quantity-input" value="1"
                                            min="1">
                                        <button class="btn btn-sm btn-outline-secondary qty-plus">+</button>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <label class="form-label">Đơn giá</label>
                                    <input type="text" class="form-control price-input" value="6,490,000">
                                </div>
                                <div class="product-total">
                                    <span class="total-label">Thành tiền</span>
                                    <span class="total-amount">₫6,490,000</span>
                                </div>
                                <div class="product-actions">
                                    <button class="btn btn-sm btn-outline-danger remove-product">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="add-product-placeholder" id="addProductPlaceholder">
                            <div class="placeholder-content">
                                <i class="bi bi-plus-circle"></i>
                                <p>Tìm kiếm và thêm sản phẩm vào đơn hàng</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Shipping & Notes --}}
                <div class="create-card fade-in-up">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-truck me-2"></i>
                            Vận chuyển & Ghi chú
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phương thức vận chuyển</label>
                                    <select class="form-select" id="shippingMethod">
                                        <option value="standard">Giao hàng tiêu chuẩn (2-3 ngày)</option>
                                        <option value="express">Giao hàng nhanh (1-2 ngày)</option>
                                        <option value="same_day">Giao hàng trong ngày</option>
                                        <option value="pickup">Nhận tại cửa hàng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phí vận chuyển</label>
                                    <input type="text" class="form-control" id="shippingFee" value="50,000">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ giao hàng</label>
                            <textarea class="form-control" rows="3" id="shippingAddress" placeholder="Nhập địa chỉ giao hàng...">123 Đường ABC, Phường XYZ, Quận 1, TP.HCM</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ghi chú đơn hàng</label>
                            <textarea class="form-control" rows="3" id="orderNotes" placeholder="Ghi chú thêm cho đơn hàng..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column - Order Summary --}}
            <div class="col-lg-4">
                <div class="order-summary-sticky">
                    {{-- Order Summary --}}
                    <div class="create-card fade-in-up">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="bi bi-receipt me-2"></i>
                                Tóm tắt đơn hàng
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="summary-row">
                                <span>Tạm tính:</span>
                                <span class="subtotal">₫35,480,000</span>
                            </div>
                            <div class="summary-row">
                                <span>Phí vận chuyển:</span>
                                <span class="shipping-cost">₫50,000</span>
                            </div>
                            <div class="summary-row">
                                <span>Giảm giá:</span>
                                <span class="discount">-₫0</span>
                            </div>
                            <div class="summary-divider"></div>
                            <div class="summary-row total">
                                <span>Tổng cộng:</span>
                                <span class="total-amount">₫35,530,000</span>
                            </div>

                            <div class="coupon-section">
                                <label class="form-label">Mã giảm giá</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="couponCode"
                                        placeholder="Nhập mã giảm giá">
                                    <button class="btn btn-outline-primary" id="applyCoupon">Áp dụng</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="create-card fade-in-up">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="bi bi-credit-card me-2"></i>
                                Phương thức thanh toán
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="payment-methods">
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="cod"
                                        value="cod" checked>
                                    <label class="form-check-label" for="cod">
                                        <i class="bi bi-cash-coin"></i>
                                        Thanh toán khi giao hàng (COD)
                                    </label>
                                </div>
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="paymentMethod"
                                        id="bank_transfer" value="bank_transfer">
                                    <label class="form-check-label" for="bank_transfer">
                                        <i class="bi bi-bank"></i>
                                        Chuyển khoản ngân hàng
                                    </label>
                                </div>
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="credit_card"
                                        value="credit_card">
                                    <label class="form-check-label" for="credit_card">
                                        <i class="bi bi-credit-card-fill"></i>
                                        Thẻ tín dụng
                                    </label>
                                </div>
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="e_wallet"
                                        value="e_wallet">
                                    <label class="form-check-label" for="e_wallet">
                                        <i class="bi bi-wallet2"></i>
                                        Ví điện tử
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Order Status --}}
                    <div class="create-card fade-in-up">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="bi bi-gear me-2"></i>
                                Trạng thái đơn hàng
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Trạng thái ban đầu</label>
                                <select class="form-select" id="initialStatus">
                                    <option value="pending">Chờ xử lý</option>
                                    <option value="confirmed">Đã xác nhận</option>
                                    <option value="processing">Đang xử lý</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Độ ưu tiên</label>
                                <select class="form-select" id="priority">
                                    <option value="normal">Bình thường</option>
                                    <option value="high">Cao</option>
                                    <option value="urgent">Khẩn cấp</option>
                                </select>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sendNotification" checked>
                                <label class="form-check-label" for="sendNotification">
                                    Gửi thông báo cho khách hàng
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- New Customer Modal --}}
    <div class="modal fade" id="newCustomerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-person-plus me-2"></i>
                        Thêm khách hàng mới
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Họ và tên *</label>
                                <input type="text" class="form-control" id="newCustomerName" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control" id="newCustomerEmail" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại *</label>
                                <input type="tel" class="form-control" id="newCustomerPhone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Loại khách hàng</label>
                                <select class="form-select" id="newCustomerType">
                                    <option value="regular">Khách hàng thường</option>
                                    <option value="vip">Khách VIP</option>
                                    <option value="wholesale">Khách sỉ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <textarea class="form-control" rows="3" id="newCustomerAddress" placeholder="Nhập địa chỉ khách hàng..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="saveNewCustomer">Lưu khách hàng</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/admin/orders/create.js') }}"></script>
    @endpush
@endsection
