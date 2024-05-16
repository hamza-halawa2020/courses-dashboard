<?php

namespace Database\Factories;

use App\Models\Course;
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
            'course_id' => Course::factory(),
            'created_at' => $this->faker->time(),
        ];
    }
}
