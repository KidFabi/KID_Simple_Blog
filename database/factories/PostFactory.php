<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'published_at' => now(),
            'author_id' => User::all()->random()->id,
            'visibility' => $this->faker->randomElement(['Draft', 'Awaiting Approval', 'Published', 'Rejected']),
            'title' => $this->faker->sentence(6, true),
            'subhead' => $this->faker->sentence(50, true),
            'content' => $this->faker->paragraphs(50, true),
        ];
    }
}
