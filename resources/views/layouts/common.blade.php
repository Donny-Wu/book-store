<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookHaven - 您的閱讀天堂</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/common.css', 'resources/js/app.js'])
    @else
        <style>
            /* Tailwind CSS Reset & Core Styles */
            *,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}

            /* Tailwind Utilities - Essential Classes */
            .absolute{position:absolute}.relative{position:relative}.fixed{position:fixed}.top-0{top:0}.left-0{left:0}.right-0{right:0}.bottom-0{bottom:0}.z-10{z-index:10}.z-50{z-index:50}.z-1000{z-index:1000}.-left-20{left:-5rem}.-top-16{top:-4rem}.mx-auto{margin-left:auto;margin-right:auto}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.mb-4{margin-bottom:1rem}.mb-8{margin-bottom:2rem}.mb-12{margin-bottom:3rem}.flex{display:flex}.grid{display:grid}.hidden{display:none}.w-full{width:100%}.w-auto{width:auto}.h-12{height:3rem}.h-16{height:4rem}.h-64{height:16rem}.h-80{height:20rem}.h-full{height:100%}.min-h-screen{min-h:100vh}.max-w-2xl{max-width:42rem}.max-w-7xl{max-width:80rem}.max-w-none{max-width:none}.flex-1{flex:1 1 0%}.flex-col{flex-direction:column}.items-center{align-items:center}.items-start{align-items:flex-start}.justify-center{justify-content:center}.justify-between{justify-content:space-between}.justify-end{justify-content:flex-end}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.gap-8{gap:2rem}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}.grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr))}.overflow-hidden{overflow:hidden}.rounded{border-radius:0.25rem}.rounded-lg{border-radius:0.5rem}.rounded-xl{border-radius:0.75rem}.rounded-2xl{border-radius:1rem}.rounded-full{border-radius:9999px}.border{border-width:1px}.border-2{border-width:2px}.bg-white{background-color:#fff}.bg-gray-50{background-color:#f9fafb}.bg-gray-100{background-color:#f3f4f6}.bg-gray-200{background-color:#e5e7eb}.bg-red-500{background-color:#ef4444}.text-center{text-align:center}.text-left{text-align:left}.font-sans{font-family:ui-sans-serif,system-ui,sans-serif}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-base{font-size:1rem;line-height:1.5rem}.text-lg{font-size:1.125rem;line-height:1.75rem}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-2xl{font-size:1.5rem;line-height:2rem}.text-3xl{font-size:1.875rem;line-height:2.25rem}.text-4xl{font-size:2.25rem;line-height:2.5rem}.text-5xl{font-size:3rem;line-height:1}.font-medium{font-weight:500}.font-semibold{font-weight:600}.font-bold{font-weight:700}.font-extrabold{font-weight:800}.text-black{color:#000}.text-white{color:#fff}.text-gray-500{color:#6b7280}.text-gray-600{color:#4b5563}.text-gray-700{color:#374151}.text-gray-800{color:#1f2937}.text-gray-900{color:#111827}.underline{text-decoration-line:underline}.no-underline{text-decoration-line:none}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow{box-shadow:0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1)}.shadow-lg{box-shadow:0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1)}.shadow-xl{box-shadow:0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)}.transition{transition-property:color,background-color,border-color,text-decoration-color,fill,stroke,opacity,box-shadow,transform,filter,backdrop-filter;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.ease-in-out{transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1)}.transform{transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.hover\:shadow-xl:hover{box-shadow:0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.p-2{padding:0.5rem}.p-4{padding:1rem}.p-6{padding:1.5rem}.p-8{padding:2rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.px-8{padding-left:2rem;padding-right:2rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.py-8{padding-top:2rem;padding-bottom:2rem}.py-12{padding-top:3rem;padding-bottom:3rem}.py-16{padding-top:4rem;padding-bottom:4rem}.pt-20{padding-top:5rem}.pb-8{padding-bottom:2rem}

            /* Custom Responsive Classes */
            @media (min-width: 640px){.sm\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:py-24{padding-top:6rem;padding-bottom:6rem}.sm\:text-2xl{font-size:1.5rem;line-height:2rem}}@media (min-width: 768px){.md\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.md\:px-8{padding-left:2rem;padding-right:2rem}}@media (min-width: 1024px){.lg\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.lg\:grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr))}.lg\:max-w-7xl{max-width:80rem}.lg\:px-8{padding-left:2rem;padding-right:2rem}.lg\:text-4xl{font-size:2.25rem;line-height:2.5rem}}@media (min-width: 1280px){.xl\:grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr))}.xl\:gap-x-8{column-gap:2rem}}

            /* Dark mode support */
            @media (prefers-color-scheme: dark){.dark\:bg-black{background-color:#000}.dark\:text-white{color:#fff}.dark\:text-gray-300{color:#d1d5db}}
        </style>
    @endif

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s ease;
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 25px;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .cart-btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Hero Section */
        .hero {
            margin-top: 80px;
            padding: 4rem 2rem;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease-out;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .cta-button {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 1rem 2rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .cta-button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: white;
        }

        /* Main Content */
        .main-content {
            background: white;
            margin: 2rem;
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav {
                padding: 0 1rem;
            }

            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .main-content {
                margin: 1rem;
                padding: 2rem 1rem;
            }
        }

        /* Content area styling */
        .content-wrapper {
            padding-top: 80px; /* Account for fixed header */
        }
        /* === 添加到現有的 <style> 標籤內 === */
        /* 購物車側邊面板樣式 */
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100vh;
            background: white;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
            z-index: 1001;
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .cart-sidebar.active {
            right: 0;
        }

        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .cart-overlay.active {
            display: block;
            opacity: 1;
        }

        .cart-header {
            padding: 20px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-header h2 {
            font-size: 1.5rem;
            margin: 0;
        }

        .close-cart-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 20px;
        }

        .close-cart-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .cart-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .cart-empty {
            text-align: center;
            padding: 60px 20px;
        }

        .cart-empty-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .cart-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.3s ease;
        }

        .cart-item:hover {
            background: #f9fafb;
        }

        .cart-item-image {
            width: 80px;
            height: 100px;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-title {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .cart-item-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #667eea;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f3f4f6;
            border-radius: 25px;
            padding: 2px;
            margin-top: 10px;
        }

        .quantity-btn {
            width: 28px;
            height: 28px;
            border: none;
            background: white;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            color: #667eea;
        }

        .quantity-btn:hover {
            background: #667eea;
            color: white;
        }

        .quantity-value {
            min-width: 30px;
            text-align: center;
            font-weight: 600;
        }

        .remove-item-btn {
            background: #ff4757;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        .cart-footer {
            padding: 20px;
            background: #f9fafb;
            border-top: 2px solid #e5e7eb;
        }

        .cart-summary {
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
            color: #6b7280;
        }

        .summary-row.total {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
        }

        .checkout-btn {
            width: 100%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .cart-count-badge {
            background: #ff4757;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 5px;
        }

        @media (max-width: 768px) {
            .cart-sidebar {
                width: 100%;
                right: -100%;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <x-imports.sweetalert2 />
    <header class="header">
        <nav class="nav">
            <div class="logo">BookHaven</div>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">首頁</a></li>
                <li><a href="#books">書籍</a></li>
                <li><a href="#categories">分類</a></li>
                <li><a href="#about">關於我們</a></li>
                <li><a href="#contact">聯絡</a></li>
            </ul>
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-links-item">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-links-item">登入</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-links-item">註冊</a>
                        @endif
                    @endauth
                @endif
                <button class="cart-btn" onclick="showCart()">
                    🛒 購物車 (<span id="cart-count">0</span>)
                </button>
            </div>
        </nav>
    </header>
    <!-- 購物車側邊面板 HTML 結構 -->
    <div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h2>🛒 購物車</h2>
            <button class="close-cart-btn" onclick="closeCart()">×</button>
        </div>

        <div class="cart-content" id="cartContent">
            <!-- 購物車內容將動態生成 -->
        </div>

        <div class="cart-footer" id="cartFooter" style="display: none;">
            <div class="cart-summary">
                <div class="summary-row">
                    <span>商品小計</span>
                    <span id="subtotal">$0.00</span>
                </div>
                <div class="summary-row">
                    <span>運費</span>
                    <span id="shipping">免費</span>
                </div>
                <div class="summary-row total">
                    <span>總計</span>
                    <span class="amount" id="total">$0.00</span>
                </div>
            </div>
            <button class="checkout-btn" onclick="checkout()">
                前往結帳
            </button>
            <button class="clear-cart-btn" onclick="clearCart()" style="width: 100%; background: transparent; color: #6b7280; padding: 10px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 0.9rem; cursor: pointer; margin-top: 10px;">
                清空購物車
            </button>
        </div>
    </div>
    <div class="content-wrapper">
        <main>
            @yield('content')
        </main>
    </div>

    <script>
        // 購物車數據
        let cart = [];

        // 初始化購物車
        function initCart() {
            const savedCart = localStorage.getItem('bookhavenCart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
                updateCart();
            } else {
                renderEmptyCart();
            }
        }

        // 添加到購物車（修改原有的 addToCart 函數）
        function addToCart(title, price, bookId, imageUrl = null, author = '') {
            // 阻止事件冒泡
            if (event) event.stopPropagation();

            const existingItem = cart.find(item => item.id === bookId);

            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({
                    id: bookId,
                    title: title,
                    author: author,
                    price: price,
                    imageUrl: imageUrl,
                    quantity: 1
                });
            }

            saveCart();
            updateCart();
            showNotification(`《${title}》已加入購物車`);

            // 打開購物車面板
            if (!document.getElementById('cartSidebar').classList.contains('active')) {
                openCart();
            }
        }

        // 更新商品數量
        function updateQuantity(id, delta) {
            const item = cart.find(item => item.id === id);
            if (item) {
                item.quantity += delta;
                if (item.quantity <= 0) {
                    removeFromCart(id);
                } else {
                    saveCart();
                    updateCart();
                }
            }
        }

        // 從購物車移除
        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            saveCart();
            updateCart();
            showNotification('商品已從購物車移除');
        }

        // 清空購物車
        function clearCart() {
            if (cart.length === 0) return;

            if (confirm('確定要清空購物車嗎？')) {
                cart = [];
                saveCart();
                updateCart();
                showNotification('購物車已清空');
            }
        }

        // 保存購物車
        function saveCart() {
            localStorage.setItem('bookhavenCart', JSON.stringify(cart));
        }

        // 更新購物車顯示
        function updateCart() {
            const cartContent = document.getElementById('cartContent');
            const cartFooter = document.getElementById('cartFooter');
            const cartCountElement = document.getElementById('cart-count');

            // 更新數量
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCountElement.textContent = totalItems;

            if (cart.length === 0) {
                renderEmptyCart();
                cartFooter.style.display = 'none';
            } else {
                renderCartItems();
                updateSummary();
                cartFooter.style.display = 'block';
            }
        }

        // 渲染空購物車
        function renderEmptyCart() {
            const cartContent = document.getElementById('cartContent');
            cartContent.innerHTML = `
                <div class="cart-empty">
                    <div class="cart-empty-icon">🛒</div>
                    <p style="color: #999; font-size: 1.1rem; margin-bottom: 20px;">您的購物車是空的</p>
                    <button onclick="closeCart()" style="background: linear-gradient(45deg, #667eea, #764ba2); color: white; padding: 10px 24px; border: none; border-radius: 25px; cursor: pointer;">
                        繼續購物
                    </button>
                </div>
            `;
        }

        // 渲染購物車商品
        function renderCartItems() {
            const cartContent = document.getElementById('cartContent');
            cartContent.innerHTML = cart.map(item => `
                <div class="cart-item">
                    <div class="cart-item-image">
                        ${item.imageUrl ? `<img src="${item.imageUrl}" alt="${item.title}">` : '📚'}
                    </div>
                    <div class="cart-item-details">
                        <div class="cart-item-title">${item.title}</div>
                        ${item.author ? `<div style="font-size: 0.85rem; color: #6b7280; margin-bottom: 8px;">${item.author}</div>` : ''}
                        <div class="cart-item-price">$${(item.price * item.quantity).toFixed(2)}</div>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">−</button>
                            <span class="quantity-value">${item.quantity}</span>
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                        </div>
                        <button class="remove-item-btn" onclick="removeFromCart(${item.id})">
                            移除
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // 更新購物車摘要
        function updateSummary() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const total = subtotal;

            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }

        // 打開購物車（修改原有的 showCart 函數）
        function showCart() {
            openCart();
        }

        function openCart() {
            document.getElementById('cartSidebar').classList.add('active');
            document.getElementById('cartOverlay').classList.add('active');
        }

        // 關閉購物車
        function closeCart() {
            document.getElementById('cartSidebar').classList.remove('active');
            document.getElementById('cartOverlay').classList.remove('active');
        }

        // 結帳
        function checkout() {
            if (cart.length === 0) return;

            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            alert(`準備結帳\n總金額: $${total.toFixed(2)}`);
            // 這裡可以導向結帳頁面
            window.location.href = '/checkout';
        }

        // 修改原有的 showNotification 函數
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                background: linear-gradient(45deg, #667eea, #764ba2);
                color: white;
                padding: 1rem 2rem;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                z-index: 10000;
                animation: slideIn 0.5s ease-out;
            `;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.5s ease-out forwards';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 500);
            }, 3000);
        }

        // 頁面載入時初始化購物車
        document.addEventListener('DOMContentLoaded', function() {
            initCart();

            // 保留原有的滾動動畫功能
            handleScrollAnimation();
            smoothScroll();
        });

        // 監聽 ESC 鍵關閉購物車
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCart();
            }
        });

        // === 以下保留原有的功能函數 ===
        function handleScrollAnimation() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('visible');
                }
            });
        }

        function smoothScroll() {
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }

        window.addEventListener('scroll', handleScrollAnimation);
    </script>
</body>
</html>
