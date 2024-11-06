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
        Schema::create('book_makers', function (Blueprint $table) {
            $table->comment('作者/編者基本資料');
            $table->bigIncrements('id');
            $table->string('name',255)->comment('作者/編者名稱');
            $table->tinyInteger('role')->comment('作者/編者角色 1=作者、2=編者、3=譯者、4=繪者');
            $table->text('about')->nullable()->default(null)->comment('簡介');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_makers');
    }
};
