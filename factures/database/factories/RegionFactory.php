<?php

namespace Database\Factories;

use App\Models\Local;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Region>
 */
class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nomRegion' => $this->faker->sentence(),
            'local_id' => Local::get('id')->random(),
            'user_id' => User::get('id')->random(),
            'created_at' => now(),
        ];
    }
}
