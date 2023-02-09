<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{

    protected $model = Book::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'author' => $this->faker->name,
            'genre' => $this->faker->word,
            'description' => $this->faker->sentence($nbWords = 20, $variableNbWords = true),
            'isbn' => $this->faker->numerify('#############'),
            'image' => '1675745745.jpg',
            'published' =>  $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'publisher' => $this->faker->word,        
        ];
    }
}
