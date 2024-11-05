<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;
use App\Models\Publisher;
use App\Models\Book;
use Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        // User::factory()->withPersonalTeam()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Schema::disableForeignKeyConstraints();
        Language::truncate();
        Publisher::truncate();
        Book::truncate();
        Language::factory(3)->create();
        Publisher::factory(2)->create();
        Book::factory(10)->create();
        Schema::enableForeignKeyConstraints();
    }
}
