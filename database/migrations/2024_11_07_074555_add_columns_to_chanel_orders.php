<?php

use App\Models\ChanelCompany;
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
        Schema::table('chanel_orders', function (Blueprint $table) {
            //
            $table->foreignIdFor(ChanelCompany::class)->nullable()->default(null)->constrained()->after('id')->comment('通路商ID');
            $table->date('order_date')->nullable()->default(null)->comment('訂單日期')->after('channel_order_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chanel_orders', function (Blueprint $table) {
            //
            $table->dropColumn(['order_date', 'channel_company_id']);
        });
    }
};
