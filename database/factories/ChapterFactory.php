<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'price' => $this->faker->numberBetween(100, 999),
            'course_id' => $this->faker->numberBetween(1, 5),
            'created_at' => $this->faker->time(),
        ];
    }
}
