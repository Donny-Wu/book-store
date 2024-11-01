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
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\DataProvider;

class BookControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
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
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure($jsonStructure);
    }
    public function test_index_unauthenticated(){
        Language::factory(3)->create();
        Publisher::factory(2)->create();
        Book::factory(10)->create();
        $response = $this->json('get','/api/book');
        $json = [
            'code'      =>Response::HTTP_UNAUTHORIZED,
            'message'   =>'使用者身分未驗證:Unauthenticated',
            'data'      => []
        ];
        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
                 ->assertJson($json);
    }
    public function test_store(){
        Sanctum::actingAs(
            User::factory()->create()
        );
        Language::factory(3)->create();
        Publisher::factory(2)->create();
        $data = [
            //
            'title'         => $this->faker->name,
            'isbn'          => $this->faker->isbn10(),
            'isbn_13'       => $this->faker->isbn13(),
            'published_at'  => $this->faker->date(),
            'publisher_id'  => Publisher::all()->random()->id,
            'language_id'   => Language::all()->random()->id,
            'price'         => $this->faker->numberBetween(200,3000)

        ];
        $response = $this->json('post','/api/book',$data);
        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJson([
                    'code'      =>Response::HTTP_CREATED,
                    'message'   =>'資料新增成功',
                    'data'      => $data
                ]);
    }
    public function test_store_unauthenticated(){
        Language::factory(3)->create();
        Publisher::factory(2)->create();
        $data = [
            //
            'title'         => $this->faker->name,
            'isbn'          => $this->faker->isbn10(),
            'isbn_13'       => $this->faker->isbn13(),
            'published_at'  => $this->faker->date(),
            'publisher_id'  => Publisher::all()->random()->id,
            'language_id'   => Language::all()->random()->id,
            'price'         => $this->faker->numberBetween(200,3000)

        ];
        $response = $this->json('post','/api/book',$data);
        $json = [
            'code'      =>Response::HTTP_UNAUTHORIZED,
            'message'   =>'使用者身分未驗證:Unauthenticated',
            'data'      => []
        ];
        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
                 ->assertJson($json);
    }
    public function test_show(){
        Sanctum::actingAs(
            User::factory()->create()
        );
        Language::factory(3)->create();
        Publisher::factory(2)->create();
        $book = Book::factory()->create();
        $response = $this->json('get','/api/book/'.$book->id);
        $jsonStructure = [
            'code',
            'message',
            'data' => [
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
        ];
        $json = [
            'code'      =>Response::HTTP_OK,
            'message'   =>'資料取得成功',
            'data'      => $book->toArray()
        ];
        $response->assertStatus(Response::HTTP_OK)
                //  ->assertJson($json);
                 ->assertJsonStructure($jsonStructure);
    }
    public function test_show_unauthenticated(){
        Language::factory(3)->create();
        Publisher::factory(2)->create();
        $book = Book::factory()->create();
        $response = $this->json('get','/api/book/'.$book->id);
        $json = [
            'code'      =>Response::HTTP_UNAUTHORIZED,
            'message'   =>'使用者身分未驗證:Unauthenticated',
            'data'      => []
        ];
        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
                 ->assertJson($json);
    }
    public function test_update(){
        Sanctum::actingAs(
            User::factory()->create()
        );
        Language::factory(3)->create();
        Publisher::factory(2)->create();
        $book = Book::factory()->create();
        $data = [
            //
            'title'         => $this->faker->name,
            'isbn'          => $this->faker->isbn10(),
            'isbn_13'       => $this->faker->isbn13(),
            'published_at'  => $this->faker->date(),
            'publisher_id'  => Publisher::all()->random()->id,
            'language_id'   => Language::all()->random()->id,
            'price'         => $this->faker->numberBetween(200,3000)
        ];
        $response = $this->json('put','/api/book/'.$book->id,$data);
        $json = [
            'code'      =>Response::HTTP_OK,
            'message'   =>'資料更新成功',
            'data'      => $data
        ];
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson($json);
    }
    public function test_update_unauthenticated(){
        Language::factory(3)->create();
        Publisher::factory(2)->create();
        $book = Book::factory()->create();
        $data = [
            //
            'title'         => $this->faker->name,
            'isbn'          => $this->faker->isbn10(),
            'isbn_13'       => $this->faker->isbn13(),
            'published_at'  => $this->faker->date(),
            'publisher_id'  => Publisher::all()->random()->id,
            'language_id'   => Language::all()->random()->id,
            'price'         => $this->faker->numberBetween(200,3000)
        ];
        $response = $this->json('put','/api/book/'.$book->id,$data);
        $json = [
            'code'      =>Response::HTTP_UNAUTHORIZED,
            'message'   =>'使用者身分未驗證:Unauthenticated',
            'data'      => []
        ];
        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
                 ->assertJson($json);
    }
    #[DataProvider('invalidFormData')]
    public function test_store_invalid($invalidData, $invalidFields){
        Sanctum::actingAs(
            User::factory()->create()
        );
        $response =  $this->json('post','/api/book', $invalidData,['Accept' => 'application/json']);
        $response->assertInvalid($invalidFields);
        // $response->assertSessionHasErrors($invalidFields);
    }
    public static function invalidFormData(): array
    {
        return [
                [[
                    'title'                 => null,
                    'isbn'                  => null,
                    'isbn_13'               => null,
                    'published_at'          => null,
                    'publisher_id'          => null,
                    'language_id'           => null,
                    // 'price'                 => null
                ],
                [
                    'title',
                    'isbn',
                    'isbn_13',
                    'published_at',
                    'publisher_id',
                    'language_id',
                    // 'price'
                ]]
            // 'Email is not a valid email address' => [
            //     ['email' => 'This is not an email'],
            //     ['email']
            // ],
            // 'Passwords dont match' => [
            //     ['password' => 'Strong password','password_confirmation' => 'Weak password'],
            //     ['password']
            // ],

        ];
    }
}
