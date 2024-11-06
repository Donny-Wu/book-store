<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChanelCompany;
use Schema;

class ChanelCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        ChanelCompany::truncate();
        ChanelCompany::factory(4)->create();
        Schema::enableForeignKeyConstraints();
    }
}
