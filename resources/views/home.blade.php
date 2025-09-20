@extends('layouts.common')

@section('content')
<style>
    /* Book Card Styles */
    .book-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .book-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, #667eea, #764ba2);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
        border-radius: 15px;
    }

    .book-card:hover::before {
        opacity: 0.1;
    }

    .book-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    /* 更新書籍封面樣式 - 使用適應性比例 */
    .book-cover {
        position: relative;
        width: 100%;
        padding-top: 133%; /* 3:4 的比例 (書籍常見比例) */
        overflow: hidden;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        z-index: 2;
    }

    .book-cover img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain; /* 改為 contain 確保圖片完整顯示 */
        background: #f8f9fa; /* 添加淺灰背景 */
        transition: transform 0.3s ease;
    }

    .book-card:hover .book-cover img {
        transform: scale(1.05);
    }

    /* 書籍編號標籤 */
    .book-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(102, 126, 234, 0.9);
        color: white;
        padding: 0.3rem 0.6rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 3;
        backdrop-filter: blur(4px);
    }

    /* 無圖片時的占位符 */
    .book-cover-placeholder {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #9ca3af;
        display: none;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        z-index: 2;
    }

    .book-cover-placeholder.show {
        display: flex;
    }

    .book-cover-placeholder svg {
        width: 60px;
        height: 60px;
        opacity: 0.5;
    }

    .book-cover-placeholder span {
        font-size: 0.9rem;
        opacity: 0.7;
    }

    /* 新書標籤 */
    .new-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: linear-gradient(45deg, #f093fb, #f5576c);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: bold;
        z-index: 3;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .book-info {
        padding: 1.5rem;
        position: relative;
        z-index: 2;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .book-title {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #333;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.8em;
    }

    .book-author {
        color: #666;
        margin-bottom: 0.5rem;
        font-style: italic;
        font-size: 0.9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .book-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
        font-size: 0.85rem;
        color: #6b7280;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .book-meta span {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .book-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 1rem;
    }

    .original-price {
        text-decoration: line-through;
        color: #9ca3af;
        font-size: 1rem;
        margin-right: 0.5rem;
    }

    .discount-badge {
        background: #ef4444;
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: bold;
        margin-left: 0.5rem;
    }

    .buy-button {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        font-size: 1rem;
        font-weight: bold;
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .buy-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .buy-button svg {
        width: 20px;
        height: 20px;
    }

    /* Section Title */
    .section-title {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: bold;
        position: relative;
        padding-bottom: 1rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        border-radius: 2px;
    }

    /* Features Section */
    .features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin: 4rem 0;
    }

    .feature-card {
        text-align: center;
        padding: 2rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        border-radius: 15px;
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 2rem;
    }

    /* 空狀態樣式 */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        border-radius: 20px;
        margin: 2rem 0;
    }

    .empty-state-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(45deg, #f3f4f6, #e5e7eb);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
    }

    .empty-state-icon svg {
        width: 60px;
        height: 60px;
        color: #9ca3af;
    }

    /* 載入動畫 */
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

    .animate-on-scroll {
        opacity: 0;
    }

    .animate-on-scroll.visible {
        animation: fadeInUp 0.6s ease forwards;
    }

    /* Grid responsive adjustments */
    @media (max-width: 768px) {
        .book-cover {
            padding-top: 140%; /* 稍微調整移動端的比例 */
        }

        .section-title {
            font-size: 2rem;
        }

        .book-title {
            font-size: 1rem;
        }

        .book-price {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 480px) {
        .grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 1rem !important;
        }

        .book-info {
            padding: 1rem;
        }

        .buy-button {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero">
    <h1>發現您的下一本好書</h1>
    <p>在 BookHaven 探索無限的知識與想像世界</p>
    <a href="#books" class="cta-button">開始探索</a>
</section>

<!-- Main Content -->
<div class="main-content">
    <h2 class="section-title" id="books">精選書籍</h2>

    @if(count($books) > 0)
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            @foreach($books as $index => $book)
                <div class="book-card animate-on-scroll">
                    <div class="book-cover">
                        @if($book->image_url)
                            <img src="{{ $book->image_url }}"
                                 alt="{{ $book->short_title }}"
                                 loading="lazy"
                                 onerror="this.style.display='none'; this.parentElement.querySelector('.book-cover-placeholder').classList.add('show');">
                        @endif
                        <div class="book-cover-placeholder {{ !$book->image_url ? 'show' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <span>無圖片</span>
                        </div>

                        <!-- 書籍編號 -->
                        <div class="book-badge">#{{ str_pad($book->id ?? $index + 1, 3, '0', STR_PAD_LEFT) }}</div>

                        <!-- 新書標籤（可選） -->
                        @if($index < 3)
                            <div class="new-badge">NEW</div>
                        @endif
                    </div>

                    <div class="book-info">
                        <div>
                            <h3 class="book-title">{{ $book->short_title }}</h3>

                            <!-- 作者資訊 -->
                            @if($book->authors && $book->authors->count() > 0)
                                <p class="book-author">
                                    {{ $book->authors->pluck('name')->implode(', ') }}
                                </p>
                            @else
                                <p class="book-author">作者資訊</p>
                            @endif

                            <!-- 元資訊 -->
                            <div class="book-meta">
                                @if($book->publisher)
                                    <span title="出版社">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                        {{ $book->publisher_name }}
                                    </span>
                                @endif

                                @if($book->stock)
                                    <span title="庫存">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                            </path>
                                        </svg>
                                        庫存: {{ $book->stock }}
                                    </span>
                                @endif
                            </div>

                            <!-- 價格 -->
                            <div class="book-price">
                                @if($book->original_price && $book->original_price > $book->price)
                                    <span class="original-price">${{ number_format($book->original_price, 2) }}</span>
                                @endif
                                ${{ number_format($book->price, 2) }}
                                @if($book->original_price && $book->original_price > $book->price)
                                    <span class="discount-badge">
                                        -{{ round((1 - $book->price / $book->original_price) * 100) }}%
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button class="buy-button" onclick="addToCart('{{ $book->short_title }}', {{ $book->price }})">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            加入購物車
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- 如果沒有書籍的情況 -->
        <div class="empty-state">
            <div class="empty-state-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">目前沒有可用的書籍</h3>
            <p class="text-gray-500 mb-6">請稍後再來查看我們的最新收藏</p>
            <a href="/" class="inline-block bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-full font-semibold transition duration-300 hover:shadow-lg hover:scale-105">
                返回首頁
            </a>
        </div>
    @endif

    <!-- Features Section -->
    <h2 class="section-title" style="margin-top: 4rem;">為什麼選擇我們</h2>

    <div class="features">
        <div class="feature-card animate-on-scroll">
            <div class="feature-icon">📚</div>
            <h3 class="text-xl font-bold mb-3">精選書籍</h3>
            <p class="text-gray-600">我們精心挑選每一本書籍，確保為讀者提供最優質的閱讀體驗</p>
        </div>

        <div class="feature-card animate-on-scroll">
            <div class="feature-icon">🚚</div>
            <h3 class="text-xl font-bold mb-3">快速配送</h3>
            <p class="text-gray-600">24小時內出貨，全台灣免運費，讓您快速收到心愛的書籍</p>
        </div>

        <div class="feature-card animate-on-scroll">
            <div class="feature-icon">💎</div>
            <h3 class="text-xl font-bold mb-3">優惠價格</h3>
            <p class="text-gray-600">提供最具競爭力的價格，定期推出促銷活動，讓閱讀更加實惠</p>
        </div>

        <div class="feature-card animate-on-scroll">
            <div class="feature-icon">⭐</div>
            <h3 class="text-xl font-bold mb-3">品質保證</h3>
            <p class="text-gray-600">所有書籍均為正版授權，提供完整的售後服務和品質保障</p>
        </div>
    </div>

    <!-- 額外的 CTA Section -->
    <div class="text-center py-16">
        <h3 class="text-2xl font-bold mb-4" style="background: linear-gradient(45deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            開始您的閱讀之旅
        </h3>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
            無論您喜歡文學小說、專業技能書籍，還是生活品味類讀物，我們都有豐富的選擇等待您的探索。
        </p>
        <a href="#books" class="inline-block bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-3 rounded-full font-semibold transition duration-300 hover:shadow-lg hover:scale-105">
            瀏覽更多書籍
        </a>
    </div>
</div>

<script>
    // 當頁面載入完成後，觸發動畫
    document.addEventListener('DOMContentLoaded', function() {
        // 為動畫元素添加觀察器
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // 觀察所有需要動畫的元素
        document.querySelectorAll('.animate-on-scroll').forEach((el) => {
            observer.observe(el);
        });

        // 書籍卡片載入動畫
        const bookCards = document.querySelectorAll('.book-card');
        bookCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });

    // 加入購物車功能
    function addToCart(title, price) {
        // 阻止事件冒泡
        event.stopPropagation();

        // 這裡可以添加實際的購物車邏輯
        console.log(`加入購物車: ${title} - $${price}`);

        // 顯示提示訊息
        showNotification(`已將 "${title}" 加入購物車`);
    }

    // 顯示通知功能
    function showNotification(message) {
        // 創建通知元素
        const notification = document.createElement('div');
        notification.className = 'fixed bottom-4 right-4 bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-y-full transition-transform duration-300';
        notification.textContent = message;

        document.body.appendChild(notification);

        // 顯示通知
        setTimeout(() => {
            notification.style.transform = 'translateY(0)';
        }, 100);

        // 3秒後移除通知
        setTimeout(() => {
            notification.style.transform = 'translateY(full)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // 書籍卡片點擊效果
    document.addEventListener('DOMContentLoaded', function() {
        const bookCards = document.querySelectorAll('.book-card');

        bookCards.forEach(card => {
            card.addEventListener('click', function(e) {
                // 如果點擊的不是按鈕，則可以添加查看詳情的功能
                if (!e.target.closest('.buy-button')) {
                    // 獲取書籍標題
                    const title = this.querySelector('.book-title').textContent;
                    console.log(`查看書籍詳情: ${title}`);
                    // 這裡可以添加跳轉到書籍詳情頁的邏輯
                }
            });
        });
    });

    // 圖片載入錯誤處理
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.book-cover img');
        images.forEach(img => {
            img.addEventListener('error', function() {
                this.style.display = 'none';
                const placeholder = this.parentElement.querySelector('.book-cover-placeholder');
                if (placeholder) {
                    placeholder.classList.add('show');
                }
            });
        });
    });
</script>

@endsection
