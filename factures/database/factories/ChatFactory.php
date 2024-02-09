<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'message' => $this->faker->text(),
            'emetteur_id' => User::get('id')->random(),
            'recepteur_id' => User::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
