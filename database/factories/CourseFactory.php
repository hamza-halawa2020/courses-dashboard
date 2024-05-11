<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
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
            'stage_id' => $this->faker->numberBetween(1, 3),
            'created_at' => $this->faker->time(),
        ];
    }
}
