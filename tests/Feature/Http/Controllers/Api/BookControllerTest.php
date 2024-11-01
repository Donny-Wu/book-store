<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Book;
use App\Models\Language;
use App\Models\Publisher;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_index_as_user(){
        Sanctum::actingAs(
            User::factory()->create()
        );
        Language::factory(3)->create();
        Publisher::factory(2)->create();
        Book::factory(10)->create();
        $response = $this->json('get','/api/book');
        $jsonStructure = [
            'code',
            'message',
            'data' => [
                '*'=>[
                        'id',
                        'title',
                        'isbn',
                        'isbn_13',
                        'published_at',
                        'publisher_id',
                        'language_id',
                        'price',
                        'description',
                        'created_at',
                        'updated_at'
                ]
            ]
        ];
        $response->assertStatus(200)
                 ->assertJsonStructure($jsonStructure);
    }
}
