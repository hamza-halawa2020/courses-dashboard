<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // return [
        //     'name' => $this->faker->unique()->randomElement(['اولي ثانوي', 'تانيه تانوي', 'تالته ثانوي']),
        // ];

        return [
            'name' => $this->faker->city,
        ];
    }
}
