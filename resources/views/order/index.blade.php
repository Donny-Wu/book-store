
@extends('layouts.page')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- 頁面標題和統計卡片 -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">訂單管理</h1>

        <!-- 統計卡片 -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">總計</div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $statistics['total'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="text-sm font-medium text-orange-500">待確認</div>
                <div class="text-2xl font-bold text-orange-600">{{ $statistics['pending'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="text-sm font-medium text-blue-500">已確認</div>
                <div class="text-2xl font-bold text-blue-600">{{ $statistics['confirmed'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="text-sm font-medium text-purple-500">已出貨</div>
                <div class="text-2xl font-bold text-purple-600">{{ $statistics['shipped'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="text-sm font-medium text-green-500">已完成</div>
                <div class="text-2xl font-bold text-green-600">{{ $statistics['finished'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="text-sm font-medium text-red-500">已取消</div>
                <div class="text-2xl font-bold text-red-600">{{ $statistics['cancelled'] }}</div>
            </div>
        </div>
    </div>

    <!-- 篩選和搜尋區域 -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('order.index') }}" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <!-- 搜尋框 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">搜尋</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="訂單編號 / 收件人 / 電話"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <!-- 訂單狀態 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">訂單狀態</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">全部狀態</option>
                        @foreach(App\Enum\OrderStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ request('status') == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 付款狀態 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">付款狀態</label>
                    <select name="payment_status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">全部狀態</option>
                        @foreach(App\Enum\PaymentStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ request('payment_status') == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 日期範圍 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">訂單日期</label>
                    <div class="flex space-x-2">
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <div class="flex space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        搜尋
                    </button>
                    <a href="{{ route('order.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        重置
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- 批量操作區域 -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">批量操作：</span>
                    <button type="button" onclick="batchAction('confirm')" class="px-3 py-1 bg-blue-100 text-blue-700 rounded text-sm hover:bg-blue-200">
                        確認訂單
                    </button>
                    <button type="button" onclick="batchAction('ship')" class="px-3 py-1 bg-purple-100 text-purple-700 rounded text-sm hover:bg-purple-200">
                        標記出貨
                    </button>
                    <button type="button" onclick="batchAction('finish')" class="px-3 py-1 bg-green-100 text-green-700 rounded text-sm hover:bg-green-200">
                        完成訂單
                    </button>
                    <button type="button" onclick="batchAction('cancel')" class="px-3 py-1 bg-red-100 text-red-700 rounded text-sm hover:bg-red-200">
                        取消訂單
                    </button>
                </div>
                <span id="selected-count" class="text-sm text-gray-500 dark:text-gray-400">已選擇 0 筆</span>
            </div>
        </div>
    </div>

    <!-- 訂單列表 -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left">
                            <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            訂單資訊
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            收件人
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            商品
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            金額
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            狀態
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4">
                                <input type="checkbox" name="order_ids[]" value="{{ $order->id }}"
                                       class="order-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $order->order_number }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $order->order_date->format('Y-m-d H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $order->recipient_name }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $order->recipient_phone }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    @if($order->books->count() > 0)
                                        @if($order->books->first()->image)
                                            <img src="{{ asset('storage/' . $order->books->first()->image) }}"
                                                 alt="Book cover" class="w-8 h-10 object-cover rounded">
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ Str::limit($order->books->first()->title, 20) }}
                                            </div>
                                            @if($order->books->count() > 1)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    +{{ $order->books->count() - 1 }} 本其他書籍
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    NT$ {{ number_format($order->final_price, 0) }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    商品: NT$ {{ number_format($order->total_price, 0) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col space-y-1">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                 bg-{{ $order->status->color() }}-100 text-{{ $order->status->color() }}-800">
                                        {{ $order->status->label() }}
                                    </span>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                 bg-{{ $order->payment_status->color() }}-100 text-{{ $order->payment_status->color() }}-800">
                                        {{ $order->payment_status->label() }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('order.show', $order) }}"
                                       class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                        查看
                                    </a>
                                    @if(!$order->status->isFinal())
                                        <button onclick="showStatusModal({{ $order->id }}, {{ $order->status->value }})"
                                                class="text-green-600 hover:text-green-900 text-sm font-medium">
                                            更新
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">尚無訂單資料</p>
                                    <p class="text-sm">調整搜尋條件或等待新訂單</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- 分頁 -->
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>

<!-- 狀態更新 Modal -->
<div id="status-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">更新訂單狀態</h3>
            <form id="status-form">
                <input type="hidden" id="order-id" name="order_id">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">訂單狀態</label>
                    <select id="order-status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach(App\Enum\OrderStatus::cases() as $status)
                            <option value="{{ $status->value }}">{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">管理員備註</label>
                    <textarea name="admin_note" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                              placeholder="選填"></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="hideStatusModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        取消
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        更新
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
// 全選功能
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.order-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateSelectedCount();
});

// 更新選中數量
function updateSelectedCount() {
    const checked = document.querySelectorAll('.order-checkbox:checked').length;
    document.getElementById('selected-count').textContent = `已選擇 ${checked} 筆`;
}

// 監聽單個checkbox變化
document.querySelectorAll('.order-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedCount);
});

// 批量操作
function batchAction(action) {
    const selectedIds = Array.from(document.querySelectorAll('.order-checkbox:checked'))
        .map(checkbox => checkbox.value);

    if (selectedIds.length === 0) {
        alert('請選擇要操作的訂單');
        return;
    }

    const actionNames = {
        'confirm': '確認',
        'ship': '出貨',
        'finish': '完成',
        'cancel': '取消'
    };

    if (confirm(`確定要${actionNames[action]}選中的 ${selectedIds.length} 筆訂單嗎？`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("order.batch-action") }}';

        // CSRF Token
        const csrfField = document.createElement('input');
        csrfField.type = 'hidden';
        csrfField.name = '_token';
        csrfField.value = '{{ csrf_token() }}';
        form.appendChild(csrfField);

        // Action
        const actionField = document.createElement('input');
        actionField.type = 'hidden';
        actionField.name = 'action';
        actionField.value = action;
        form.appendChild(actionField);

        // Order IDs
        selectedIds.forEach(id => {
            const idField = document.createElement('input');
            idField.type = 'hidden';
            idField.name = 'order_ids[]';
            idField.value = id;
            form.appendChild(idField);
        });

        document.body.appendChild(form);
        form.submit();
    }
}

// 顯示狀態更新 Modal
function showStatusModal(orderId, currentStatus) {
    document.getElementById('order-id').value = orderId;
    document.getElementById('order-status').value = currentStatus;
    document.getElementById('status-modal').classList.remove('hidden');
}

// 隱藏狀態更新 Modal
function hideStatusModal() {
    document.getElementById('status-modal').classList.add('hidden');
}

// 處理狀態更新表單提交
document.getElementById('status-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const orderId = document.getElementById('order-id').value;
    const formData = new FormData(this);

    fetch(`/order/${orderId}/status`, {
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

    hideStatusModal();
});

// 點擊 Modal 背景關閉
document.getElementById('status-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideStatusModal();
    }
});
</script>

@endsection


