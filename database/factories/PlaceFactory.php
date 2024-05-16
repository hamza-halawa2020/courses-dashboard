<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
        // return [
        //     'name' => $this->faker->unique()->randomElement([' سنتر شباب اﻻمه', ' سنتر النور', ' سنتر البيان']),
        // ];
    }
}
