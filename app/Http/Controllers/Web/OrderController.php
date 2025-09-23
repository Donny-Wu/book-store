<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Order;
use Exception;
use DB;
use App\Enum\OrderStatus;
use App\Enum\PaymentStatus;
use App\Traits\HasApiResponse;

class OrderController extends Controller
{
    use HasApiResponse;
    //
    public function create(){
        return view('order.checkout');
    }
    public function store(Request $request){

        $order_data = $request->except(['_token', 'cart_items']);
        $cart_items = $request->input('cart_items');
        $cart_items = json_decode($cart_items,true);
        // dd($order_data, $cart_items);
        try{
            DB::transaction(function () use ($order_data,$cart_items) {
                $book_ids = array_column($cart_items, 'id');
                $books = Book::whereIn('id', $book_ids)
                         ->lockForUpdate() // 加鎖防止併發問題
                         ->get()
                         ->keyBy('id');
                // 第二步：先驗證所有庫存（及早發現問題）
                $stockUpdates = [];
                foreach ($cart_items as $row) {
                    $bookId = $row['id'];
                    $quantity = $row['quantity'];

                    if (!isset($books[$bookId])) {
                        throw new Exception("書籍 ID {$bookId} 不存在");
                    }

                    $book = $books[$bookId];

                    // 檢查庫存（及早失敗）
                    if (!$book->hasStock($quantity)) {
                        throw new Exception("書籍 {$book->title} 庫存不足，現有庫存：{$book->stock_quantity}，需要：{$quantity}");
                    }

                    // 準備庫存更新資料
                    $stockUpdates[] = [
                        'id' => $bookId,
                        'quantity' => $quantity
                    ];
                }
                // 第三步：批次更新庫存（先扣庫存，確保資料一致性）
                Book::batchUpdateStock($stockUpdates);
                // 第四步：準備並批次插入樞紐表資料
                $pivotData = [];
                foreach ($cart_items as $row) {
                    $bookId     = $row['id'];
                    $quantity   = $row['quantity'];
                    $book       = $books[$bookId];
                    // 計算金額
                    $unitPrice  = $row['unit_price'] ?? $book->price;
                    $subtotal   = $quantity * $unitPrice;

                    $pivotData[$bookId] = [
                        'quantity'      => $quantity,
                        'unit_price'    => number_format($unitPrice, 2, '.', ''),
                        'subtotal'      => number_format($subtotal, 2, '.', ''),
                    ];
                }
                //  建立訂單
                $order = Order::create($order_data);
                $order->pay();
                // 批次操作
                $order->books()->attach($pivotData);
                // 更新訂單金額
                $order->updatePrice();

            });
            $response = [
                'icon'  => 'success',
                'title' => '訂單新增成功',
                'text'  => '訂單新增成功',
            ];
            return redirect(route('order.create'))->with(compact(
                'response'
            ));
        }catch(Exception $e){
            $message = '訂單新增失敗:' . $e->getMessage();
            $response = [
                'icon'  => 'error',
                'title' => '訂單新增失敗',
                'text'  => $message,
            ];

            return redirect(route('order.create'))->with(compact(
                'response'
            ));
        }


    }
    public function index(Request $request){
        $query = Order::with(['books' => function($query) {
            $query->select('books.id', 'books.title', 'books.image');
        }])->orderBy('created_at', 'desc');

        // 狀態篩選
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 付款狀態篩選
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // 日期範圍篩選
        if ($request->filled('date_from')) {
            $query->whereDate('order_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('order_date', '<=', $request->date_to);
        }

        // 搜尋訂單編號或收件人
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('recipient_name', 'like', "%{$search}%")
                  ->orWhere('recipient_phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15)->appends($request->query());

        // 統計數據
        $statistics = [
            'total' => Order::count(),
            'pending' => Order::where('status', OrderStatus::PENDING)->count(),
            'confirmed' => Order::where('status', OrderStatus::CONFIRMED)->count(),
            'shipped' => Order::where('status', OrderStatus::SHIPPED)->count(),
            'finished' => Order::where('status', OrderStatus::FINISHED)->count(),
            'cancelled' => Order::where('status', OrderStatus::CANCELLED)->count(),
        ];

        return view('order.index', compact('orders', 'statistics'));
    }
    public function show(Order $order){
        $order->load([
            'books' => function($query) {
                $query->select('books.*');
            }
        ]);

        return view('order.show', compact('order'));
    }
    public function updateAdminNote(Request $request, Order $order){
        try{
            $order->admin_note = $request->admin_note;
            $order->save();
            return $this->apiSuccess('備註更新成功', []);
        }catch(Exception $e){
            return $this->apiError('備註更新失敗:' . $e->getMessage());
        }

    }
    /**
     * 更新訂單狀態
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|integer|in:1,2,3,4,5',
            'admin_note' => 'nullable|string|max:1000'
        ]);

        try {
            $newStatus = OrderStatus::from($request->status);

            // 檢查是否可以轉換到新狀態
            if (!$order->status->canTransitionTo($newStatus)) {
                throw new Exception("無法從 {$order->status->label()} 轉換到 {$newStatus->label()}");
            }
            $order->status = $newStatus;
            $order->save();
            return $this->apiSuccess('訂單狀態更新成功', []);

        } catch (Exception $e) {
            return $this->apiError('更新失敗：' . $e->getMessage());
        }
    }

    /**
     * 更新付款狀態
     */
    public function updatePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|integer|in:1,2,3,4'
        ]);

        try {
            $newPaymentStatus = PaymentStatus::from($request->payment_status);

            if (!$order->payment_status->canTransitionTo($newPaymentStatus)) {
                throw new Exception("無法從 {$order->payment_status->label()} 轉換到 {$newPaymentStatus->label()}");
            }

            $order->payment_status = $newPaymentStatus;
            $order->save();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => '付款狀態更新成功',
                    'payment_status' => [
                        'value' => $order->payment_status->value,
                        'label' => $order->payment_status->label(),
                        'color' => $order->payment_status->color()
                    ]
                ]);
            }

            return redirect()->back()->with('success', '付款狀態更新成功');

        } catch (Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => '更新失敗：' . $e->getMessage()
                ], 400);
            }

            return redirect()->back()->with('error', '更新失敗：' . $e->getMessage());
        }
    }

    /**
     * 批量操作
     */
    public function batchAction(Request $request){
        $request->validate([
            'action' => 'required|in:confirm,ship,finish,cancel',
            'order_ids' => 'required|array|min:1',
            'order_ids.*' => 'exists:orders,id'
        ]);

        try {
            $orders = Order::whereIn('id', $request->order_ids)->get();
            $successCount = 0;
            $errors = [];

            foreach ($orders as $order) {
                try {
                    switch ($request->action) {
                        case 'confirm':
                            $order->confirm();
                            break;
                        case 'ship':
                            $order->ship();
                            break;
                        case 'finish':
                            $order->finish();
                            break;
                        case 'cancel':
                            $order->cancel();
                            break;
                    }
                    $successCount++;
                } catch (Exception $e) {
                    $errors[] = "訂單 {$order->order_number}: " . $e->getMessage();
                }
            }

            $message = "成功處理 {$successCount} 筆訂單";
            if (!empty($errors)) {
                $message .= "，失敗：" . implode('；', $errors);
            }

            return redirect()->back()->with($successCount > 0 ? 'success' : 'error', $message);

        } catch (Exception $e) {
            return redirect()->back()->with('error', '批量操作失敗：' . $e->getMessage());
        }
    }

}
