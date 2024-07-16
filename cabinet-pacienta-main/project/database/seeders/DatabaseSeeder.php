<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            PostGroupSeed::class,
            FilialSeeder::class,
            PacientSeeder::class,
            EmployeeSeeder::class,
            CabinetSeeder::class,
            CabinetSheduleSeeder::class,
            EmployeeScheduleSeeder::class,
            MethodSeed::class,
            ZoneSeed::class,
            MethodologySeed::class,
            PostSeed::class,
        ]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
