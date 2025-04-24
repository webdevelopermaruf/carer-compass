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
        $faker = \Faker\Factory::create('en_GB');
        $ukOutwardCodes = ['M13', 'B12', 'E14', 'SW1', 'LS1', 'G1', 'L8', 'NG3', 'CB2', 'OX1'];
        return [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'phone' => $faker->phoneNumber(),
            'location' => $faker->city(),
            'whatsapp' => $faker->phoneNumber(),
            'experience' => $faker->numberBetween(1, 10) . ' years',
            'about' => $faker->realText(100),
            'service_area' => json_encode($faker->randomElements($ukOutwardCodes, 2)),
            'training' => $faker->realText(20),
            'password' => Hash::make('carer'),
            'status' => 1, // assuming 1 = active
        ];
    }
}
