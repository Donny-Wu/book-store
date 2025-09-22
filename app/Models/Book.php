<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;
    //
    protected $guarded = [];
    protected $casts = [
        'price'             => 'decimal:2',
        'publication_date'  => 'date',
    ];
     /**
     * 批次更新書籍庫存
     * @param array $stockUpdates 格式: [['id' => 1, 'quantity' => 2], ...]
     */
    public static function batchUpdateStock(array $stockUpdates){
        // 方法1：使用 CASE WHEN 語句（最高效）
        if (empty($stockUpdates)) return;

        $ids = array_column($stockUpdates, 'id');
        $idsString = implode(',', $ids);

        // 建立 CASE WHEN 語句
        $caseStatement = 'CASE id ';
        $bindings = [];

        foreach ($stockUpdates as $update) {
            $caseStatement .= "WHEN ? THEN stock_qty - ? ";
            $bindings[] = $update['id'];
            $bindings[] = $update['quantity'];
        }
        $caseStatement .= 'END';

        // 執行批次更新
        DB::update("
            UPDATE books
            SET stock_qty = {$caseStatement}
            WHERE id IN ({$idsString})
        ", $bindings);
    }
    public function orders(){
        return $this->belongsToMany(Order::class, 'book_orders')
                    ->withPivot('quantity', 'unit_price', 'subtotal')
                    ->withTimestamps();
    }
    public function hasStock($qty=1){
        return $this->stock_qty >= $qty;
    }
    // 減少庫存
    public function reduceStock($qty){
        if ($this->hasStock($qty)) {
            $this->decrement('stock_qty', $qty);
            return true;
        }
        return false;
    }
    // 增加庫存
    public function increaseStock($qty){
        $this->increment('stock_qty', $qty);
    }
    public function getImageUrlAttribute(){
        if($this->image){
            return Storage::disk('public')->url($this->image);
        }
        return asset('images/default-book-image.jpg');
    }
    public function authors(){
        return $this->belongsToMany(Author::class,'book_author');
    }

    public function getShortTitleAttribute(){
        return Str::limit($this->title, 80, '...');
        // return substr($this->title, 0, 20);
    }
    public function publisher(){
        // $this->hasOne(Publisher::class);
        return $this->belongsTo(Publisher::class);
    }
    public function language(){
        return $this->belongsTo(Language::class);
        // $this->hasOne(Language::class);
    }
    public function getPublisherNameAttribute(){
        return $this->publisher->name;
    }
    public function getLanguageNameAttribute(){
        return $this->language->name;
    }
}
