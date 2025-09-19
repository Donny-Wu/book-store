@extends('layouts.page')

@section('content')
<style>
    .form-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        position: relative;
        z-index: 1;
        margin-top: 2rem;
    }

    .form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(45deg, #667eea, #764ba2);
    }

    .form-header {
        padding: 2rem 2rem 1rem 2rem;
        border-bottom: 1px solid rgba(102, 126, 234, 0.1);
    }

    .form-title {
        font-size: 1.8rem;
        font-weight: bold;
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .form-subtitle {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .form-body {
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid rgba(102, 126, 234, 0.1);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1.5rem;
        align-items: start;
    }

    .form-group {
        position: relative;
        grid-column: span 12;
    }

    .form-group.col-6 {
        grid-column: span 6;
    }

    .form-group.col-4 {
        grid-column: span 4;
    }

    .form-group.col-3 {
        grid-column: span 3;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
        color: #374151;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-1px);
    }

    .form-input:hover {
        border-color: #667eea;
    }

    .form-select {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
        color: #374151;
        cursor: pointer;
    }

    .form-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-textarea {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
        color: #374151;
        resize: vertical;
        min-height: 120px;
        font-family: inherit;
    }

    .form-textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .error-message {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-actions {
        padding: 2rem;
        border-top: 1px solid rgba(102, 126, 234, 0.1);
        background: rgba(248, 250, 252, 0.5);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .btn {
        padding: 0.875rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.95rem;
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
        border: 2px solid rgba(102, 126, 234, 0.3);
    }

    .btn-secondary:hover {
        background: rgba(102, 126, 234, 0.2);
        color: #5a67d8;
        transform: translateY(-1px);
    }

    .image-upload-area {
        border: 2px dashed rgba(102, 126, 234, 0.3);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        background: rgba(102, 126, 234, 0.02);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .image-upload-area:hover {
        border-color: rgba(102, 126, 234, 0.5);
        background: rgba(102, 126, 234, 0.05);
    }

    .upload-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
    }

    .required {
        color: #ef4444;
    }

    /* 響應式 */
    @media (max-width: 1024px) {
        .form-group.col-6 {
            grid-column: span 12;
        }

        .form-group.col-4 {
            grid-column: span 6;
        }

        .form-group.col-3 {
            grid-column: span 4;
        }
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .form-group,
        .form-group.col-6,
        .form-group.col-4,
        .form-group.col-3 {
            grid-column: span 1;
        }

        .form-header,
        .form-body,
        .form-actions {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .form-header,
        .form-body,
        .form-actions {
            padding: 1rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: 0.75rem;
            font-size: 16px; /* 防止 iOS 縮放 */
        }
    }

    /* Dark mode */
    .dark .form-container {
        background: rgba(31, 41, 55, 0.95);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .dark .form-input,
    .dark .form-select,
    .dark .form-textarea {
        background: rgba(31, 41, 55, 0.8);
        border-color: rgba(102, 126, 234, 0.3);
        color: #f9fafb;
    }

    .dark .section-title {
        color: #f9fafb;
    }

    .dark .form-label {
        color: #e5e7eb;
    }
</style>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- <div class="form-container"> --}}
        <!-- 表單標題 -->
        <div class="form-header">
            <h1 class="form-title">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                {{ isset($book) ? '編輯書籍' : '新增書籍' }}
            </h1>
            <p class="form-subtitle">
                填寫完整的書籍資訊，讓讀者更容易找到這本書
            </p>
        </div>

            <!-- 表單內容 -->
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(in_array(strtoupper($method), ['PUT', 'PATCH']))
                    @method(strtoupper($method))
                @endif

                <div class="form-body">
                    <!-- 基本資訊區塊 -->
                    <div class="form-section">
                        <h2 class="section-title">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            基本資訊
                        </h2>

                        <div class="form-grid">
                            <!-- 書名 -->
                            <div class="form-group col-6">
                                <label for="title" class="form-label">
                                    書名 <span class="required">*</span>
                                </label>
                                <input type="text"
                                       name="title"
                                       id="title"
                                       class="form-input"
                                       value="{{ $book->title ?? old('title', '') }}"
                                       placeholder="請輸入書籍名稱">
                                @if($errors->has('title'))
                                    <div class="error-message">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $errors->get('title')[0] }}
                                    </div>
                                @endif
                            </div>

                            <!-- 作者 -->
                            <div class="form-group col-6">
                                <label for="authors_id" class="form-label">
                                    作者 <span class="required">*</span>
                                </label>
                                <x-multiple-select name="authors_id"
                                                 :options="$authors"
                                                 :values="(!empty($authors_id)) ? $authors_id : old('authors_id', [])"
                                                 :placeholder="'請選擇作者'" />
                                @if($errors->has('authors_id'))
                                    <div class="error-message">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $errors->get('authors_id')[0] }}
                                    </div>
                                @endif
                            </div>

                            <!-- ISBN -->
                            <div class="form-group col-4">
                                <label for="isbn" class="form-label">ISBN (10碼)</label>
                                <input type="text"
                                       name="isbn"
                                       id="isbn"
                                       class="form-input"
                                       value="{{ $book->isbn ?? old('isbn', '') }}"
                                       placeholder="請輸入 ISBN 10碼">
                                @if($errors->has('isbn'))
                                    <div class="error-message">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $errors->get('isbn')[0] }}
                                    </div>
                                @endif
                            </div>

                            <!-- ISBN-13 -->
                            <div class="form-group col-4">
                                <label for="isbn_13" class="form-label">ISBN-13</label>
                                <input type="text"
                                       name="isbn_13"
                                       id="isbn_13"
                                       class="form-input"
                                       value="{{ $book->isbn_13 ?? old('isbn_13', '') }}"
                                       placeholder="請輸入 ISBN 13碼">
                                @if($errors->has('isbn_13'))
                                    <div class="error-message">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $errors->get('isbn_13')[0] }}
                                    </div>
                                @endif
                            </div>

                            <!-- 定價 -->
                            <div class="form-group col-4">
                                <label for="price" class="form-label">
                                    定價 <span class="required">*</span>
                                </label>
                                <input type="number"
                                       name="price"
                                       id="price"
                                       class="form-input"
                                       value="{{ $book->price ?? old('price', 0.0) }}"
                                       step="0.01"
                                       min="0"
                                       placeholder="0.00">
                                @if($errors->has('price'))
                                    <div class="error-message">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $errors->get('price')[0] }}
                                    </div>
                                @endif
                            </div>

                            <!-- 出版日期 -->
                            <div class="form-group col-6">
                                <label for="published_at" class="form-label">出版日期</label>
                                <input type="date"
                                       name="published_at"
                                       id="published_at"
                                       class="form-input"
                                       value="{{ $book->published_at ?? old('published_at', '') }}">
                                @if($errors->has('published_at'))
                                    <div class="error-message">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $errors->get('published_at')[0] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- 出版資訊區塊 -->
                    <div class="form-section">
                        <h2 class="section-title">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            出版資訊
                        </h2>

                        <div class="form-grid">
                            <!-- 出版商 -->
                            <div class="form-group col-6">
                                <label for="publisher_id" class="form-label">出版商</label>
                                <select name="publisher_id" id="publisher_id" class="form-select">
                                    <option value="">請選擇出版商</option>
                                    @foreach($publishers as $publisher)
                                        <option value="{{ $publisher->id }}"
                                                @selected((isset($book->publisher_id) && $publisher->id == $book->publisher_id) || old('publisher_id') == $publisher->id)>
                                            {{ $publisher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('publisher_id'))
                                    <div class="error-message">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $errors->get('publisher_id')[0] }}
                                    </div>
                                @endif
                            </div>

                            <!-- 語言 -->
                            <div class="form-group col-6">
                                <label for="language_id" class="form-label">語言</label>
                                <select name="language_id" id="language_id" class="form-select">
                                    <option value="">請選擇語言</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}"
                                                @selected((isset($book->language_id) && $language->id == $book->language_id) || old('language_id') == $language->id)>
                                            {{ $language->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('language_id'))
                                    <div class="error-message">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $errors->get('language_id')[0] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- 圖片和描述區塊 -->
                    <div class="form-section">
                        <h2 class="section-title">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            圖片與描述
                        </h2>

                        <div class="form-grid">
                            <!-- 圖片上傳 -->
                            <div class="form-group">
                                <label class="form-label">書籍封面</label>
                                <div class="image-upload-area">
                                    <div class="upload-icon">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-gray-700 mb-2">上傳書籍封面</h3>
                                    <p class="text-gray-500 text-sm mb-4">支援 PNG、JPG、GIF 格式，檔案大小不超過 10MB</p>
                                    <div class="text-sm text-gray-600">
                                        <label class="cursor-pointer text-blue-600 hover:text-blue-800 font-semibold">
                                            點擊選擇檔案
                                            <input type="file" name="image" class="hidden" accept="image/*">
                                        </label>
                                        或拖放檔案至此處
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 內容描述 -->
                        <div class="form-group full-width">
                            <label for="description" class="form-label">內容描述</label>
                            <textarea name="description"
                                      id="description"
                                      class="form-textarea"
                                      placeholder="請輸入書籍內容描述、簡介或推薦理由...">{{ $book->description ?? old('description', '') }}</textarea>
                            @if($errors->has('description'))
                                <div class="error-message">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $errors->get('description')[0] }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 表單操作按鈕 -->
                <div class="form-actions">
                    <a href="{{ route('book.index') ?? '#' }}" class="btn btn-secondary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        取消
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ isset($book) ? '更新書籍' : '新增書籍' }}
                    </button>
                </div>
            </form>
    {{-- </div> --}}
