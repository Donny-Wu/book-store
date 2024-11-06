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
        Schema::create('chanel_orders', function (Blueprint $table) {
            // channel_id			通路商ID
            // channel_order_no	varchar(255)		通路商訂單編號
            // isbn	varchar(10)		ISBN
            // product_name	varchar(255)		商品品稱
            // product_qty	int		商品數量
            // product_price	decimal(10,2)		商品價格
            // total_price	decimal(10,2)		總計
            // ship_address	varchar(255)		出貨地址
            // contact_phone	varchar(255)		聯絡窗口電話
            // contact_person	varchar(255)		聯絡窗口對象
            // created_at	datetime		新增時間
            // updated_at	datetime		更新時間

            $table->comment('通路商訂單');
            $table->bigIncrements('id');
            $table->string('channel_order_no', 255)->nullable()->default(null)->comment('通路商訂單編號');
            $table->string('isbn', 10)->nullable()->default(null)->comment('ISBN');
            $table->string('product_name', 255)->nullable()->default(null)->comment('商品品稱');
            $table->integer('product_qty')->default(0)->comment('商品數量');
            $table->decimal('product_price', 10, 2)->default(0)->comment('商品價格');
            $table->decimal('total_price', 10, 2)->default(0)->comment('總計');
            $table->string('ship_address', 255)->nullable()->default(null)->comment('出貨地址');
            $table->string('contact_phone', 255)->nullable()->default(null)->comment('聯絡窗口電話');
            $table->string('contact_person', 255)->nullable()->default(null)->comment('聯絡窗口對象');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chanel_orders');
    }
};
