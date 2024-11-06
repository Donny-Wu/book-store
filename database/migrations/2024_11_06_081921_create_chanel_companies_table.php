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
        Schema::create('chanel_companies', function (Blueprint $table) {
            $table->comment('通路商基本資料');
            $table->bigIncrements('id')->comment('資料識別碼');
            $table->string('name')->comment('通路商名稱');
            $table->string('address')->nullable()->default(null)->comment('通路商地址');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chanel_companies');
    }
};