</div>

<script>
    // 圖片上傳預覽功能
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.querySelector('input[type="file"]');
        const uploadArea = document.querySelector('.image-upload-area');

        if (fileInput && uploadArea) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // 創建預覽圖片
                        const preview = document.createElement('div');
                        preview.innerHTML = `
                            <img src="${e.target.result}"
                                 class="w-32 h-40 object-cover rounded-lg border-2 border-blue-200 mx-auto mb-2">
                            <p class="text-sm text-gray-600">${file.name}</p>
                        `;

                        // 替換上傳區域內容
                        const originalContent = uploadArea.innerHTML;
                        uploadArea.innerHTML = preview.innerHTML;

                        // 添加移除按鈕
                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'mt-2 text-red-600 hover:text-red-800 text-sm font-medium';
                        removeBtn.textContent = '移除圖片';
                        removeBtn.onclick = function() {
                            fileInput.value = '';
                            uploadArea.innerHTML = originalContent;
                        };
                        uploadArea.appendChild(removeBtn);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // 表單驗證
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('input[required], select[required], textarea[required]');
                let hasErrors = false;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('border-red-500');
                        hasErrors = true;
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                if (hasErrors) {
                    e.preventDefault();
                    alert('請填寫所有必填欄位');
                }
            });
        }
    });
</script>

@endsection
