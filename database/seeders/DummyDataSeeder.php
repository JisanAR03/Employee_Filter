<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Faker\Provider\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 50; $i++) {
            DB::table('resumes')->insert([
                'name' => $faker->name,
                'current_position' => $faker->jobTitle,
                'current_company' => $faker->company,
                'average_stay' => $faker->numberBetween($min = 1000000, $max = 10000000),
                // 'zip_code' => $faker->numberBetween($min = 1200, $max = 1300),
                'location' => $faker->address,
                'resume_link' => $faker->url,
            ]);
        }
    }
}
