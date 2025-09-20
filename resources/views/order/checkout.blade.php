@extends('layouts.common')

@section('content')
<style>
    /* 原有的結帳頁面樣式保留 */
    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
        margin-top: 2rem;
    }

    /* 會員登入/註冊樣式 */
    .auth-section {
        /* background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05)); */
        background: white;
        border: 2px solid #667eea;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .auth-toggle {
        display: flex;
        background: white;
        border-radius: 10px;
        padding: 4px;
        margin-bottom: 1.5rem;
    }

    .auth-toggle-btn {
        flex: 1;
        padding: 0.75rem;
        border: none;
        background: transparent;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #6b7280;
    }

    .auth-toggle-btn.active {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
    }

    .auth-form {
        display: none;
    }

    .auth-form.active {
        display: block;
    }

    .auth-input-group {
        margin-bottom: 1rem;
    }

    .auth-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .auth-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .auth-button {
        width: 100%;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        padding: 0.75rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .auth-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .auth-success {
        background: #f0fdf4;
        border: 1px solid #86efac;
        color: #16a34a;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
        display: none;
    }

    .auth-success.show {
        display: block;
    }

    .auth-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
        display: none;
    }

    .auth-error.show {
        display: block;
    }

    .member-info {
        background: #f0fdf4;
        border: 1px solid #86efac;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        display: none;
    }

    .member-info.show {
        display: block;
    }

    .member-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .logout-btn {
        background: #ef4444;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        float: right;
    }

    .logout-btn:hover {
        background: #dc2626;
    }

    .guest-checkout {
        text-align: center;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
    }

    .guest-link {
        color: #6b7280;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .guest-link:hover {
        color: #667eea;
        text-decoration: underline;
    }

    /* 左側表單區域 */
    .checkout-form-section {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .section-number {
        width: 32px;
        height: 32px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
    }

    /* 表單樣式 */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #374151;
        font-size: 0.95rem;
    }

    .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* 其他原有樣式保留... */
    .shipping-options { display: grid; gap: 1rem; }
    .shipping-option { border: 2px solid #e5e7eb; border-radius: 10px; padding: 1rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 1rem; }
    .shipping-option:hover { border-color: #667eea; background: #f9fafb; }
    .shipping-option.selected { border-color: #667eea; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05)); }
    .payment-methods { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    .payment-method { border: 2px solid #e5e7eb; border-radius: 10px; padding: 1rem; cursor: pointer; transition: all 0.3s ease; text-align: center; }
    .payment-method:hover { border-color: #667eea; transform: translateY(-2px); }
    .payment-method.selected { border-color: #667eea; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05)); }
    .order-summary { background: white; border-radius: 15px; padding: 1.5rem; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); height: fit-content; position: sticky; top: 100px; }
    .place-order-btn { width: 100%; background: linear-gradient(45deg, #667eea, #764ba2); color: white; padding: 1rem; border: none; border-radius: 10px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; }
    .place-order-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3); }

    @media (max-width: 968px) {
        .checkout-grid { grid-template-columns: 1fr; }
        .order-summary { position: static; order: -1; }
    }
</style>

<div class="checkout-container">
    <a href="#" onclick="history.back()" class="back-to-cart" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #667eea; text-decoration: none; margin-bottom: 2rem;">
        ← 返回購物車
    </a>

    <div class="checkout-grid">
        <!-- 左側：結帳表單 -->
        <div class="checkout-forms">

            <!-- 會員登入/註冊區塊 -->
            <div class="auth-section" id="authSection">
                <h3 style="margin-bottom: 1rem; font-size: 1.2rem; font-weight: 600;">
                    快速結帳 - 登入或註冊會員
                </h3>

                <!-- 會員狀態顯示 -->
                <div class="member-info" id="memberInfo">
                    <div class="member-badge">
                        ✓ 已登入會員
                    </div>
                    <p style="margin: 0.5rem 0;">
                        歡迎回來，<strong id="memberName"></strong>！
                    </p>
                    <p style="color: #6b7280; font-size: 0.9rem;">
                        配送資訊已自動填入，您可以直接修改或繼續結帳。
                    </p>
                    <button class="logout-btn" onclick="logout()">登出</button>
                </div>

                <!-- 登入/註冊切換 -->
                <div class="auth-toggle" id="authToggle">
                    <button class="auth-toggle-btn active" onclick="switchAuth('login')">
                        會員登入
                    </button>
                    <button class="auth-toggle-btn" onclick="switchAuth('register')">
                        註冊新會員
                    </button>
                </div>

                <!-- 登入表單 -->
                <div class="auth-form active" id="loginForm">
                    <div class="auth-input-group">
                        <label class="form-label">手機號碼</label>
                        <input type="tel" class="auth-input" id="loginPhone" placeholder="0912-345-678">
                    </div>
                    <div class="auth-input-group">
                        <label class="form-label">密碼</label>
                        <input type="password" class="auth-input" id="loginPassword" placeholder="請輸入密碼">
                    </div>
                    <button class="auth-button" onclick="login()">
                        登入會員
                    </button>
                    <div class="auth-error" id="loginError">
                        手機號碼或密碼錯誤，請重試。
                    </div>
                </div>

                <!-- 註冊表單 -->
                <div class="auth-form" id="registerForm">
                    <div class="form-row">
                        <div class="auth-input-group">
                            <label class="form-label">姓氏 <span class="required">*</span></label>
                            <input type="text" class="auth-input" id="regLastName">
                        </div>
                        <div class="auth-input-group">
                            <label class="form-label">名字 <span class="required">*</span></label>
                            <input type="text" class="auth-input" id="regFirstName">
                        </div>
                    </div>
                    <div class="auth-input-group">
                        <label class="form-label">手機號碼 <span class="required">*</span></label>
                        <input type="tel" class="auth-input" id="regPhone" placeholder="0912-345-678">
                    </div>
                    <div class="auth-input-group">
                        <label class="form-label">電子郵件 <span class="required">*</span></label>
                        <input type="email" class="auth-input" id="regEmail" placeholder="example@email.com">
                    </div>
                    <div class="auth-input-group">
                        <label class="form-label">設定密碼 <span class="required">*</span></label>
                        <input type="password" class="auth-input" id="regPassword" placeholder="至少6個字元">
                    </div>
                    <div class="auth-input-group">
                        <label class="form-label">確認密碼 <span class="required">*</span></label>
                        <input type="password" class="auth-input" id="regPasswordConfirm" placeholder="再次輸入密碼">
                    </div>
                    <button class="auth-button" onclick="register()">
                        註冊會員
                    </button>
                    <div class="auth-success" id="registerSuccess">
                        註冊成功！資料已自動填入配送資訊。
                    </div>
                    <div class="auth-error" id="registerError">
                        請檢查所有欄位是否正確填寫。
                    </div>
                </div>

                <!-- 訪客結帳 -->
                <div class="guest-checkout">
                    <a href="#" class="guest-link" onclick="skipAuth(); return false;">
                        不想註冊？直接以訪客身份結帳 →
                    </a>
                </div>
            </div>

            <!-- 配送資訊 -->
            <div class="checkout-form-section">
                <div class="section-header">
                    <div class="section-number">1</div>
                    <h2 class="section-title">配送資訊</h2>
                </div>

                <form id="shippingForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                姓氏 <span class="required">*</span>
                            </label>
                            <input type="text" class="form-input" id="lastName" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                名字 <span class="required">*</span>
                            </label>
                            <input type="text" class="form-input" id="firstName" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            電子郵件 <span class="required">*</span>
                        </label>
                        <input type="email" class="form-input" id="email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            手機號碼 <span class="required">*</span>
                        </label>
                        <input type="tel" class="form-input" id="phone" placeholder="0912-345-678" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                縣市 <span class="required">*</span>
                            </label>
                            <select class="form-input" id="city" required style="cursor: pointer;">
                                <option value="">請選擇縣市</option>
                                <option value="taipei">台北市</option>
                                <option value="new-taipei">新北市</option>
                                <option value="taichung">台中市</option>
                                <option value="tainan">台南市</option>
                                <option value="kaohsiung">高雄市</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                郵遞區號 <span class="required">*</span>
                            </label>
                            <input type="text" class="form-input" id="zipCode" placeholder="100" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            詳細地址 <span class="required">*</span>
                        </label>
                        <input type="text" class="form-input" id="address" placeholder="請輸入街道名稱、門牌號碼等" required>
                    </div>

                    <!-- 儲存配送地址選項（會員專用） -->
                    <div class="form-group" id="saveAddressOption" style="display: none;">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" id="saveAddress" checked>
                            <span style="font-size: 0.9rem; color: #6b7280;">將此地址儲存為預設配送地址</span>
                        </label>
                    </div>
                </form>
            </div>

            <!-- 配送方式與付款方式（保持原樣） -->
            <div class="checkout-form-section" style="margin-top: 2rem;">
                <div class="section-header">
                    <div class="section-number">2</div>
                    <h2 class="section-title">配送方式</h2>
                </div>

                <div class="shipping-options">
                    <div class="shipping-option selected" onclick="selectShipping(this, 'standard', 0)">
                        <input type="radio" name="shipping" checked style="accent-color: #667eea;">
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: #333;">標準配送</div>
                            <div style="font-size: 0.85rem; color: #6b7280;">5-7 個工作天</div>
                        </div>
                        <div style="font-weight: bold; color: #667eea;">免費</div>
                    </div>

                    <div class="shipping-option" onclick="selectShipping(this, 'express', 60)">
                        <input type="radio" name="shipping" style="accent-color: #667eea;">
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: #333;">快速配送</div>
                            <div style="font-size: 0.85rem; color: #6b7280;">2-3 個工作天</div>
                        </div>
                        <div style="font-weight: bold; color: #667eea;">$60</div>
                    </div>
                </div>
            </div>

            <div class="checkout-form-section" style="margin-top: 2rem;">
                <div class="section-header">
                    <div class="section-number">3</div>
                    <h2 class="section-title">付款方式</h2>
                </div>

                <div class="payment-methods">
                    <div class="payment-method selected" onclick="selectPayment(this, 'credit-card')">
                        <div style="font-size: 2rem;">💳</div>
                        <div style="font-weight: 500; color: #333;">信用卡</div>
                    </div>

                    <div class="payment-method" onclick="selectPayment(this, 'line-pay')">
                        <div style="font-size: 2rem;">📱</div>
                        <div style="font-weight: 500; color: #333;">LINE Pay</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 右側：訂單摘要（保持原樣） -->
        <div class="order-summary">
            <h2 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #e5e7eb;">
                訂單摘要
            </h2>

            <div id="orderItems" style="max-height: 300px; overflow-y: auto; margin-bottom: 1rem;">
                <!-- 動態生成商品列表 -->
            </div>

            <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; font-size: 0.95rem;">
                    <span>商品小計</span>
                    <span id="subtotal">$0.00</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; font-size: 0.95rem;">
                    <span>運費</span>
                    <span id="shippingFee">免費</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: bold; color: #333; margin-top: 1rem; padding-top: 1rem; border-top: 2px solid #e5e7eb;">
                    <span>總計</span>
                    <span style="color: #667eea;" id="total">$0.00</span>
                </div>
            </div>

            <button class="place-order-btn" onclick="placeOrder()" id="placeOrderBtn" style="margin-top: 2rem;">
                確認訂單
            </button>

            <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 1rem; font-size: 0.85rem; color: #6b7280;">
                🔒 SSL 安全加密付款
            </div>
        </div>
    </div>
</div>

<script>
    // 模擬會員資料庫
    const mockMembers = [
        {
            phone: '0912345678',
            password: '123456',
            lastName: '王',
            firstName: '小明',
            email: 'wang@example.com',
            city: 'taipei',
            zipCode: '100',
            address: '中正區中山南路1號'
        },
        {
            phone: '0987654321',
            password: 'password',
            lastName: '李',
            firstName: '小華',
            email: 'lee@example.com',
            city: 'new-taipei',
            zipCode: '220',
            address: '板橋區文化路二段123號'
        }
    ];

    let currentMember = null;
    let shippingCost = 0;

    // 初始化
    document.addEventListener('DOMContentLoaded', function() {
        // 檢查是否有已登入的會員
        const savedMember = localStorage.getItem('currentMember');
        if (savedMember) {
            currentMember = JSON.parse(savedMember);
            showMemberStatus();
            fillMemberData();
        }

        loadOrderItems();
        updateOrderSummary();
    });

    // 切換登入/註冊
    function switchAuth(type) {
        const toggleBtns = document.querySelectorAll('.auth-toggle-btn');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        toggleBtns.forEach(btn => btn.classList.remove('active'));
        loginForm.classList.remove('active');
        registerForm.classList.remove('active');

        if (type === 'login') {
            toggleBtns[0].classList.add('active');
            loginForm.classList.add('active');
        } else {
            toggleBtns[1].classList.add('active');
            registerForm.classList.add('active');
        }

        // 清除錯誤訊息
        document.getElementById('loginError').classList.remove('show');
        document.getElementById('registerError').classList.remove('show');
        document.getElementById('registerSuccess').classList.remove('show');
    }

    // 登入功能
    function login() {
        const phone = document.getElementById('loginPhone').value.replace(/-/g, '');
        const password = document.getElementById('loginPassword').value;

        // 查找會員
        const member = mockMembers.find(m =>
            m.phone === phone && m.password === password
        );

        if (member) {
            currentMember = member;
            localStorage.setItem('currentMember', JSON.stringify(member));

            // 顯示會員狀態
            showMemberStatus();

            // 填入會員資料
            fillMemberData();

            // 清除錯誤訊息
            document.getElementById('loginError').classList.remove('show');
        } else {
            document.getElementById('loginError').classList.add('show');
        }
    }

    // 註冊功能
    function register() {
        const lastName = document.getElementById('regLastName').value;
        const firstName = document.getElementById('regFirstName').value;
        const phone = document.getElementById('regPhone').value.replace(/-/g, '');
        const email = document.getElementById('regEmail').value;
        const password = document.getElementById('regPassword').value;
        const passwordConfirm = document.getElementById('regPasswordConfirm').value;

        // 驗證
        if (!lastName || !firstName || !phone || !email || !password) {
            document.getElementById('registerError').classList.add('show');
            return;
        }

        if (password !== passwordConfirm) {
            document.getElementById('registerError').textContent = '兩次密碼輸入不一致';
            document.getElementById('registerError').classList.add('show');
            return;
        }

        if (password.length < 6) {
            document.getElementById('registerError').textContent = '密碼至少需要6個字元';
            document.getElementById('registerError').classList.add('show');
            return;
        }

        // 檢查手機號碼是否已存在
        if (mockMembers.find(m => m.phone === phone)) {
            document.getElementById('registerError').textContent = '此手機號碼已被註冊';
            document.getElementById('registerError').classList.add('show');
            return;
        }

        // 建立新會員
        const newMember = {
            phone: phone,
            password: password,
            lastName: lastName,
            firstName: firstName,
            email: email,
            city: '',
            zipCode: '',
            address: ''
        };

        // 模擬儲存到資料庫（實際應該發送到後端）
        mockMembers.push(newMember);
        currentMember = newMember;
        localStorage.setItem('currentMember', JSON.stringify(newMember));

        // 顯示成功訊息
        document.getElementById('registerSuccess').classList.add('show');
        document.getElementById('registerError').classList.remove('show');

        // 填入基本資料到配送表單
        document.getElementById('lastName').value = lastName;
        document.getElementById('firstName').value = firstName;
        document.getElementById('email').value = email;
        document.getElementById('phone').value = phone;

        // 2秒後顯示會員狀態
        setTimeout(() => {
            showMemberStatus();
        }, 2000);
    }

    // 顯示會員狀態
    function showMemberStatus() {
        if (currentMember) {
            document.getElementById('memberName').textContent =
                currentMember.lastName + currentMember.firstName;
            document.getElementById('memberInfo').classList.add('show');
            document.getElementById('authToggle').style.display = 'none';
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('registerForm').style.display = 'none';
            document.querySelector('.guest-checkout').style.display = 'none';
            document.getElementById('saveAddressOption').style.display = 'block';
        }
    }

    // 填入會員資料
    function fillMemberData() {
        if (currentMember) {
            document.getElementById('lastName').value = currentMember.lastName || '';
            document.getElementById('firstName').value = currentMember.firstName || '';
            document.getElementById('email').value = currentMember.email || '';
            document.getElementById('phone').value = currentMember.phone || '';
            document.getElementById('city').value = currentMember.city || '';
            document.getElementById('zipCode').value = currentMember.zipCode || '';
            document.getElementById('address').value = currentMember.address || '';
        }
    }
</script>
