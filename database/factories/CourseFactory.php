<?php

namespace Database\Factories;

use App\Models\Stage;
use App\Models\Teacher;
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
            'stage_id' => Stage::factory(),
            'teacher_id' => Teacher::factory(),
            'created_at' => $this->faker->time(),
        ];
    }
}
