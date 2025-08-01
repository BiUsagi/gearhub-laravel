// ===== CREATE ORDER PAGE JAVASCRIPT =====

class CreateOrderManager {
    constructor() {
        this.selectedCustomer = null;
        this.selectedProducts = [];
        this.orderSummary = {
            subtotal: 0,
            shipping: 0,
            tax: 0,
            discount: 0,
            total: 0,
        };

        this.init();
    }

    init() {
        this.initCustomerSearch();
        this.initProductSearch();
        this.initPaymentMethods();
        this.initCouponSystem();
        this.initOrderCalculations();
        this.addAnimations();
        this.setupKeyboardShortcuts();
    }

    // ===== CUSTOMER MANAGEMENT =====
    initCustomerSearch() {
        const customerSearch = document.getElementById("customerSearch");
        const customerCard = document.getElementById("selectedCustomer");
        const changeCustomerBtn = document.getElementById("changeCustomer");

        if (customerSearch) {
            let searchTimeout;
            customerSearch.addEventListener("input", (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.searchCustomers(e.target.value);
                }, 300);
            });
        }

        if (changeCustomerBtn) {
            changeCustomerBtn.addEventListener("click", () => {
                this.clearSelectedCustomer();
            });
        }
    }

    searchCustomers(query) {
        if (query.length < 2) return;

        // Simulate customer search
        const mockCustomers = [
            {
                id: 1,
                name: "Nguyễn Văn A",
                email: "nguyenvana@email.com",
                phone: "0901234567",
                type: "VIP",
                avatar: "N",
            },
            {
                id: 2,
                name: "Trần Thị B",
                email: "tranthib@email.com",
                phone: "0902345678",
                type: "Thường",
                avatar: "T",
            },
        ];

        const filteredCustomers = mockCustomers.filter(
            (customer) =>
                customer.name.toLowerCase().includes(query.toLowerCase()) ||
                customer.email.toLowerCase().includes(query.toLowerCase()) ||
                customer.phone.includes(query)
        );

        this.displayCustomerSuggestions(filteredCustomers);
    }

    displayCustomerSuggestions(customers) {
        const suggestions = document.getElementById("customerSuggestions");
        if (!suggestions) return;

        suggestions.innerHTML = "";

        customers.forEach((customer) => {
            const suggestion = document.createElement("div");
            suggestion.className = "customer-suggestion p-2 border-bottom";
            suggestion.style.cursor = "pointer";
            suggestion.innerHTML = `
                <div class="d-flex align-items-center gap-2">
                    <div class="customer-avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        ${customer.avatar}
                    </div>
                    <div>
                        <div class="fw-medium">${customer.name}</div>
                        <small class="text-muted">${customer.email}</small>
                    </div>
                </div>
            `;

            suggestion.addEventListener("click", () => {
                this.selectCustomer(customer);
            });

            suggestions.appendChild(suggestion);
        });
    }

    selectCustomer(customer) {
        this.selectedCustomer = customer;
        this.displaySelectedCustomer(customer);
        document.getElementById("customerSuggestions").innerHTML = "";
        document.getElementById("customerSearch").value = "";
    }

    displaySelectedCustomer(customer) {
        const container = document.getElementById("selectedCustomer");
        if (!container) return;

        container.innerHTML = `
            <div class="customer-card">
                <div class="customer-avatar">${customer.avatar}</div>
                <div class="customer-info">
                    <div class="customer-name">${customer.name}</div>
                    <div class="customer-email">${customer.email}</div>
                    <div class="customer-phone">${customer.phone}</div>
                    <span class="customer-type badge ${
                        customer.type === "VIP" ? "bg-warning" : "bg-secondary"
                    }">${customer.type}</span>
                </div>
                <button type="button" id="changeCustomer" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-pencil"></i> Thay đổi
                </button>
            </div>
        `;

        // Re-bind change customer event
        document
            .getElementById("changeCustomer")
            .addEventListener("click", () => {
                this.clearSelectedCustomer();
            });
    }

    clearSelectedCustomer() {
        this.selectedCustomer = null;
        document.getElementById("selectedCustomer").innerHTML = "";
        document.getElementById("customerSearch").focus();
    }

    // ===== PRODUCT MANAGEMENT =====
    initProductSearch() {
        const productSearch = document.getElementById("productSearch");

        if (productSearch) {
            let searchTimeout;
            productSearch.addEventListener("input", (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.searchProducts(e.target.value);
                }, 300);
            });
        }
    }

    searchProducts(query) {
        if (query.length < 2) return;

        // Simulate product search
        const mockProducts = [
            {
                id: 1,
                name: "iPhone 15 Pro Max",
                sku: "IP15PM-256-BL",
                price: 29990000,
                stock: 25,
                image: "/images/products/iphone15.jpg",
            },
            {
                id: 2,
                name: "Samsung Galaxy S24 Ultra",
                sku: "SGS24U-512-TI",
                price: 31990000,
                stock: 15,
                image: "/images/products/galaxy-s24.jpg",
            },
        ];

        const filteredProducts = mockProducts.filter(
            (product) =>
                product.name.toLowerCase().includes(query.toLowerCase()) ||
                product.sku.toLowerCase().includes(query.toLowerCase())
        );

        this.displayProductSuggestions(filteredProducts);
    }

    displayProductSuggestions(products) {
        // Similar to customer suggestions but for products
        // Implementation would show product dropdown
    }

    addProduct(product) {
        // Check if product already exists
        const existingIndex = this.selectedProducts.findIndex(
            (p) => p.id === product.id
        );

        if (existingIndex >= 0) {
            this.selectedProducts[existingIndex].quantity += 1;
        } else {
            this.selectedProducts.push({
                ...product,
                quantity: 1,
                unitPrice: product.price,
            });
        }

        this.displaySelectedProducts();
        this.calculateOrderSummary();
    }

    displaySelectedProducts() {
        const container = document.getElementById("selectedProducts");
        if (!container) return;

        if (this.selectedProducts.length === 0) {
            container.innerHTML = `
                <div class="add-product-placeholder">
                    <div class="placeholder-content">
                        <i class="bi bi-plus-circle"></i>
                        <h6>Thêm sản phẩm vào đơn hàng</h6>
                        <p class="text-muted">Tìm kiếm và thêm sản phẩm bằng ô tìm kiếm ở trên</p>
                    </div>
                </div>
            `;
            return;
        }

        container.innerHTML = this.selectedProducts
            .map(
                (product, index) => `
            <div class="product-item" data-index="${index}">
                <div class="product-image">
                    <img src="${product.image}" alt="${
                    product.name
                }" onerror="this.src='/images/products/placeholder.jpg'">
                </div>
                <div class="product-details">
                    <h6>${product.name}</h6>
                    <div class="product-sku">SKU: ${product.sku}</div>
                    <div class="product-stock text-success">Kho: ${
                        product.stock
                    }</div>
                </div>
                <div class="quantity-control">
                    <button type="button" class="btn quantity-decrease" data-index="${index}">
                        <i class="bi bi-dash"></i>
                    </button>
                    <input type="number" class="form-control quantity-input" value="${
                        product.quantity
                    }" min="1" max="${product.stock}" data-index="${index}">
                    <button type="button" class="btn quantity-increase" data-index="${index}">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
                <div class="unit-price">
                    <input type="text" class="form-control price-input" value="${this.formatCurrency(
                        product.unitPrice
                    )}" data-index="${index}">
                </div>
                <div class="product-total">
                    <span class="total-label">Thành tiền</span>
                    <span class="total-amount">${this.formatCurrency(
                        product.quantity * product.unitPrice
                    )}</span>
                </div>
                <div class="remove-product">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-index="${index}">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `
            )
            .join("");

        this.bindProductEvents();
    }

    bindProductEvents() {
        // Quantity controls
        document.querySelectorAll(".quantity-decrease").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                this.updateQuantity(index, -1);
            });
        });

        document.querySelectorAll(".quantity-increase").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                this.updateQuantity(index, 1);
            });
        });

        document.querySelectorAll(".quantity-input").forEach((input) => {
            input.addEventListener("change", (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                const newQuantity = parseInt(e.currentTarget.value);
                this.setQuantity(index, newQuantity);
            });
        });

        // Price inputs
        document.querySelectorAll(".price-input").forEach((input) => {
            input.addEventListener("change", (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                const newPrice = this.parseCurrency(e.currentTarget.value);
                this.updatePrice(index, newPrice);
            });
        });

        // Remove product
        document.querySelectorAll(".remove-product .btn").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                this.removeProduct(index);
            });
        });
    }

    updateQuantity(index, change) {
        const product = this.selectedProducts[index];
        const newQuantity = Math.max(
            1,
            Math.min(product.stock, product.quantity + change)
        );
        this.setQuantity(index, newQuantity);
    }

    setQuantity(index, quantity) {
        if (quantity >= 1 && quantity <= this.selectedProducts[index].stock) {
            this.selectedProducts[index].quantity = quantity;
            this.displaySelectedProducts();
            this.calculateOrderSummary();
        }
    }

    updatePrice(index, price) {
        if (price > 0) {
            this.selectedProducts[index].unitPrice = price;
            this.displaySelectedProducts();
            this.calculateOrderSummary();
        }
    }

    removeProduct(index) {
        this.selectedProducts.splice(index, 1);
        this.displaySelectedProducts();
        this.calculateOrderSummary();
    }

    // ===== ORDER CALCULATIONS =====
    initOrderCalculations() {
        this.calculateOrderSummary();
    }

    calculateOrderSummary() {
        // Calculate subtotal
        this.orderSummary.subtotal = this.selectedProducts.reduce(
            (sum, product) => {
                return sum + product.quantity * product.unitPrice;
            },
            0
        );

        // Calculate shipping (based on selected shipping method)
        const shippingSelect = document.getElementById("shippingMethod");
        this.orderSummary.shipping = shippingSelect
            ? parseInt(shippingSelect.value) || 0
            : 0;

        // Calculate tax (10% VAT)
        this.orderSummary.tax = this.orderSummary.subtotal * 0.1;

        // Apply discount if any
        // this.orderSummary.discount is set by coupon system

        // Calculate total
        this.orderSummary.total =
            this.orderSummary.subtotal +
            this.orderSummary.shipping +
            this.orderSummary.tax -
            this.orderSummary.discount;

        this.displayOrderSummary();
    }

    displayOrderSummary() {
        const container = document.getElementById("orderSummary");
        if (!container) return;

        container.innerHTML = `
            <div class="summary-row">
                <span>Tạm tính (${
                    this.selectedProducts.length
                } sản phẩm):</span>
                <span>${this.formatCurrency(this.orderSummary.subtotal)}</span>
            </div>
            <div class="summary-row">
                <span>Phí vận chuyển:</span>
                <span>${this.formatCurrency(this.orderSummary.shipping)}</span>
            </div>
            <div class="summary-row">
                <span>Thuế VAT (10%):</span>
                <span>${this.formatCurrency(this.orderSummary.tax)}</span>
            </div>
            ${
                this.orderSummary.discount > 0
                    ? `
                <div class="summary-row text-success">
                    <span>Giảm giá:</span>
                    <span>-${this.formatCurrency(
                        this.orderSummary.discount
                    )}</span>
                </div>
            `
                    : ""
            }
            <div class="summary-divider"></div>
            <div class="summary-row total">
                <span>Tổng cộng:</span>
                <span>${this.formatCurrency(this.orderSummary.total)}</span>
            </div>
        `;
    }

    // ===== PAYMENT METHODS =====
    initPaymentMethods() {
        document
            .querySelectorAll('input[name="paymentMethod"]')
            .forEach((radio) => {
                radio.addEventListener("change", (e) => {
                    this.selectPaymentMethod(e.target.value);
                });
            });
    }

    selectPaymentMethod(method) {
        // Handle payment method selection
        console.log("Selected payment method:", method);
    }

    // ===== COUPON SYSTEM =====
    initCouponSystem() {
        const applyCouponBtn = document.getElementById("applyCoupon");
        const couponInput = document.getElementById("couponCode");

        if (applyCouponBtn) {
            applyCouponBtn.addEventListener("click", () => {
                this.applyCoupon(couponInput.value);
            });
        }

        if (couponInput) {
            couponInput.addEventListener("keypress", (e) => {
                if (e.key === "Enter") {
                    this.applyCoupon(e.target.value);
                }
            });
        }
    }

    applyCoupon(code) {
        if (!code.trim()) return;

        // Simulate coupon validation
        const mockCoupons = {
            NEWCUSTOMER: {
                type: "percentage",
                value: 10,
                description: "Giảm 10% cho khách hàng mới",
            },
            SAVE20K: {
                type: "fixed",
                value: 20000,
                description: "Giảm 20,000đ",
            },
        };

        const coupon = mockCoupons[code.toUpperCase()];

        if (coupon) {
            if (coupon.type === "percentage") {
                this.orderSummary.discount =
                    this.orderSummary.subtotal * (coupon.value / 100);
            } else {
                this.orderSummary.discount = coupon.value;
            }

            this.showToast("Áp dụng mã giảm giá thành công!", "success");
            this.calculateOrderSummary();
        } else {
            this.showToast("Mã giảm giá không hợp lệ!", "error");
        }
    }

    // ===== UTILITY FUNCTIONS =====
    formatCurrency(amount) {
        return new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
        }).format(amount);
    }

    parseCurrency(str) {
        return parseInt(str.replace(/[^\d]/g, "")) || 0;
    }

    showToast(message, type = "info") {
        // Create and show toast notification
        const toast = document.createElement("div");
        toast.className = `toast align-items-center text-white bg-${
            type === "error" ? "danger" : "success"
        } border-0`;
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        document.body.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();

        setTimeout(() => {
            document.body.removeChild(toast);
        }, 5000);
    }

    // ===== ANIMATIONS =====
    addAnimations() {
        const cards = document.querySelectorAll(".create-card");
        cards.forEach((card, index) => {
            card.classList.add("fade-in-up");
            card.style.animationDelay = `${index * 0.1}s`;
        });
    }

    // ===== KEYBOARD SHORTCUTS =====
    setupKeyboardShortcuts() {
        document.addEventListener("keydown", (e) => {
            // Ctrl + S to save draft
            if (e.ctrlKey && e.key === "s") {
                e.preventDefault();
                this.saveDraft();
            }

            // Ctrl + Enter to create order
            if (e.ctrlKey && e.key === "Enter") {
                e.preventDefault();
                this.createOrder();
            }

            // Escape to cancel
            if (e.key === "Escape") {
                this.clearForm();
            }
        });
    }

    // ===== ORDER OPERATIONS =====
    saveDraft() {
        this.showToast("Đã lưu bản nháp", "success");
    }

    createOrder() {
        if (this.validateOrder()) {
            this.submitOrder();
        }
    }

    validateOrder() {
        if (!this.selectedCustomer) {
            this.showToast("Vui lòng chọn khách hàng", "error");
            return false;
        }

        if (this.selectedProducts.length === 0) {
            this.showToast("Vui lòng thêm ít nhất một sản phẩm", "error");
            return false;
        }

        return true;
    }

    submitOrder() {
        const orderData = {
            customer: this.selectedCustomer,
            products: this.selectedProducts,
            summary: this.orderSummary,
            paymentMethod: document.querySelector(
                'input[name="paymentMethod"]:checked'
            )?.value,
            shippingMethod: document.getElementById("shippingMethod")?.value,
            orderStatus: document.getElementById("orderStatus")?.value,
            orderPriority: document.getElementById("orderPriority")?.value,
        };

        console.log("Creating order:", orderData);
        this.showToast("Đang tạo đơn hàng...", "info");

        // Simulate API call
        setTimeout(() => {
            this.showToast("Tạo đơn hàng thành công!", "success");
            // Redirect to order detail page
        }, 2000);
    }

    clearForm() {
        this.selectedCustomer = null;
        this.selectedProducts = [];
        this.orderSummary = {
            subtotal: 0,
            shipping: 0,
            tax: 0,
            discount: 0,
            total: 0,
        };

        document.getElementById("selectedCustomer").innerHTML = "";
        this.displaySelectedProducts();
        this.calculateOrderSummary();

        this.showToast("Đã xóa form", "info");
    }
}

// ===== INITIALIZE =====
document.addEventListener("DOMContentLoaded", () => {
    window.createOrderManager = new CreateOrderManager();
});
