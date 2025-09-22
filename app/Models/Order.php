<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $guarded = [];
    protected $casts = [
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
            if (empty($order->order_number)) {
                $order->order_number = self::generateOrderNumber();
            }
        });
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
        return $this->total_price - $this->discount_price + $this->shipping_fee;
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
