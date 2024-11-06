<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BookMaker;
use Schema;

class BookMakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        BookMaker::truncate();
        BookMaker::factory(100)->create();
        Schema::enableForeignKeyConstraints();
    }
}
