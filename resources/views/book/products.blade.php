@extends('layouts.dashboard')

@section('content')
<style>
    .products-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2rem;
        border-bottom: 1px solid rgba(102, 126, 234, 0.1);
    }

    .search-bar {
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.8);
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 12px;
        padding: 0.5rem 1rem;
        min-width: 300px;
        transition: all 0.3s ease;
    }

    .search-bar:focus-within {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .search-input {
        border: none;
        outline: none;
        background: transparent;
        flex: 1;
        padding: 0.5rem;
        font-size: 0.9rem;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6b7280;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, #f3f4f6, #e5e7eb);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    /* 響應式 */
    @media (max-width: 768px) {
        .products-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .products-actions {
            justify-content: space-between;
        }

        .search-bar {
            min-width: auto;
            flex: 1;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
    }

    /* Dark mode */
    .dark .product-card {
        background: rgba(31, 41, 55, 0.95);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .dark .product-title {
        color: #f9fafb;
    }

    .dark .search-bar {
        background: rgba(31, 41, 55, 0.8);
        border-color: rgba(102, 126, 234, 0.3);
    }
        .products-title {
        font-size: 1.8rem;
        font-weight: bold;
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .products-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-secondary {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        border: 1px solid rgba(102, 126, 234, 0.3);
    }

    .btn-secondary:hover {
        background: rgba(102, 126, 234, 0.2);
        color: #5a67d8;
    }

    .products-content {
        padding: 2rem;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 1rem;
    }

    .product-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
    }

    .product-card::before {
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
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .product-card:hover::before {
        opacity: 0.05;
    }

    .product-image {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(45deg, #f1f3f4, #e8eaed);
        z-index: 2;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        right: 0;
        background: rgba(102, 126, 234, 0.9);
        color: white;
        padding: 0.5rem;
        border-radius: 0 0 0 10px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 3;
    }

    .product-info {
        padding: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .product-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price {
        font-size: 1.3rem;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 1rem;
    }

    .product-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .action-btn {
        flex: 1;
        padding: 0.6rem;
        border: none;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
    }

    .action-edit {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .action-edit:hover {
        background: rgba(59, 130, 246, 0.2);
        color: #2563eb;
    }

    .action-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .action-delete:hover {
        background: rgba(239, 68, 68, 0.2);
        color: #dc2626;
    }

    .action-view {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .action-view:hover {
        background: rgba(16, 185, 129, 0.2);
        color: #059669;
    }
</style>

<!-- 頁面標題和操作 -->
<div class="products-header">
    <div class="products-title">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>
        書籍管理
        <span style="font-size: 1rem; opacity: 0.7;">({{ count($books) }} 本書籍)</span>
    </div>

    <div class="products-actions">
        <div class="search-bar">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" class="search-input" placeholder="搜尋書籍..." id="searchInput">
        </div>

        <a href="{{ route('book.create') ?? '#' }}" class="btn btn-primary">
        {{-- <a href="{{ '#' }}" class="btn btn-primary"> --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            新增書籍
        </a>

        <button class="btn btn-secondary" onclick="toggleView()">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            網格視圖
        </button>
    </div>
</div>

<!-- 書籍內容 -->
<div class="products-content">
    @if(count($books) > 0)
        <div class="products-grid" id="productsGrid">
            @foreach($books as $index => $book)
                <div class="product-card" data-title="{{ strtolower($book->short_title) }}">
                    <div class="product-image">
                        <img src="https://picsum.photos/300/400?random={{ $index }}"
                             alt="{{ $book->short_title }}"
                             loading="lazy">
                        <div class="product-overlay">
                            #{{ str_pad($book->id ?? $index + 1, 3, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>

                    <div class="product-info">
                        <h3 class="product-title">{{ $book->short_title }}</h3>
                        <div class="product-price">${{ number_format($book->price, 2) }}</div>

                        <div class="product-meta" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; font-size: 0.85rem; color: #6b7280;">
                            <span>庫存: {{ $book->stock ?? rand(5, 50) }}</span>
                            <span>分類: {{ $book->category ?? '一般' }}</span>
                        </div>

                        <div class="product-actions">
                            <a href="{{ route('book.show', $book->id ?? 1) }}" class="action-btn action-view">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                查看
                            </a>

                            <a href="{{ route('book.edit', $book->id ?? 1) }}" class="action-btn action-edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                編輯
                            </a>

                            <button class="action-btn action-delete" onclick="deleteBook({{ $book->id ?? $index + 1 }})">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                刪除
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">目前沒有書籍</h3>
            <p style="margin-bottom: 2rem;">開始添加您的第一本書籍吧！</p>
            <a href="{{ route('book.create') ?? '#' }}" class="btn btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                新增第一本書
            </a>
        </div>
    @endif
</div>

<script>
    // 搜尋功能
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const productCards = document.querySelectorAll('.product-card');

        productCards.forEach(card => {
            const title = card.getAttribute('data-title');
            if (title.includes(searchTerm)) {
                card.style.display = 'block';
                card.style.animation = 'fadeInUp 0.3s ease-out';
            } else {
                card.style.display = 'none';
            }
        });

        // 顯示搜尋結果數量
        const visibleCards = document.querySelectorAll('.product-card[style="display: block;"], .product-card:not([style*="display: none"])').length;
        console.log(`找到 ${visibleCards} 本書籍`);
    });

    // 切換視圖功能
    function toggleView() {
        const grid = document.getElementById('productsGrid');
        const currentCols = grid.style.gridTemplateColumns;

        if (currentCols === '1fr') {
            // 切換到網格視圖
            grid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(280px, 1fr))';
        } else {
            // 切換到列表視圖
            grid.style.gridTemplateColumns = '1fr';
        }
    }

    // 刪除書籍功能
    function deleteBook(bookId) {
        if (confirm('確定要刪除這本書嗎？此操作無法復原。')) {
            // 這裡可以發送 AJAX 請求到後端
            console.log(`刪除書籍 ID: ${bookId}`);

            // 示範動畫移除
            const card = event.target.closest('.product-card');
            card.style.animation = 'fadeOut 0.3s ease-out forwards';
            setTimeout(() => {
                card.remove();
            }, 300);
        }
    }

    // 添加淡出動畫
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);

    // 頁面載入動畫
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.product-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.5s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>

@endsection


