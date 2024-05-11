<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
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
            'question_id' => $this->faker->numberBetween(1, 10),
            'is_right' => $this->faker->boolean(),
        ];
    }
}
