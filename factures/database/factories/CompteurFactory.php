<?php

namespace Database\Factories;

use App\Models\Local;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compteur>
 */
class CompteurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word(),
            'unite' => $this->faker->word(),
            'consommation' => $this->faker->randomFloat(),
            'numSerie' => $this->faker->randomNumber(),
            'modele' => $this->faker->sentence(),
            'local_id' => Local::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
