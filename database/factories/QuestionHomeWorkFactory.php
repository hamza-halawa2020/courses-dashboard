<?php

namespace Database\Factories;

use App\Models\Lecture;
use App\Models\QuestionHomeWork;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionHomeWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = QuestionHomeWork::class;
    public function definition()
    {
        return [
            'question' => $this->faker->name(),
            'lecture_id' => Lecture::factory(),
        ];
    }
}
