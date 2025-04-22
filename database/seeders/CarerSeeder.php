<?php

namespace Database\Seeders;

use App\Models\CarerProviders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarerProviders::factory()->count(5)->create();
    }
}
