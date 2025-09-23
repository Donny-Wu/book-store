@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- 頁面標題和返回按鈕 -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">訂單詳情</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">訂單編號：{{ $order->order_number }}</p>
        </div>
        <a href="{{ route('order.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
            返回列表
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- 左側主要內容 -->
        <div class="lg:col-span-2 space-y-6">
            <!-- 訂單基本資訊 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">訂單資訊</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">基本資訊</h3>
                            <dl class="space-y-2">
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-600 dark:text-gray-400">訂單編號：</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->order_number }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-600 dark:text-gray-400">訂單日期：</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">{{ $order->order_date->format('Y-m-d H:i:s') }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-600 dark:text-gray-400">訂單狀態：</dt>
                                    <dd>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                     bg-{{ $order->status->color() }}-100 text-{{ $order->status->color() }}-800">
                                            {{ $order->status->label() }}
                                        </span>
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-600 dark:text-gray-400">付款狀態：</dt>
                                    <dd>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                     bg-{{ $order->payment_status->color() }}-100 text-{{ $order->payment_status->color() }}-800">
                                            {{ $order->payment_status->label() }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">金額明細</h3>
                            <dl class="space-y-2">
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-600 dark:text-gray-400">商品總計：</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">NT$ {{ number_format($order->total_price, 0) }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-600 dark:text-gray-400">折扣金額：</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">NT$ {{ number_format($order->discount_price, 0) }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-600 dark:text-gray-400">運費：</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white">NT$ {{ number_format($order->shipping_fee, 0) }}</dd>
                                </div>
                                <div class="flex justify-between border-t border-gray-200 dark:border-gray-700 pt-2">
                                    <dt class="text-base font-medium text-gray-900 dark:text-white">最終金額：</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white">NT$ {{ number_format($order->final_price, 0) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 收件人資訊 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">收件人資訊</h2>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">收件人姓名</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">{{ $order->recipient_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">聯絡電話</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">{{ $order->recipient_phone }}</dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">配送地址</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">{{ $order->shipping_address }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- 訂單商品 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">訂單商品</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($order->books as $book)
                            <div class="flex items-center space-x-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}"
                                         alt="{{ $book->title }}"
                                         class="w-16 h-20 object-cover rounded">
                                @else
                                    <div class="w-16 h-20 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                @endif

                                <div class="flex-1">
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">{{ $book->title }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">ISBN: {{ $book->isbn }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">作者: {{ $book->authors->pluck('name')->implode(', ') }}</p>
                                </div>

                                <div class="text-right">
                                    <div class="text-sm text-gray-900 dark:text-white">數量: {{ $book->pivot->quantity }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">單價: NT$ {{ number_format($book->pivot->unit_price, 0) }}</div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">小計: NT$ {{ number_format($book->pivot->subtotal, 0) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 備註資訊 -->
            @if($order->consumer_note || $order->admin_note)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">備註資訊</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        @if($order->consumer_note)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">消費者備註</h3>
                                <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    {{ $order->consumer_note }}
                                </p>
                            </div>
                        @endif

                        @if($order->admin_note)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">管理員備註</h3>
                                <p class="text-sm text-gray-900 dark:text-white bg-blue-50 dark:bg-blue-900 p-3 rounded">
                                    {{ $order->admin_note }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- 右側操作區域 -->
        <div class="space-y-6">
            <!-- 快速操作 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">快速操作</h2>
                </div>
                <div class="p-6 space-y-3">
                    @if(!$order->status->isFinal())
                        @foreach($order->status->getNextStatuses() as $nextStatus)
                            <button onclick="updateOrderStatus({{ $order->id }}, {{ $nextStatus->value }})"
                                    class="w-full px-4 py-2 bg-{{ $nextStatus->color() }}-600 text-white rounded-md hover:bg-{{ $nextStatus->color() }}-700 focus:outline-none focus:ring-2 focus:ring-{{ $nextStatus->color() }}-500">
                                {{ $nextStatus->label() }}
                            </button>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <p class="text-gray-500 dark:text-gray-400">此訂單已完成，無法進行狀態變更</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- 狀態歷程 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">狀態歷程</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">訂單建立</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                        </div>

                        @if($order->status->value >= 2)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">訂單確認</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->updated_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($order->status->value >= 3)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">商品出貨</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->updated_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($order->status->value >= 4)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">訂單完成</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->updated_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($order->status->value == 5)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">訂單取消</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->updated_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 管理員備註編輯 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">管理員備註</h2>
                </div>
                <div class="p-6">
                    <form id="admin-note-form">
                        <textarea name="admin_note" rows="4"
                                  placeholder="輸入管理員備註..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $order->admin_note }}</textarea>
                        <button type="submit"
                                class="mt-3 w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            儲存備註
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// 更新訂單狀態
function updateOrderStatus(orderId, statusValue) {
    if (!confirm('確定要更新訂單狀態嗎？')) {
        return;
    }

    fetch(`/admin/orders/${orderId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            status: statusValue
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('狀態更新成功');
            location.reload();
        } else {
            alert('更新失敗：' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('更新失敗，請重試');
    });
}

// 儲存管理員備註
document.getElementById('admin-note-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(`/admin/orders/{{ $order->id }}/status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('備註已儲存');
        } else {
            alert('儲存失敗：' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('儲存失敗，請重試');
    });
});
</script>
@endpush
