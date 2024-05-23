<?php

namespace Database\Factories;

use App\Models\QuestionHomeWork;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerHomeWorkFactory extends Factory
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
            'question_home_work_id' => QuestionHomeWork::factory(),
            'is_right' => $this->faker->boolean(),
        ];
    }
}
