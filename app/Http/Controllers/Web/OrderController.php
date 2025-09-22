<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Order;
use Exception;
use DB;

class OrderController extends Controller
{
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
}
