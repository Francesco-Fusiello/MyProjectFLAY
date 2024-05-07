<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(50), 
            'body'=>fake()->sentence(),
            'price'=> fake()->numberBetween(1, 100),
            'category_id'=> fake()->numberBetween(1, 5),
            'user_id'=> fake()->numberBetween(1, 5),
        ];
    }
}
