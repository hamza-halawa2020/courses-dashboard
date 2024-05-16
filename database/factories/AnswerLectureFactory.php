<?php

namespace Database\Factories;

use App\Models\ExamLecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerLectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'answer' => $this->faker->name(),
            'exam_lecture_id' => ExamLecture::factory(),
            'is_right' => $this->faker->boolean(),
        ];
    }
}
