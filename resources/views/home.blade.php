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

    .book-cover {
        position: relative;
        width: 100%;
        height: 300px;
        overflow: hidden;
        z-index: 2;
    }

    .book-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .book-card:hover .book-cover img {
        transform: scale(1.05);
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
        font-size: 1.3rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #333;
        line-height: 1.4;
    }

    .book-author {
        color: #666;
        margin-bottom: 1rem;
        font-style: italic;
    }

    .book-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 1rem;
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
    }

    .buy-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
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

    /* Grid responsive adjustments */
    @media (max-width: 768px) {
        .book-cover {
            height: 250px;
        }

        .section-title {
            font-size: 2rem;
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

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach($books as $index => $book)
            <div class="book-card animate-on-scroll">
                <div class="book-cover">
                    <img src="https://picsum.photos/300/400?random={{ $index }}"
                         alt="{{ $book->short_title }}"
                         class="w-full h-full object-cover">
                </div>
                <div class="book-info">
                    <div>
                        <h3 class="book-title">{{ $book->short_title }}</h3>
                        <p class="book-author">作者資訊</p>
                        <div class="book-price">${{ $book->price }}</div>
                    </div>
                    <button class="buy-button" onclick="addToCart('{{ $book->short_title }}', {{ $book->price }})">
                        加入購物車
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- 如果沒有書籍的情況 -->
    @if(count($books) == 0)
        <div class="text-center py-16">
            <div class="text-gray-500 text-xl mb-4">目前沒有可用的書籍</div>
            <p class="text-gray-400">請稍後再來查看我們的最新收藏</p>
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
            <div class="feature-icon">💝</div>
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
    });

    // 書籍卡片點擊效果
    document.addEventListener('DOMContentLoaded', function() {
        const bookCards = document.querySelectorAll('.book-card');

        bookCards.forEach(card => {
            card.addEventListener('click', function(e) {
                // 如果點擊的不是按鈕，則可以添加查看詳情的功能
                if (!e.target.classList.contains('buy-button')) {
                    // 這裡可以添加查看書籍詳情的邏輯
                    console.log('查看書籍詳情');
                }
            });
        });
    });
</script>

@endsection
