<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarerProviders>
 */
class CarerProvidersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ukOutwardCodes = ['M13', 'B12', 'E14', 'SW1', 'LS1', 'G1', 'L8', 'NG3', 'CB2', 'OX1'];
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'location' => $this->faker->city(),
            'whatsapp' => $this->faker->phoneNumber(),
            'experience' => $this->faker->numberBetween(1, 10) . ' years',
            'about' => $this->faker->paragraph(),
            'service_area' => json_encode($this->faker->randomElements($ukOutwardCodes, 2)),
            'training' => $this->faker->sentence(3),
            'password' => Hash::make('carer'),
            'status' => 1, // assuming 1 = active
        ];
    }
}
