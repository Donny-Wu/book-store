<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->cascadeOnDelete()->comment('關聯到 books.id');
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete()->comment('關聯到 orders.id');
            $table->integer('quantity')->default(1)->comment('購買數量');
            $table->decimal('unit_price', 10, 2)->default(0)->comment('單價（當時的價格）');
            $table->decimal('subtotal', 10, 2)->default(0)->comment('小計(quantity × unit_price)');
            $table->timestamps();
            // 複合唯一索引：一個訂單中不能有重複的書籍
            $table->unique(['book_id', 'order_id']);
            // 索引優化
            $table->index('book_id');
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_orders');
    }
};
