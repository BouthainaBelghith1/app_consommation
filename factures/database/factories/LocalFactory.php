<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Local>
 */
class LocalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nomLocal' => $this->faker->text(),
            'adresseLocal' => $this->faker->sentence(),
            'categorie_id' => Categorie::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
