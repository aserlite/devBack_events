<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avis>
 */
class AvisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'user_name' => User::inRandomOrder()->value('name') ?? User::factory()->create()->name,
            'event_id' => Event::inRandomOrder()->value('id') ?? Event::factory()->create()->id,
            'grade' => $this->faker->numberBetween(0, 5),
        ];
    }
}
