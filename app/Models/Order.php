<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Enum\OrderStatus;
use App\Enum\PaymentStatus;

class Order extends Model
{
    //
    protected $guarded = [];
    protected $casts = [
        'status'            => OrderStatus::class,  //  自動轉換
        'payment_status'    => PaymentStatus::class,
        'order_date'        => 'datetime',
        'total_price'       => 'decimal:2',
        'discount_price'    => 'decimal:2',
        'shipping_fee'      => 'decimal:2',
        'final_price'       => 'decimal:2',
    ];
    // 只需要在 Order Model 加上 boot() 方法 自動產生訂單編號
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            // 自動產生訂單編號
            if (empty($order->order_number)) {
                $order->order_number = self::generateOrderNumber();
            }
            // 自動產生訂單日期
            if (empty($order->order_date)) {
                $order->order_date = Carbon::now();
            }
            //  設定預設狀態
            if (empty($order->status)) {
                $order->status = OrderStatus::default();
            }
            //  設定預設狀態
            if (empty($order->payment_status)) {
                $order->payment_status = PaymentStatus::default();
            }
        });
    }
    /**
     * 更新訂單狀態
     */
    public function updateStatus(OrderStatus $newStatus): bool
    {
        if (!$this->status->canTransitionTo($newStatus)) {
            throw new \InvalidArgumentException(
                "無法從 {$this->status->label()} 轉換到 {$newStatus->label()}"
            );
        }

        $this->status = $newStatus;
        return $this->save();
    }
    /**
     * 確認訂單
     */
    public function confirm(): bool
    {
        return $this->updateStatus(OrderStatus::CONFIRMED);
    }

    /**
     * 出貨
     */
    public function ship(): bool
    {
        return $this->updateStatus(OrderStatus::SHIPPED);
    }

    /**
     * 完成訂單
     */
    public function finish(): bool
    {
        return $this->updateStatus(OrderStatus::FINISHED);
    }

    /**
     * 取消訂單
     */
    public function cancel(): bool
    {
        return $this->updateStatus(OrderStatus::CANCELLED);
    }
     /**
     * 更新付款狀態
     */
    public function updatePaymentStatus(PaymentStatus $newStatus): bool
    {
        if (!$this->payment_status->canTransitionTo($newStatus)) {
            throw new \InvalidArgumentException(
                "無法從 {$this->payment_status->label()} 轉換到 {$newStatus->label()}"
            );
        }
        $this->payment_status = $newStatus;

        return $this->save();
    }
    /**
     * 付款
     */
    public function pay(): bool
    {
        return $this->updatePaymentStatus(PaymentStatus::PAID);
    }
    /**
     * 付款失敗
     */
    public function payFailed(): bool
    {
        return $this->updatePaymentStatus(PaymentStatus::FAILED);
    }
    /**
     * 執行退款
     */
    public function refund(): bool
    {
        return $this->updatePaymentStatus(PaymentStatus::REFUNDED);
    }
    public function books(){
        return $this->belongsToMany(Book::class,'book_orders')
                    ->withPivot('quantity','unit_price','subtotal')
                    ->withTimestamps();
    }
    public function calculateTotalPrice(){
        return $this->books()->sum('subtotal');
    }
    public function calculateFinalPrice(){
        return $this->total_price + $this->shipping_fee;
    }
    // 更新訂單金額
    public function updatePrice(){
        $this->total_price = $this->calculateTotalPrice();
        $this->final_price = $this->calculateFinalPrice();
        $this->save();
    }
     /**
     * 產生 UUID 風格訂單編號：ORD + 8位隨機英數字
     * 例如：ORD-A1B2C3D4
     */
    public static function generateOrderNumber()
    {
        do {
            $randomString = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
            $orderNumber = 'ORD-' . $randomString;
        } while (self::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

}
