<?php

namespace Database\Factories;

use App\Models\Lecture;
use App\Models\QusetionHomeWork;
use Illuminate\Database\Eloquent\Factories\Factory;

class QusetionHomeWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = QusetionHomeWork::class;
    public function definition()
    {
        return [
            'question' => $this->faker->name(),
            'lecture_id' => Lecture::factory(),
        ];
    }
}
