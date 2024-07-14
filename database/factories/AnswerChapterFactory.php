<?php

namespace Database\Factories;

use App\Models\ExamChapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerChapterFactory extends Factory
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
            'total_exam_id' => ExamChapter::factory(),
            'is_right' => $this->faker->boolean(),
        ];
    }
}
