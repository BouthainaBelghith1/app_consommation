<?php

namespace Database\Factories;

use App\Models\Compteur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facture>
 */
class FactureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'montantTotale' => $this->faker->randomFloat(),
            'isPaid' => $this->faker->boolean(),
            'periode' => $this->faker->randomNumber(),
            'adresse' => $this->faker->sentence(),
            'dateFinConsommation' => $this->faker->date(),
            'dateLimitePaiement' => $this->faker->date(),
            'prixUnitaire' => $this->faker->randomFloat(),
            'quantite' => $this->faker->randomFloat(),
            'compteur_id' => Compteur::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
