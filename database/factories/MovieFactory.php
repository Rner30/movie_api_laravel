<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            "title" => $this->faker->unique()->word(10),
            'description' => $this->faker->text(100),
            "publishDate" => $this->faker->date()
        ];
    }
}
