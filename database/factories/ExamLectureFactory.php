<?php

namespace Database\Factories;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamLectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->title(),
            'lecture_id' => Lecture::factory(),
        ];
    }
}
