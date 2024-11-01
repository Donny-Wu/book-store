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
        Schema::create('books', function (Blueprint $table) {
            $table->comment('書籍基本資料');
            $table->bigIncrements('id');
            $table->string('title')->nullable()->default(null)->comment('書名');
            $table->string('isbn',10)->nullable()->default(null)->comment('ISBN');
            $table->string('isbn_13',13)->nullable()->default(null)->comment('ISBN_13');
            $table->date('published_at')->nullable()->default(null)->comment('出版日期');
            $table->foreignIdFor(App\Models\Publisher::class)->nullable()->default(null)->comment('出版商ID');
            $table->foreignIdFor(App\Models\Language::class)->nullable()->default(null)->comment('語言ID');
            $table->decimal('price',10,2)->default(0)->comment('書籍定價');
            $table->text('description')->nullable()->default(null)->comment('書籍描述');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
