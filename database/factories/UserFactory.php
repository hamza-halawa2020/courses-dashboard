<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'parent_phone' => $this->faker->unique()->phoneNumber,
            'parent_name' => $this->faker->name(),
            'type' => 'user',
            'gender' => $this->faker->randomElement(['male', 'female']),
            'password' => bcrypt('123456'),
            'status' => $this->faker->randomElement(['0', '1']),
            'stage_id' => Stage::inRandomOrder()->first()->id,
            'place_id' => Place::inRandomOrder()->first()->id,
            'email_verified_at' => now(),
        ];
    }
}
