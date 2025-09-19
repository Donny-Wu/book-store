<x-guest-layout>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Figtree', sans-serif;
        }

        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: #666;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #333;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-input:hover {
            border-color: #667eea;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            margin-right: 0.75rem;
            accent-color: #667eea;
        }

        .checkbox-label {
            color: #666;
            font-size: 0.9rem;
            user-select: none;
        }

        .login-button {
            width: 100%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .login-button:hover::before {
            left: 100%;
        }

        .forgot-password {
            text-align: center;
            margin-top: 1.5rem;
        }

        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .error-message {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }

        .success-message {
            background: linear-gradient(45deg, #51cf66, #40c057);
            color: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            box-shadow: 0 5px 15px rgba(81, 207, 102, 0.3);
        }

        .form-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 0.9rem;
        }

        .form-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* 動畫效果 */
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

        .login-card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* 響應式設計 */
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .login-logo {
                font-size: 2rem;
            }
        }

        /* 浮動粒子背景效果 */
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-shape:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }
    </style>

    <!-- 浮動背景元素 -->
    <div class="floating-shapes">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <!-- Logo 和標題 -->
            <div class="login-header">
                <h1 class="login-logo">BookHaven</h1>
                <p class="login-subtitle">歡迎回到您的閱讀天堂</p>
            </div>

            <!-- 錯誤訊息 -->
            <x-validation-errors class="error-message" />

            <!-- 狀態訊息 -->
            @session('status')
                <div class="success-message">
                    {{ $value }}
                </div>
            @endsession

            <!-- 登入表單 -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email 欄位 -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email"
                           class="form-input"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="username"
                           placeholder="請輸入您的電子郵件" />
                </div>

                <!-- Password 欄位 -->
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password"
                           class="form-input"
                           type="password"
                           name="password"
                           required
                           autocomplete="current-password"
                           placeholder="請輸入您的密碼" />
                </div>

                <!-- Remember Me -->
                <div class="checkbox-wrapper">
                    <input type="checkbox"
                           id="remember_me"
                           name="remember"
                           class="checkbox">
                    <label for="remember_me" class="checkbox-label">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <!-- 登入按鈕和忘記密碼 -->
                <button type="submit" class="login-button">
                    {{ __('Log in') }}
                </button>

                @if (Route::has('password.request'))
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </form>

            <!-- 頁腳 -->
            <div class="form-footer">
                還沒有帳號？
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">立即註冊</a>
                @endif
            </div>
        </div>
    </div>

    <script>
        // 為輸入欄位添加焦點效果
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');

            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });

            // 登入按鈕點擊效果
            const loginButton = document.querySelector('.login-button');
            loginButton.addEventListener('click', function(e) {
                // 添加載入狀態
                if (this.form.checkValidity()) {
                    this.innerHTML = '<span class="loading-spinner"></span>登入中...';
                    this.disabled = true;
                }
            });
        });

        // 添加載入動畫樣式
        const style = document.createElement('style');
        style.textContent = `
            .loading-spinner {
                border: 2px solid rgba(255, 255, 255, 0.3);
                border-top: 2px solid white;
                border-radius: 50%;
                width: 16px;
                height: 16px;
                animation: spin 1s linear infinite;
                display: inline-block;
                margin-right: 8px;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .focused .form-label {
                color: #667eea;
                transform: scale(0.9);
            }
        `;
        document.head.appendChild(style);
    </script>
</x-guest-layout>
