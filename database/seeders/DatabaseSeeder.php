<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\LaborRegistration;
use App\Models\Letter;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Address::factory(30)->create();

        $this->call([
            LetterSeeder::class,
            AddressSeeder::class,
            LaborRegistrationSeeder::class,
        ]);
    }
}
