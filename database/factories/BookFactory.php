<?php

namespace Database\Factories;

use App\Models\Publisher;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title'         => $this->faker->name,
            'isbn'          => $this->faker->isbn10(),
            'isbn_13'       => $this->faker->isbn13(),
            'published_at'  => $this->faker->date(),
            'publisher_id'  => Publisher::all()->random()->id,
            'language_id'   => Language::all()->random()->id,
            'price'         => $this->faker->numberBetween(200,3000)

        ];
    }
}
