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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->comment('訂單編號');
            $table->timestamp('order_date')->comment('訂單日期');
            $table->decimal('total_price', 10, 2)->default(0)->comment('總計');
            $table->decimal('discount_price', 10, 2)->default(0)->comment('折扣價格');
            $table->decimal('shipping_fee', 10, 2)->default(0)->comment('運費');
            $table->decimal('final_price', 10, 2)->default(0)->comment('最終價格');
            $table->tinyInteger('status')->default(1)->comment('訂單狀態：pending=1, confirmed=2, shipped=3, finished=4, cancelled=5');
            $table->tinyInteger('payment_status')->default(1)->comment('付款狀態：pending=1, paid=2, failed=3, refunded=4');
            $table->tinyInteger('payment_method')->default(1)->comment('付款方式：in_cash=1credit_card=2, bank_transfer=3');
            $table->string('recipient_name',100)->comment('收件人姓名');
            $table->string('recipient_phone',20)->comment('收件人電話');
            $table->string('shipping_address',255)->comment('配送地址資訊');
            $table->tinyInteger('shipping_method')->default(1)->comment('配送方式：home_delivery=1, convenience_store=2, post_office=3');
            $table->text('consumer_note')->nullable()->comment('消費者備註');
            $table->text('admin_note')->nullable()->comment('管理員備註');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
