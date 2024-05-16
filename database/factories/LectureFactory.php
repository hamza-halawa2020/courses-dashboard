<?php

namespace Database\Factories;

use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class LectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'price' => $this->faker->numberBetween(100, 999),
            'video_url' => $this->faker->name(),
            'note_book_url' => $this->faker->name(),
            'des' => $this->faker->name(),
            'notes' => $this->faker->name(),
            'start' => $this->faker->time(now()),
            'end' => $this->faker->time(now()),
            'chapter_id' => Chapter::factory(),
            'created_at' => $this->faker->time(),
        ];
    }
}
